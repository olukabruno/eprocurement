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

Route::get('/', 'HomeController@index')->name('home');
Route::view('/403', 'errors.403');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/resetpword', 'Auth\ForgotPasswordController@resetpword')->name('resetpword');
Route::get('admin/routes', 'HomeController@admin')->middleware('admin');
//========================================================================================================

//USER RECORD ROUTE
Route::get('delete/{id}', 'RecordsController@destroy')->name('delete_user');
Route::get('edit/{id}', 'RecordsController@edit')->name('edit_view');
Route::patch('edit_user/{id}', 'RecordsController@update');
Route::get('/usermgt', 'RecordsController@registernewPage')->name('user_mgt');
Route::post('/info', 'RecordsController@store');

//=======================================================================================================

//CHANGE PASSWORD ROUTE
Route::get('/changePassword', 'HomeController@showChangePasswordForm');
Route::patch('/changePassword', 'HomeController@changePassword')->name('changePassword');
//=======================================================================================================

//SIGNATORY ROUTES
Route::get('/signatory', 'AssignatoryController@index')->name('rbd');
Route::get('/signatory/aa', 'AssignatoryController@index')->name('aa');
Route::get('/signatory/cash', 'AssignatoryController@index')->name('cash');
Route::get('/signatory/approval', 'AssignatoryController@index')->name('pra');
Route::get('/signatory/technical', 'AssignatoryController@index')->name('twg');

Route::get('signatory/getdata/r', 'AssignatoryController@getPostsR')->name('data.r');
Route::get('signatory/getdata/a', 'AssignatoryController@getPostsA')->name('data.a');
Route::get('signatory/getdata/c', 'AssignatoryController@getPostsC')->name('data.c');
Route::get('signatory/getdata/aa', 'AssignatoryController@getPostsAA')->name('data.aa');


Route::post('/registersignatory', 'AssignatoryController@store');
Route::get('/signatory/edit/{id}', 'AssignatoryController@edit');
Route::patch('signatory/update/{id}', 'AssignatoryController@update');

Route::get('activate/{id}', 'AssignatoryController@ActivateSignatory');
Route::get('deactivate/{id}', 'AssignatoryController@DeactivateSignatory');
Route::get('deletesignatory/{id}', 'AssignatoryController@destroy');
//=======================================================================================================

//SOLE DISTRIBUTOR ROUTES
Route::get('/soledist', 'SoleDistController@index');
Route::post('/soledist/register', 'SoleDistController@store')->name('soledistreg');
Route::get('soledist/delete/{id}', 'SoleDistController@destroy');
//=======================================================================================================


//UNIT ROUTES
Route::get('/unit', 'UnitsController@index')->name('unit.view');
Route::post('/unit/add', 'UnitsController@store')->name('unit.add');
Route::get('/unit/edit/{id}', 'UnitsController@edit')->name('unit.edit');
Route::patch('/unit/update/{id}', 'UnitsController@update')->name('unit.update');
Route::get('/unit/delete/{id}', 'UnitsController@destroy')->name('unit.delete');
//=======================================================================================================

//PURCHASE REQUEST ROUTES
Route::get('pr/view/close', 'PurchaseRequestController@viewAll')->name('pr.bac');
Route::get('pr/view/archive', 'PurchaseRequestController@viewArchive')->name('pr.archive');

Route::get('/pr/revert/{id}', 'PurchaseRequestController@revertpr')->name('pr.revert');
Route::get('/pr/form', 'PurchaseRequestController@index')->name('pr.form');
Route::post('/pr/submit', 'PurchaseRequestController@store');
Route::get('/pr/edit/{id}', 'PurchaseRequestController@edit')->name('pr.edit');
Route::patch('/pr/update/{id}', 'PurchaseRequestController@update');
Route::get('/pr/close/{id}', 'PurchaseRequestController@closePR')->name('pr.close');
Route::get('/pr/delete/{id}', 'PurchaseRequestController@destroy')->name('pr.delete');
//=======================================================================================================

//PR ITEMS ROUTE
Route::get('/pr/items/{id}', 'PurchaseRequestItemController@show')->name('pr.items');
Route::get('/pr/items/close/{id}', 'PurchaseRequestItemController@show2')->name('pr.closeitems');
Route::post('/pr/items/add', 'PurchaseRequestItemController@store')->name('pr.items.add');
Route::get('/pr/items/get/{id}', 'PurchaseRequestItemController@getData');
Route::patch('/update_items/{id}', 'PurchaseRequestItemController@update')->name('pritem.update'); //edit
Route::get('/delete_items/{id}', 'PurchaseRequestItemController@destroy')->name('pr.items.delete');

Route::get('pr/print/{form_no}', 'PurchaseRequestItemController@viewpdf')->name('pr.print');


