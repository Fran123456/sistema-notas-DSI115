<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Help\Help;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Boolean;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->authorizeRoles(['administrador']);
        $users = User::all();
        return view('users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        auth()->user()->authorizeRoles(['administrador']);
        $roles = Role::all();
        return view('users.userCreate', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['administrador']);
        $user = User::where('email', $request->email)->get();
        if(count($user)>0){
            return back()->with('delete','<strong>Error el correo ya existe</strong>');
        }else{

            $file = null;
             if($request->photo!=null){
                $file =  Help::uploadFile($request, 'images/users/','photo');
             }else{
                $file = 'default.png';
             }

             // Storage::disk('public')->delete('imagen-tipos-mas/'.$tipoAux->imagen);
             $userN = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
             'photo' => $file,
             'phone' => $request->phone,
             'address'=> $request->address,
             'role_id'=> $request->role
             ]);
             $userN->roles()->attach(Role::where('id', $request->role)->first());
             return redirect()->route('users.index')->with('success','<strong>El usuario '.$userN->name.' fue creado correctamente</strong>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        auth()->user()->authorizeRoles(['administrador']);
        $user = User::find($id);
        $created_at = Help::dateFormatter($user->created_at);
        return view('users.user', compact('user','created_at'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        auth()->user()->authorizeRoles(['administrador']);
        $user = User::find($id);
        $roles = Role::all();
        return view('users.userUpdate',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['administrador']);
        $backUser = User::find($id);
        $backUser->roles()->where('role_id', $backUser->roles()->first()->id)
        ->where('user_id',$backUser->id)
        ->update([
            'role_id' => $request->role
        ]);
        $file = null;
        if($request->photo!=null){
          $file =  Help::uploadFile($request, 'images/users/','photo');
        }else{
          $file = $backUser->photo;
        }
        User::where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $file,
          ]);

        return redirect()->route('users.index')->with('edit','<strong>El usuario '.$request->name.' fue actualizado correctamente</strong>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['administrador']);
       User::destroy($id);
       return back()->with('delete', '<strong>Usuario eliminado correctamente');
    }


    public function updatePassword(Request $request, $id)
    {
        //$request->user()->authorizeRoles(['administrador']);
        $user= User::find($id);
       return view('users.updatePassword', compact('user'));
    }

    private function checkCurrentPassword($currentPassword,$passwordSaved)
    {
        if (Hash::check($currentPassword,$passwordSaved))
         return true;
        else return false;

    }

    public function savePassword(Request $request, $id)
    {
        //$request->user()->authorizeRoles(['administrador']);
        $user= User::find($id);

        if( $this->checkCurrentPassword($request->currentPassword,$user->password) == false ){
        return back()->with('edit', 'Contraseña actual incorrecta');
       }
       if ( $request->repeatPassword != $request->newPassword) {
        return back()->with('edit', 'Contraseñas no coinciden');
       }
       elseif (  $this->checkCurrentPassword($request->currentPassword,$user->password) == true && $request->repeatPassword == $request->newPassword) {
           User::where('id',$id)->update(
               [
                   'password' => Hash::make($request->newPassword),
               ]
               );
        return back()->with('edit', 'Actualizado Correctamente');
       }
    }

    public function demoSecretary(){
        auth()->user()->authorizeRoles(['secretaria']);
        return view('users.demo');
    }

    public function demoTeacher(){
        auth()->user()->authorizeRoles(['Docente']);
        return view('users.demo');
    }

     public function demoAdmin(){
        auth()->user()->authorizeRoles(['Administrador']);
        return view('users.demo');
    }

    public function changeStatus(Request $request, $id){
        $request->user()->authorizeRoles(['administrador']);
        $backUser=User::find($id);
        $valorCambio=2;
        $stringCambio="";
        if($backUser->active==0){
            $valorCambio=1;
        }
        else{
            $valorCambio=0;
        }
        User::where('id',$id)->update(['active'=>$valorCambio]);
        if($valorCambio==1){
            $stringCambio=" activado ";
        }
        else{
            $stringCambio=" desactivado ";
        }
        return redirect()->route('users.index')->with('edit','<strong>El usuario '.$request->name.' fue '.$stringCambio.' correctamente</strong>');

    }

}
