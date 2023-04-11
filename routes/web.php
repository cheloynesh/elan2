<?php

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

// Route::get('/', function () {
//     return view('auth/login');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// perfiles
Route::get('admin/profile/profiles/GetInfo/{id}','ProfilesController@GetInfo')->name('profiles.GetInfo');
Route::resource('admin/profile/profiles', 'ProfilesController');

// aseguradoras
Route::resource('admin/insurance/insurances', 'InsuranceController');
Route::get('admin/insurance/insurances/GetInfo/{id}','InsuranceController@GetInfo')->name('insurance.GetInfo');
Route::get('admin/insurance/insurances/getBranches/{id}','InsuranceController@getBranches')->name('insurance.getBranches');
Route::post('admin/insurance/insurances/saveBranch', 'InsuranceController@saveBranch')->name('insurance.saveBranch');
Route::post('admin/insurance/insurances/deleteBranch', 'InsuranceController@deleteBranch')->name('insurance.deleteBranch');
Route::post('admin/insurance/insurances/saveNewBranch', 'InsuranceController@saveNewBranch')->name('insurance.saveNewBranch');
Route::get('admin/insurance/insurances/getPlans/{branch}/{insurance}','InsuranceController@getPlans')->name('insurance.getPlans');
Route::post('admin/insurance/insurances/savePlan', 'InsuranceController@savePlan')->name('insurance.savePlan');
Route::post('admin/insurance/insurances/deletePlan', 'InsuranceController@deletePlan')->name('insurance.deletePlan');
Route::post('admin/insurance/insurances/saveNewPlan', 'InsuranceController@saveNewPlan')->name('insurance.saveNewPlan');

// prueba
Route::get('admin/pruebas/prueba/GetInfo/{id}','PruebasController@GetInfo')->name('prueba.GetInfo');
Route::resource('admin/pruebas/prueba', 'PruebasController');

// usuarios
Route::resource('admin/users/user', 'UsersController');
Route::get('admin/users/user/GetInfo/{id}','UsersController@GetInfo')->name('user.GetInfo');

// clientes
Route::resource('admin/client/client', 'ClientsController');
Route::get('admin/client/client/GetInfo/{id}','ClientsController@GetInfo')->name('client.GetInfo');
Route::post('admin/client/client/saveEnterprise', 'ClientsController@saveEnterprise')->name('client.saveEnterprise');
Route::get('admin/client/client/GetInfoE/{id}','ClientsController@GetInfoE')->name('client.GetInfoE');
Route::post('admin/client/client/updateEnterprise', 'ClientsController@updateEnterprise')->name('client.updateEnterprise');
Route::delete('admin/client/client/destroyEnterprise/{id}','ClientsController@destroyEnterprise')->name('cliente.destroyEnterprise');

// permisos
Route::resource('admin/permission/permissions', 'PermissionsController');
Route::get('admin/permission/permissions/{id}/{id_seccion?}/{btn?}/{reference?}',[ 'uses' => 'PermissionsController@update_store', 'as' => 'admin.permission.update_store']);
Route::post('admin/permission/permissions/update_store','PermissionsController@update_store')->name('permissions.update_store');

//Tipo de solicitud
Route::resource('admin/applications/application', 'ApplicationsController');
Route::get('admin/applications/application/GetInfo/{id}','ApplicationsController@GetInfo')->name('application.GetInfo');

// moneda
Route::resource('admin/currency/currencies', 'CurrencyController');
Route::get('admin/currency/currencies/GetInfo/{id}','CurrencyController@GetInfo')->name('currencies.GetInfo');

// Ramo
Route::resource('admin/branch/branches', 'BranchController');
Route::get('admin/branch/branches/GetInfo/{id}','BranchController@GetInfo')->name('branches.GetInfo');

// Plan
Route::resource('admin/plan/plans', 'PlansController');
Route::get('admin/plan/plans/GetInfo/{id}','PlansController@GetInfo')->name('plans.GetInfo');

// Cálculo de Cobro
Route::resource('admin/charge/charges', 'ChargeController');
Route::get('admin/charge/charges/GetInfo/{id}','ChargeController@GetInfo')->name('charges.GetInfo');

// Formas de pago
Route::resource('admin/payment_forms/payment_form', 'PaymentFormsController');
Route::get('admin/payment_forms/payment_form/GetInfo/{id}','PaymentFormsController@GetInfo')->name('payment_form.GetInfo');

// ------------------------------------Proceso OT--------------------------------------------------
// Proceso Iniciales
Route::resource('processes/OT/Initials/initial', 'InitialController');
Route::get('processes/OT/Initials/initial/GetInfo/{id}','InitialController@GetInfo')->name('initial.GetInfo');
Route::post('processes/OT/Initials/initial/updateStatus', 'InitialController@updateStatus')->name('initial.updateStatus');
Route::get('processes/OT/Initials/initial/getBranches/{insurance}','InitialController@getBranches')->name('initial.getBranches');
Route::get('processes/OT/Initials/initial/getPlans/{insurance}/{branch}','InitialController@getPlans')->name('initial.getPlans');
Route::get('processes/OT/Initials/initial/GetinfoStatus/{id}','InitialController@GetinfoStatus')->name('initial.GetinfoStatus');
Route::get('processes/OT/Initials/initial/ExportInitials/{status}/{branch}','InitialController@ExportInitials');
Route::get('processes/OT/Initials/initial/GetPolicyInfo/{id}','InitialController@GetPolicyInfo')->name('initial.GetPolicyInfo');