//=======================================================================================================

//SUPPLEMENTAL PURCHASE REQUEST ROUTES
Route::get('/supplemental', 'SupplementalPRController@index')->name('supplemental');
Route::get('/supplemental/generate/{id}', 'SupplementalPRController@generate')->name('supplemental.generate');
Route::get('/supplemental/getsupplemental', 'SupplementalPRController@getsupplemental')->name('supplemental.getsupplemental');
Route::get('/supplemental/delete/{id}', 'SupplementalPRController@destroy')->name('supplemental.delete');
Route::get('/supplemental/items/{id}', 'SupplementalPRController@items')->name('supplemental.items');
//=======================================================================================================

//RFQ ROUTES
Route::get('/rfq', 'RFQController@index')->name('rfq');
Route::get('/rfq/generate/{id}', 'RFQController@create')->name('rfq.generate');
Route::get('/rfq/print/{form_no}', 'RFQController@print')->name('rfq.print');
Route::get('/rfq/cancel/{id}', 'RFQController@cancel_rfq')->name('rfq.reset');
//=======================================================================================================

//ABSTRACT OF QUOTATION ROUTES
Route::get('/abstract', 'AbstractController@index')->name('abstract.view');
Route::post('/abstract/generate/{id}', 'AbstractController@create')->name('abstract.create');
Route::get('/abstract/form/{id}', 'AbstractController@show')->name('abstract.show');
Route::get('/abstract/cancel/{id}', 'AbstractController@destroy')->name('abstract.cancel');
Route::get('/abstract/print/{id}', 'AbstractController@print')->name('abstract.print');

Route::post('/abstract/supplier', 'AbstractController@store')->name('abstract.supplier');

Route::get('/abstract/edit/{id}', 'AbstractController@edit');

Route::patch('/abstract/update/{id}', 'AbstractController@update')->name('abstract.update');
Route::patch('/abstract/supplier/update/{id}', 'AbstractController@updateSupplier');
Route::get('/abstract/print/{form_no}', 'AbstractController@print')->name('abstract.print');
Route::get('/abstract/supplier/delete/{id}', 'AbstractController@deleteSupplier')->name('supplier.delete');
//=======================================================================================================

//PURCHASE ORDER
Route::get('/lpo', 'purchaseOrderController@index')->name('po.index');
Route::get('/lpo/{form_no}', 'purchaseOrderController@getData');
Route::post('/lpo/submit/{id}', 'purchaseOrderController@store');
Route::get('/lpo/update/{form_no}', 'purchaseOrderController@edit')->name('po.update');
Route::get('/lpo/print/{form_no}', 'purchaseOrderController@print')->name('po.print');
Route::get('/lpo/cancel/{id}', 'purchaseOrderController@destroy')->name('po.cancel');
//=======================================================================================================

//inspection report
Route::get('/ir', 'inspectionReportController@index')->name('ir.index');
Route::get('/ir/{form_no}', 'inspectionReportController@getData');
Route::get('/ir/print/{form_no}', 'inspectionReportController@print')->name('ir.print');
Route::get('/ir/cancel/{id}', 'inspectionReportController@cancel')->name('ir.cancel');
// Route::get('/ir/generate/{id}', 'inspectionReportController@create')->name('ir.generate');
Route::post('/ir/submit/{id}', 'inspectionReportController@create');
Route::get('/ir/edit/{id}', 'inspectionReportController@edit')->name('ir.edit');
Route::put('/ir/update/{id}', 'inspectionReportController@update')->name('ir.update');
//=======================================================================================================

//PPMP
Route::get('/ppmp', 'PpmpController@index')->name('ppmp.index');
Route::get('/ppmp/{id}/print', 'PpmpController@show')->name('ppmp.print');
Route::post('/ppmp/new', 'PpmpController@store')->name('ppmp.store');
Route::get('/ppmp/{id}', 'PpmpController@edit')->name('ppmp.edit');

Route::get('/ppmp/activate/{id}', 'PpmpController@activate')->name('ppmp.activate');
Route::get('/ppmp/deactivate/{id}', 'PpmpController@deactivate')->name('ppmp.deactivate');

Route::get('/ppmp/delete/{id}', 'PpmpController@destroy')->name('ppmp.delete');
Route::post('/ppmp/items/{id}', 'PpmpController@storeItems')->name('ppmp.items');

Route::get('/ppmp/{ppmp}/edit/{id}', 'PpmpController@editItems')->name('ppmpi.edit');
Route::get('/ppmp/{ppmp}/delete/{id}', 'PpmpController@destroyItems')->name('ppmpi.delete');
Route::patch('/ppmp/{ppmp}/items/{id}', 'PpmpController@update')->name('ppmpi.update');
//=======================================================================================================
