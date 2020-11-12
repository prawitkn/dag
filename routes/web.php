<?php

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
Auth::routes();

Route::get('/dag_school','DagSchoolController@index');
Route::group(['middleware' => 'auth'], function(){
	// Students
	Route::get('/dag_school/students/view-list','DagsStudentController@list_view');
	Route::get('/dag_school/students/list','DagsStudentController@list');
	Route::get('dag_school/students/new','DagsStudentController@new_view');
	Route::post('dag_school/students/create','DagsStudentController@create')->name('create');
	Route::get('dag_school/students/edit/{id}','DagsStudentController@edit_view');
	Route::post('dag_school/students/update','DagsStudentController@update')->name('update');

	// Program
	Route::get('/dag_school/programs/view-list','DagsProgramController@list_view');
	Route::get('/dag_school/programs/list','DagsProgramController@list');
	Route::get('dag_school/programs/new','DagsProgramController@new_view');
	Route::post('dag_school/programs/create','DagsProgramController@create')->name('create');
	Route::get('dag_school/programs/edit/{id}','DagsProgramController@edit_view');
	Route::post('dag_school/programs/update','DagsProgramController@update')->name('update');

	// Program Class
	Route::get('dag_school/program-classes/view-list','DagsProgramClassController@list_view');
	Route::get('dag_school/program-classes/list','DagsProgramClassController@list');
	Route::get('dag_school/program-classes/new','DagsProgramClassController@new_view');
	Route::post('dag_school/program-classes/create','DagsProgramClassController@create')->name('create');
	Route::get('dag_school/program-classes/edit/{item_id}','DagsProgramClassController@edit_view');
	Route::post('dag_school/program-classes/update','DagsProgramClassController@update')->name('update');


	// Program Course
	Route::get('dag_school/program-course-tests/view-list','DagsProgramCourseTestController@list_view');
	Route::get('dag_school/program-course-tests/list','DagsProgramCourseTestController@list');
	Route::get('dag_school/program-course-tests/new','DagsProgramCourseTestController@new_view');
	Route::post('dag_school/program-course-tests/create','DagsProgramCourseTestController@create')->name('create');
	Route::get('dag_school/program-course-tests/edit/{item_id}','DagsProgramCourseTestController@edit_view');
	Route::post('dag_school/program-course-tests/update','DagsProgramCourseTestController@update')->name('update');

	

	// Class Students
	Route::get('/dag_school/class-students/view-list','DagsProgramClassStudentController@list_view');
	Route::get('/dag_school/class-students/list','DagsProgramClassStudentController@list');
	Route::get('dag_school/class-students/new','DagsProgramClassStudentController@new_view');
	Route::post('dag_school/class-students/create','DagsProgramClassStudentController@create')->name('create');
	Route::get('dag_school/class-students/edit/{id}','DagsProgramClassStudentController@edit_view');
	Route::post('dag_school/class-students/update','DagsProgramClassStudentController@update')->name('update');


	// Program Class Test Student
	Route::get('dag_school/program-class-test-students/view-list','DagsProgramClassTestStudentController@list_view');
	Route::get('dag_school/program-class-test-students/test-list','DagsProgramClassTestStudentController@test_list');
	Route::get('dag_school/program-course-tests/student_list','DagsProgramClassTestStudentController@student_list');
	Route::post('dag_school/program-course-tests/update-scores','DagsProgramClassTestStudentController@score_update');


	Route::get('dag_school/program-course-tests/new','DagsProgramClassTestStudentController@new_view');
	Route::post('dag_school/program-course-tests/create','DagsProgramClassTestStudentController@create')->name('create');
	Route::get('dag_school/program-course-tests/edit/{item_id}','DagsProgramClassTestStudentController@edit_view');

	// Courses
	// Route::get('/dag_school/courses/view-list/{id}','DagsCourseController@list_view');
	// Route::get('/dag_school/courses/list/{id}','DagsCourseController@list');
	// Route::get('dag_school/courses/new','DagsCourseController@new_view');
	// Route::post('dag_school/courses/create','DagsCourseController@create')->name('create');
	// Route::get('dag_school/courses/edit/{id}','DagsCourseController@edit_view');
	// Route::post('dag_school/courses/update/{id}','DagsCourseController@update')->name('update');




	// OSS
	Route::get('oss/service_topics/list-by-service_type','OssServiceDataController@list_by_service_type');

	// Service data
	Route::get('oss/service-data/new','OssServiceDataController@new');
	Route::post('oss/service-data/create','OssServiceDataController@create');
});