// Proceso Servicios
Route::resource('processes/OT/services/service', 'ServicesController');
Route::get('processes/OT/services/service/GetInfo/{id}','ServicesController@GetInfo')->name('service.GetInfo');
Route::post('processes/OT/services/service/updateStatus', 'ServicesController@updateStatus')->name('service.updateStatus');
Route::get('processes/OT/services/service/GetinfoStatus/{id}','ServicesController@GetinfoStatus')->name('service.GetinfoStatus');
Route::get('processes/OT/services/service/GetPolicyInfo/{id}','ServicesController@GetPolicyInfo')->name('service.GetPolicyInfo');
Route::get('processes/OT/services/service/getBranches/{insurance}','ServicesController@getBranches')->name('service.getBranches');
Route::get('processes/OT/services/service/ExportService/{status}/{branch}','ServicesController@ExportService');

// Proceso Reembolsos
Route::resource('processes/OT/refunds/refunds', 'RefundsController');
Route::get('processes/OT/refunds/refunds/GetInfo/{id}','RefundsController@GetInfo')->name('refunds.GetInfo');
Route::post('processes/OT/refunds/refunds/updateStatus', 'RefundsController@updateStatus')->name('refunds.updateStatus');
Route::get('processes/OT/refunds/refunds/GetinfoStatus/{id}','RefundsController@GetinfoStatus')->name('refunds.GetinfoStatus');
Route::get('processes/OT/refunds/refunds/getBranches/{insurance}','RefundsController@getBranches')->name('refunds.getBranches');
Route::get('processes/OT/refunds/refunds/ExportRefunds/{status}/{branch}','RefundsController@ExportRefunds');

// ------------------------------------Polizas--------------------------------------------------
// polizas
Route::resource('policies/policy','PoliciesController');
Route::get('policies/policy/GetInfo/{id}','PoliciesController@GetInfo')->name('policy.GetInfo');
Route::get('policies/policy/CheckPolicy/{id}','PoliciesController@CheckPolicy')->name('policy.CheckPolicy');
Route::post('policies/policy/CheckDate',  'PoliciesController@CheckDate')->name('policy.CheckDate');
Route::get('policies/policy/getBranches/{insurance}','InitialController@getBranches')->name('initial.getBranches');
Route::get('policies/policy/getPlans/{insurance}/{branch}','InitialController@getPlans')->name('initial.getPlans');
// Route::post('policies/policy/savepolicy', 'PoliciesController@savepolicy')->name('policy.savepolicy');

//Ver Polizas
Route::resource('policies/viewPolicies','ViewPoliciesController');
Route::get('policies/viewPolicies/ViewReceipts/{id}','ViewPoliciesController@ViewReceipts')->name('viewPolicies.ViewReceipts');
Route::get('policies/viewPolicies/GetInfo/{id}','ViewPoliciesController@GetInfo')->name('viewPolicies.GetInfo');
Route::get('policies/viewPolicies/GetInfoClient/{id}','ViewPoliciesController@GetInfoClient')->name('viewPolicies.GetInfoClient');
Route::post('policies/viewPolicies/paypolicy', 'ViewPoliciesController@paypolicy')->name('viewPolicies.paypolicy');
Route::post('policies/viewPolicies/cancelpaypolicy', 'ViewPoliciesController@cancelpaypolicy')->name('viewPolicies.cancelpaypolicy');
Route::post('policies/viewPolicies/updateStatus', 'ViewPoliciesController@updateStatus')->name('viewPolicies.updateStatus');
Route::get('policies/viewPolicies/getBranches/{insurance}','InitialController@getBranches')->name('initial.getBranches');
Route::get('policies/viewPolicies/getPlans/{insurance}/{branch}','InitialController@getPlans')->name('initial.getPlans');
Route::post('policies/viewPolicies/updatePolicies', 'ViewPoliciesController@updatePolicies')->name('viewPolicies.updatePolicies');
Route::get('policies/viewPolicies/updatePoliciesNet/{id}', 'ViewPoliciesController@updatePoliciesNet')->name('viewPolicies.updatePoliciesNet');
Route::get('policies/viewPolicies/ExportPolicy/{status}/{branch}','ViewPoliciesController@ExportPolicy');

// cobranza
Route::resource('policies/collection','CollectionController');
Route::get('policies/collection/GetInfo/{id}','CollectionController@GetInfo')->name('collection.GetInfo');

//reportes
Route::resource('reports/duepay/duepay','DuePayController');
Route::get('reports/duepay/duepay/GetInfo/{id}','DuePayController@GetInfo')->name('duePay.GetInfo');
Route::get('reports/duepay/duepay/GetInfoFilters/{id}','DuePayController@GetInfoFilters')->name('duePay.GetInfoFilters');




