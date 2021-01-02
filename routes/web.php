<?php

use App\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*USERS*/
//
Route::resource('users', 'User\UserController');
Route::get('user/update/password/{id}', 'User\UserController@updatePassword')->name('updatePassword');
Route::post('user/save/password/{id}', 'User\UserController@savePassword')->name('savePassword');
Route::get('user/active/{id}', 'User\UserController@changeStatus')->name('changeStatus');
//
/*USERS*/


/*ROLES*/
//
Route::resource('roles', 'Role\RoleController');
//
/*ROLES*/

/*RUTAS DEMO*/
Route::get('secretary', 'User\UserController@demoSecretary')->name('secretaryurl');
Route::get('teacher', 'User\UserController@demoTeacher')->name('teacherurl');
Route::get('administrator', 'User\UserController@demoAdmin')->name('adminurl');
/*RUTAS DEMO*/


/*DEGREES*/
Route::resource('degrees', 'Degree\DegreeController');
Route::post('degree/update/{id}', 'Degree\DegreeController@update')->name('degree_update');
Route::get('degree/active/{id}', 'Degree\DegreeController@changeStatusDegree')->name('changeStatusDegree');


/*DEGREES*/


/*SCHOOL YEAR*/
Route::resource('years', 'SchoolYear\SchoolYearController');
Route::get('year/teacher/grade/{id}', 'SchoolYear\SchoolYearController@createYearTeacher')->name('teacher-grade');
Route::post('year/teacher/grade/store', 'SchoolYear\SchoolYearController@storeYearTeacher')->name('storeYearTeacher');
Route::get('year/active/{id}', 'SchoolYear\SchoolYearController@changeStatusSchoolYear')->name('changeStatusSchoolYear');
Route::get('year/subjects/{id}', 'SchoolYear\SchoolYearSubjectsController@storeSubjects')->name('storeSubjects');
Route::post('year/subjects/save', 'SchoolYear\SchoolYearSubjectsController@saveSubjectsDegree')->name('saveSubjectsDegree');
Route::get('year/subjects/destroy/{id}', 'SchoolYear\SchoolYearSubjectsController@deleteSubjectsDegree')->name('deleteSubjectsDegree');
Route::get('year/teacher/grade/{id}/edit', 'SchoolYear\SchoolYearController@editYear_grade')->name('editYear_grade');
Route::post('year/teacher/grade/{id}/edit/save', 'SchoolYear\SchoolYearController@save_editYear_grade')->name('save_editYear_grade');
Route::get('year/deleting/{id}', 'SchoolYear\SchoolYearController@deletingSchoolYear')->name('deletingSchoolYear');

Route::get('year/finish/{id}', 'SchoolYear\SchoolYearController@finish')->name('finishyear');
/*SCHOOL YEAR DEGREES*/
Route::resource('yearsdegree', 'SchoolYear\SchoolYearDegreesController');
Route::post('yearsdegree/delete/{id}', 'SchoolYear\SchoolYearDegreesController@delete')->name('yearsdegree_delete');
Route::get('yeardegree/{id}/students/','SchoolYear\SchoolYearDegreesController@showStudentsDegreeYear')->name('showStudentsDegreeYear');

//ASIGNAR ESTUDIANTE
Route::get('year/asignation/student/{idDegree}/{idYear}', 'SchoolYear\SchoolYearDegreesController@asignStudentForm')->name('asignStudentForm');
Route::post('year/asignation/student/save', 'SchoolYear\SchoolYearDegreesController@asignStudent')->name('asignStudent');

/*SUBJECTS*/
Route::resource('subjects', 'Subject\SubjectController');
Route::get('subject/active/{id}', 'Subject\SubjectController@changeStatusSubject')->name('changeStatusSubject');

/*STUDENTS*/
Route::resource('students', 'Student\StudentController');
Route::get('new-student', 'Student\StudentGradeController@addStudent')->name('addStudent');
Route::post('student/update/{id}', 'Student\StudentController@update')->name('student_update');
Route::post('new-student/create', 'Student\StudentGradeController@registerStudent')->name('studentCreate');
Route::get('student/deleting/{id}', 'Student\StudentController@beforedeleting')->name('beforedeleting');

/*ATTENDANCE*/
Route::resource('attendance','AttendanceStudent\AttendanceStudentController');
Route::get('attendances/{idDegree}','AttendanceStudent\AttendanceStudentController@attendancesDates')->name('attendancesDates');
Route::get('attendances/{idDegree}/{attendanceDate}','AttendanceStudent\AttendanceStudentController@showAttendance')->name('showAttendance');
Route::get('attendance/record/{idDegreeSchoolYear}', 'AttendanceStudent\AttendanceStudentController@record')->name('attendanceRecord');
Route::post('attendance/record/save', 'AttendanceStudent\AttendanceStudentController@saveRecord')->name('saveAttendanceRecord');
Route::post('attendance/filter/{control}', 'AttendanceStudent\AttendanceStudentController@filter')->name('attendance-filter');
Route::get('attendances/{idDegree}/{attendanceDate}/edit','AttendanceStudent\AttendanceStudentController@editAttendance')->name('editAttendance');
Route::patch('attendances/update','AttendanceStudent\AttendanceStudentController@updateAttendanceRecord')->name('updateAttendance');

/*STUDENT HISTORY*/
Route::resource('studenthistories','Student\StudentHistoryController');

