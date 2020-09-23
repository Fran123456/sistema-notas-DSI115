<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Help\Help;
use Illuminate\Support\Facades\Auth;
use App\Degree;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','photo','curriculum','phone','address','active','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                 return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function degrees()
    {
        return $this->belongsToMany('App\Degree','degree_school_year','user_id','degree_id')
                        ->using('App\DegreeSchoolYear')->withPivot([
                          'capacity',
                          'id as k'
                        ]);
    }


    public static  function teacher()//obtiene los grados que esta acargo un docente por periodo activo
    {
      $p = Help::getSchoolYear();
      $d = DegreeSchoolYear::where('school_year_id',$p->id)
      ->where('user_id',Auth::user()->id)->get();
      $compile = array();
      foreach ($d as $key => $value) {
         $user = User::find($value->user_id);
         $grade = Degree::find($value->degree_id);
         $aux = array($user, $grade);

         $complement = array(
          'year'=>$p->year,
          'capacity'=> $value->capacity,
          'full'=> $value->full,
          'id_degreeSchoolYear'=> $value->id,
         );
         $compile[$key][0]=$user;
         $compile[$key][1]=$grade;
         $compile[$key][2]=$complement;
      }
      return $compile;
    }

    public static function studentsByYearByDegree($degree,$schoolYear){
      $students = DB::table('students as stu')
      ->join('students_history as sh','stu.id','=','sh.student_id')
      ->select('sh.id','stu.name','stu.lastname','stu.gender','stu.age','stu.address','stu.phone','stu.parent_name','stu.status')
      ->where('sh.degree_id','=',$degree)
      ->where('sh.school_year_id','=',$schoolYear)
      ->get();
      return $students;
    }


}
