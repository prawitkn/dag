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

// Route::group(['middleware' => 'auth'], function(){
// 	// Admin
// 	Route::get('admin','AdminController@dashboard');

// 	// User
// 	Route::post('/admin/edit-reset_pw_ajax','AdminController@resetPasswordAjax');
// 	Route::get('admin/users2/view-list','AdminController@User2ListView');
// 	Route::get('admin/users2/list','AdminController@User2List');
// 	Route::get('admin/users2/new','AdminController@User2NewView');
// 	Route::post('admin/users2/create','AdminController@User2Create')->name('user2Create');
// 	Route::get('admin/users2/edit/{id}','AdminController@User2EditView');
// 	Route::post('admin/users2/update','AdminController@User2Update')->name('user2Update');

// 	Route::get('change-pw','UserController@changePassword');
// 	Route::post('update-pw','UserController@changePassword');

// 	// Product Category
// 	Route::get('admin/product_categories/view-list','ProductCategoryController@list_view');
// 	Route::get('admin/product_categories/list','ProductCategoryController@list');
// 	Route::get('admin/product_categories/new','ProductCategoryController@new_view');
// 	Route::post('admin/product_categories/create','ProductCategoryController@create')->name('create');
// 	Route::get('admin/product_categories/edit/{id}','ProductCategoryController@edit_view');
// 	Route::post('admin/product_categories/update','ProductCategoryController@update')->name('update');


// });


// Route::group(['middleware' => 'auth'], function(){
// 	// POS
// 	Route::get('pos','PosController@index');	

// 	// Product
// 	Route::get('pos/products/view-list','PosProductController@productListView');
// 	Route::get('pos/products/list','PosProductController@list');
		
// 	// Order
// 	Route::get('pos/orders/new','PosOrderController@OrderNew');
// 	Route::get('pos/orders/view-list','PosOrderController@OrderListView');
// 	Route::post('pos/orders/create','PosOrderController@orderCreate')->name('orderCreate');
// 	Route::get('pos/orders/edit','PosOrderController@EditOrder');
// 	Route::get('pos/orders/sourcings/dashboard','PosOrderController@OrderSourcing');
// 	Route::get('pos/orders/sourcings/item/{id}','PosOrderController@OrderSourcingItem');
// 	Route::get('pos/orders/view-edit-list','PosOrderController@OrderEditView');

// });


// Route::group(['middleware' => 'auth'], function(){
// 	// POS
// 	Route::get('online_store','OnlineStoreController@index')->name('online_store-dashboard');	

// 	// Customer
// 	Route::get('online_store/customers/view-list','OsCustomerController@list_view');
// 	Route::get('online_store/customers/list','OsCustomerController@list');
// 	Route::get('online_store/customers/new','OsCustomerController@new_view');
// 	Route::post('online_store/customers/create','OsCustomerController@create')->name('create');
// 	Route::get('online_store/customers/edit/{id}','OsCustomerController@edit_view');
// 	Route::post('online_store/customers/update','OsCustomerController@update')->name('update');
// 	Route::get('online_store/customers/edit-product-list/{id}','OsCustomerController@edit_product_list_view');
// 	// CustomerProduct
// 	Route::post('online_store/customers/add-product','OsCustomerProductController@add_product');
// 	Route::post('online_store/customers/remove-product','OsCustomerProductController@remove_product');

// 	// Shipto Customer
// 	Route::get('online_store/ship_to_customers/view-list/{customer_id}','OsShipToCustomerController@list_view');
// 	Route::get('online_store/ship_to_customers/list/{customer_id}','OsShipToCustomerController@list');
// 	Route::get('online_store/ship_to_customers/new/{customer_id}','OsShipToCustomerController@new_view');
// 	Route::post('online_store/ship_to_customers/create/{customer_id}','OsShipToCustomerController@create')->name('create');
// 	Route::get('online_store/ship_to_customers/edit/{id}','OsShipToCustomerController@edit_view');
// 	Route::post('online_store/ship_to_customers/update','OsShipToCustomerController@update')->name('update');
// 	Route::get('online_store/ship_to_customers/edit-product-list/{id}','OsShipToCustomerController@edit_product_list_view');
// 	// CustomerProduct
// 	// Route::post('online_store/ship_to_customers/add-product','OsCustomerProductController@add_product');
// 	// Route::post('online_store/ship_to_customers/remove-product','OsCustomerProductController@remove_product');