/*SCORE TYPES*/
Route::get('score-types', 'Score\ScoreTypeController@scoreType')->name('scoreTypeList');
Route::get('score-types/create/{}', 'Score\ScoreTypeController@crateScoreType')->name('crateScoreType');
Route::post('score-types/delete', 'Score\ScoreTypeController@destroy')->name('destroyScoreType');

/*SCORE TYPES*/
Route::get('grades-teacher/{id}', 'Teacher\TeacherController@grades')->name('gradesTeacher');
Route::get('grades-teacher/types/{grade}/{teacher}', 'Teacher\TeacherController@types')->name('typesSubjectTeacher');
Route::post('grades-teacher/percentage/save','Score\ScoreTypeController@scoreTypeSave')->name('scoreTypeSave');
Route::get('grades-teacher/percentage/{grade}/{teacher}/{subject}/{period}','Teacher\TeacherController@scorePercentage')->name('scorePercentage');
Route::get('teacher/{idteacher}/degree/{iddegree}/students/','Teacher\TeacherController@showStudentsDegreeTeacher')->name('showStudentsDegreeTeacher');
Route::get('types/sendtypes', 'Score\ScoreTypeController@SendTypes')->name('SendTypes');
Route::get('teacher/{idteacher}/degree/{iddegree}/subjects/','Teacher\TeacherController@showSubjectsByDegree')->name('showSubjectsByDegree');

/*score*/
Route::get('scores/student', 'Score\ScoreController@getScoresTypeByStudent')->name('getScoresTypeByStudent');
Route::get('scores/update', 'Score\ScoreController@updateScores')->name('updateScores');
Route::get('teacher/{idteacher}/subject/{idsubject}/period/{idperiod}/scores','Score\ScoreBySubjectController@showStudentScoreBySubject')->name('showStudentScoreBySubject');
Route::get('scores-subject/update', 'Score\ScoreBySubjectController@updateScoresBySubject')->name('updateScoresBySubject');

/*PERIODOS */
Route::resource('periods','Period\PeriodController');
Route::get('year/{idyear}/periods','Period\PeriodController@index')->name('periods-index');
Route::get('year/finish-period/{period}','Period\PeriodController@finishPeriod')->name('periods-finish');
//Resúmenes
Route::get('year/{idYear}/periods/{idPeriod}/attendances','AttendanceStudent\AttendanceStudentController@attendanceOverview')->name('attendanceOverview');
Route::get('year/{idYear}/periods/{idPeriod}/scores','Period\PeriodController@showPeriodScoresOverview')->name('periodScoresOverview');
//para finalizar año
Route::get('year/finishprocess/{year}','SchoolYear\SchoolYearController@finishProcess')->name('finishProcess');


Route::get('year/{idyear}/periods/edit','Period\PeriodController@edit')->name('periods-edit');
Route::post('year/{idyear}/periods/edit/save','Period\PeriodController@update')->name('periods-update');
Route::get('year/{idyear}/periods/create','Period\PeriodController@create')->name('periods-create');
Route::post('year/{idyear}/periods/create/save','Period\PeriodController@store')->name('periods-store');
Route::post('year/periods/delete','Period\PeriodController@destroy')->name('periods-delete');
Route::get('year/{idyear}/active/{idperiod}', 'Period\PeriodController@changePeriodStatus')->name('changePeriodStatus');


/*CONDUCTA INDICADORES */
Route::resource('behaviors','Behavior\BehaviorController');
Route::post('behaviors/delete','Behavior\BehaviorController@destroy')->name('behaviors-delete');
Route::get('behaviors/register/all/{degreeid}','Behavior\BehaviorController@all')->name('behaviors-all');
Route::get('behaviors/register/{degreeid}/{idperiod}','Behavior\BehaviorController@register')->name('behaviors-register');
Route::get('behaviors/register/detail/{degreeid}/{idperiod}','Behavior\BehaviorController@detail')->name('behaviors-register-detail');
Route::get('behaviors/register/delete/{degreeid}/{idperiod}','Behavior\BehaviorController@delete')->name('behaviors-register-delete');
Route::post('behaviors/register/save','Behavior\BehaviorController@saveRegister')->name('behaviors-register-save');
Route::get('behavior/period/{year}/{period}','Behavior\BehaviorController@indicatorsByStudent')->name('behaviors-period-student');



/*REPORTS*/
Route::resource('reports', 'Report\ReportController');
Route::get('attendance-report-pdf/{student_id}/{period_id}', 'Report\ReportController@reportpdf')->name('attendance.pdf');
Route::get('scores-pdf/{student_id}', 'Report\ReportController@scorespdf')->name('scores.pdf');
Route::get('failed-students/{degreeid}/{year}/{teacher}', 'Report\ReportController@failedpdf')->name('failed.pdf');
Route::get('passed-students/{degreeid}/{year}/{teacher}', 'Report\ReportController@passedpdf')->name('passed.pdf');

//reportes secretaria/director
Route::post('attendance/report/admin', 'Report\ReportController@admin')->name('report-admin');
Route::get('periodScores/{degree}/{period}/{year}', 'Report\ReportController@periodScoresPdf')->name('period-scores.pdf');
Route::get('attendancesByDegree/{year}/{period}/{degree}/{section}', 'Report\ReportController@attendancespdf')->name('attendances.pdf');