// 	// Product
// 	Route::get('online_store/products/view-list','OsProductController@list_view');
// 	Route::get('online_store/products/list','OsProductController@list');
// 	Route::get('online_store/products/new','OsProductController@new_view');
// 	Route::post('online_store/products/create','OsProductController@create')->name('create');
// 	Route::get('online_store/products/edit/{id}','OsProductController@edit_view');
// 	Route::post('online_store/products/update','OsProductController@update')->name('update');
// 	Route::get('online_store/products/upload','OsProductController@file_upload_view');
// 	Route::post('online_store/products/file-import', 'OsProductController@file_import')->name('online_store-products-file-import');
// 	Route::get('online_store/products/import-list','OsProductController@import_list');
// 	Route::get('online_store/products/file-import-export', 'OsProductController@file_export')->name('online_store-products-file-export');
		


// 	// Order
// 	Route::get('online_store/orders/view-new','OsOrderController@NewView');
// 	Route::post('online_store/orders/create','OsOrderController@Create');
// 	Route::get('online_store/orders/view-edit/{id}','OsOrderController@EditView')->name('ViewEdit');	
// 	Route::get('online_store/orders/view-date_cust_ship_edit/{issue_date}/{cust_id}/{ship_to_id}','OsOrderController@EditDateCustShipView');
// 	Route::get('online_store/orders/view-list','OsOrderController@ListView');
// 	Route::get('online_store/orders/list','OsOrderController@List');
// 	Route::get('online_store/order/{id}','OsOrderController@View')->name('View');
// 	Route::get('online_store/orders/list-total-by-customer','OsOrderController@listTotalByCustomer');
// 	Route::get('online_store/orders/list-by-customer','OsOrderController@listByCustomer');
// 	Route::get('online_store/orders/export-excel','OsOrderController@exportExcel');
// 	Route::post('online_store/orders/end','OsOrderController@end');



// 	// Route::get('pos/orders/view-list','PosOrderController@OrderListView');
// 	// Route::post('pos/orders/create','PosOrderController@orderCreate')->name('orderCreate');
// 	// Route::get('pos/orders/edit','PosOrderController@EditOrder');
// 	// Route::get('pos/orders/sourcings/dashboard','PosOrderController@OrderSourcing');
// 	// Route::get('pos/orders/sourcings/item/{id}','PosOrderController@OrderSourcingItem');
// 	// Route::get('pos/orders/view-edit-list','PosOrderController@OrderEditView');

// 	Route::post('online_store/orders/item/edit','OsOrderItemController@Update');
// 	Route::post('online_store/orders/get/{id}','OsOrderController@Get');
// 	Route::post('online_store/orders/edit-items','OsOrderController@ItemsEdit');
// 	Route::post('online_store/orders/remove-item/{order_id}/{product_id}','OsOrderController@ItemRemove');
	




// 	// Order Admin
// 	Route::get('online_store/dashboard','OsOrderController@DashboardView');
// 	Route::get('/','OnlineStoreController@index');	
// });		
// // Route::get('/', function () {
//     return view('home');
// });











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






	Route::get('/dag_school/program-student/view-list','DagsProgramStudentHeaderController@list_view');
	Route::get('/dag_school/program-student/list','DagsProgramStudentHeaderController@list');

	// Main Courses
	Route::get('/dag_school/main_courses/view-list','DagsProgramMainCourseController@list_view');
	Route::get('/dag_school/main_courses/list','DagsProgramMainCourseController@list');
	Route::get('dag_school/main_courses/new','DagsProgramMainCourseController@new_view');
	Route::post('dag_school/main_courses/create','DagsProgramMainCourseController@create')->name('create');
	Route::get('dag_school/main_courses/edit/{id}','DagsProgramMainCourseController@edit_view');
	Route::post('dag_school/main_courses/update','DagsProgramMainCourseController@update')->name('update');

	// Courses
	// Route::get('/dag_school/courses/view-list/{id}','DagsCourseController@list_view');
	// Route::get('/dag_school/courses/list/{id}','DagsCourseController@list');
	// Route::get('dag_school/courses/new','DagsCourseController@new_view');
	// Route::post('dag_school/courses/create','DagsCourseController@create')->name('create');
	// Route::get('dag_school/courses/edit/{id}','DagsCourseController@edit_view');
	// Route::post('dag_school/courses/update/{id}','DagsCourseController@update')->name('update');
});