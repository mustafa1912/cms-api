<?php

use Illuminate\Http\Request;
use App\Models\AddClinicToUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AddBankToUserController;
use App\Http\Controllers\Admin\AddStoreToUserController;
use App\Http\Controllers\Admin\AddClinicToUserController;
use App\Http\Controllers\Admin\AddTreasuryToUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|

| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**      POST    /api/auth/register
 *    POST    /api/auth/login
 *    GET    /api/auth/user-profile
 *    POST    /api/auth/refresh
 *    POST    /api/auth/logout*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', '\App\Http\Controllers\AuthController@register');
    Route::post('/login', '\App\Http\Controllers\AuthController@login');
    Route::get('/user-profile', '\App\Http\Controllers\AuthController@user-profile');
    Route::post('/refresh', '\App\Http\Controllers\AuthController@refresh');
    Route::post('/logout', '\App\Http\Controllers\AuthController@logout');


});
Route::get('/user', '\App\Http\Controllers\AuthController@user');

Route::group([
    'middleware' => 'auth:api',
], function ($router) {
});

//http://localhost:8080/cms/api/
////lab
///
Route::get('show/lab', '\App\Http\Controllers\Admin\LabController@show');
Route::post('store/lab', '\App\Http\Controllers\Admin\LabController@store');
Route::put('update/lab/{id}', '\App\Http\Controllers\Admin\LabController@update');
Route::delete('delete/lab/{id}', '\App\Http\Controllers\Admin\LabController@delete');
////companySitting بيانات الموسسه
Route::get('show/companySitting', '\App\Http\Controllers\Admin\CompanySittingController@show');
Route::post('store/companySitting', '\App\Http\Controllers\Admin\CompanySittingController@store');
Route::put('update/companySitting/{id}', '\App\Http\Controllers\Admin\CompanySittingController@update');
Route::delete('delete/companySitting/{id}', '\App\Http\Controllers\Admin\CompanySittingController@delete');
////user مستخدم
Route::get('show/user', '\App\Http\Controllers\Admin\UserController@show');
Route::post('store/user', '\App\Http\Controllers\Admin\UserController@store');
Route::put('update/user/{id}', '\App\Http\Controllers\Admin\UserController@update');
Route::delete('delete/user/{id}', '\App\Http\Controllers\Admin\UserController@delete');
////doctor اصافه طبيب
Route::get('show/doctor', '\App\Http\Controllers\Admin\DoctorController@show');
Route::post('store/doctor', '\App\Http\Controllers\Admin\DoctorController@store');
Route::put('update/doctor/{id}', '\App\Http\Controllers\Admin\DoctorController@update');
Route::delete('delete/doctor/{id}', '\App\Http\Controllers\Admin\DoctorController@delete');
////percentage Doctor نسب الاطباء
Route::get('show/percentageDoctor', '\App\Http\Controllers\Admin\PercentageDoctorController@show');
Route::post('store/percentageDoctor', '\App\Http\Controllers\Admin\PercentageDoctorController@store');
Route::put('update/percentageDoctor/{id}', '\App\Http\Controllers\Admin\PercentageDoctorController@update');
Route::delete('delete/percentageDoctor/{id}', '\App\Http\Controllers\Admin\PercentageDoctorController@delete');
////department قسم
Route::get('show/department', '\App\Http\Controllers\Admin\DepartmentController@show');
Route::post('store/department', '\App\Http\Controllers\Admin\DepartmentController@store');
Route::put('update/department/{id}', '\App\Http\Controllers\Admin\DepartmentController@update');
Route::delete('delete/department/{id}', '\App\Http\Controllers\Admin\DepartmentController@delete');
//Contracting party جهه التعاقد
Route::get('show/contractingParty', '\App\Http\Controllers\Admin\ContractingPartyController@show');
Route::post('store/contractingParty', '\App\Http\Controllers\Admin\ContractingPartyController@store');
Route::put('update/contractingParty/{id}', '\App\Http\Controllers\Admin\ContractingPartyController@update');
Route::delete('delete/contractingParty/{id}', '\App\Http\Controllers\Admin\ContractingPartyController@delete');

//Contracting party price جهه التعاقد اسعار
Route::get('show/contractingPartyPrice', '\App\Http\Controllers\Admin\contractingPartyPriceController@show');
Route::post('store/contractingPartyPrice', '\App\Http\Controllers\Admin\contractingPartyPriceController@store');
Route::put('update/contractingPartyPrice/{id}', '\App\Http\Controllers\Admin\contractingPartyPriceController@update');
Route::delete('delete/contractingPartyPrice/{id}', '\App\Http\Controllers\Admin\contractingPartyPriceController@delete');
Route::get('show/all/contracting/Party/Price/{id}', '\App\Http\Controllers\Admin\contractingPartyPriceController@showPrice');
//ارسال id العياده واستقبال جهه التعاقد
Route::get('show/contractingParties/for/clinic/{id}', '\App\Http\Controllers\Admin\contractingPartyPriceController@contractingPartiesForClinic');

//Classification اضافه تصنيف
Route::get('show/classification', '\App\Http\Controllers\Admin\classificationController@show');
Route::post('store/classification', '\App\Http\Controllers\Admin\classificationController@store');
Route::put('update/classification/{id}', '\App\Http\Controllers\Admin\classificationController@update');
Route::delete('delete/classification/{id}', '\App\Http\Controllers\Admin\classificationController@delete');
//Service اضافه خدمه
Route::get('show/service', '\App\Http\Controllers\Admin\serviceController@show');
Route::post('store/service', '\App\Http\Controllers\Admin\serviceController@store');
Route::put('update/service/{id}', '\App\Http\Controllers\Admin\serviceController@update');
Route::delete('delete/service/{id}', '\App\Http\Controllers\Admin\serviceController@delete');
//Clinic اضافه قسم او عياده
Route::get('show/clinic', '\App\Http\Controllers\Admin\ClinicController@show');
Route::post('store/clinic', '\App\Http\Controllers\Admin\ClinicController@store');
Route::put('update/clinic/{id}', '\App\Http\Controllers\Admin\ClinicController@update');
Route::delete('delete/clinic/{id}', '\App\Http\Controllers\Admin\ClinicController@delete');
//ClinicDoctor اضافه قسم او عياده لدكتور
Route::get('show/clinicDoctor/{id}', '\App\Http\Controllers\Admin\ClinicDoctorController@show');
Route::post('store/clinicDoctor', '\App\Http\Controllers\Admin\ClinicDoctorController@store');
Route::put('update/clinicDoctor/{id}', '\App\Http\Controllers\Admin\ClinicDoctorController@update');
Route::delete('delete/clinicDoctor/{id}', '\App\Http\Controllers\Admin\ClinicDoctorController@delete');
Route::get('show/all/clinicDoctor/{id}', '\App\Http\Controllers\Admin\ClinicDoctorController@showAll');
Route::get('show/clinicDoctor/have/clinics', '\App\Http\Controllers\Admin\ClinicDoctorController@onlyDoctor');//كل العيادات الي لهادكتور
Route::get('show/only/clinicDoctor/have/Doctors', '\App\Http\Controllers\Admin\ClinicDoctorController@onlyDoctorService');//كل العيادات الي لهادكتور

//ClinicService اضافه خدمه لقسم
Route::get('show/ClinicService/{id}', '\App\Http\Controllers\Admin\ClinicServiceController@show');
Route::post('store/ClinicService', '\App\Http\Controllers\Admin\ClinicServiceController@store');
Route::put('update/ClinicService/{id}', '\App\Http\Controllers\Admin\ClinicServiceController@update');
Route::delete('delete/ClinicService/{id}', '\App\Http\Controllers\Admin\ClinicServiceController@delete');
Route::get('show/all/ClinicService/{id}', '\App\Http\Controllers\Admin\ClinicServiceController@showAll');
Route::get('show/ClinicService/have/service', '\App\Http\Controllers\Admin\ClinicServiceController@onlyClinic');//كل العيادات الي لها اقسام
Route::get('show/only/ClinicService/have/service', '\App\Http\Controllers\Admin\ClinicServiceController@onlyClinicService');//كل العيادات الي لها اقسام

//CompositionType اضافه نوع التركيبه
Route::get('show/CompositionType', '\App\Http\Controllers\Admin\CompositionTypeController@show');
Route::post('store/CompositionType', '\App\Http\Controllers\Admin\CompositionTypeController@store');
Route::put('update/CompositionType/{id}', '\App\Http\Controllers\Admin\CompositionTypeController@update');
Route::delete('delete/CompositionType/{id}', '\App\Http\Controllers\Admin\CompositionTypeController@delete');
//CompositionType اضافه لون التركيبه
Route::get('show/CompositionColor', '\App\Http\Controllers\Admin\CompositionColorController@show');
Route::post('store/CompositionColor', '\App\Http\Controllers\Admin\CompositionColorController@store');
Route::put('update/CompositionColor/{id}', '\App\Http\Controllers\Admin\CompositionColorController@update');
Route::delete('delete/CompositionColor/{id}', '\App\Http\Controllers\Admin\CompositionColorController@delete');
//LabPrice اضافه اسعار المعمل
Route::get('show/LabPrice/{id}', '\App\Http\Controllers\Admin\LabPriceController@show');
Route::post('store/LabPrice', '\App\Http\Controllers\Admin\LabPriceController@store');
Route::put('update/LabPrice/{id}', '\App\Http\Controllers\Admin\LabPriceController@update');
Route::delete('delete/LabPrice/{id}', '\App\Http\Controllers\Admin\LabPriceController@delete');
Route::get('show/all/LabPrice/{id}', '\App\Http\Controllers\Admin\LabPriceController@showAll');

//LabPrice اضافه المقاس المعمل
Route::get('show/LabMeasuring', '\App\Http\Controllers\Admin\LabMeasuringController@show');
Route::post('store/LabMeasuring', '\App\Http\Controllers\Admin\LabMeasuringController@store');
Route::put('update/LabMeasuring/{id}', '\App\Http\Controllers\Admin\LabMeasuringController@update');
Route::delete('delete/LabMeasuring/{id}', '\App\Http\Controllers\Admin\LabMeasuringController@delete');
//Store اضافه المخزن
Route::get('show/Store', '\App\Http\Controllers\Admin\StoreController@show');
Route::post('store/Store', '\App\Http\Controllers\Admin\StoreController@store');
Route::put('update/Store/{id}', '\App\Http\Controllers\Admin\StoreController@update');
Route::delete('delete/Store/{id}', '\App\Http\Controllers\Admin\StoreController@delete');
//Company اضافه شركه
Route::get('show/Company', '\App\Http\Controllers\Admin\CompanyController@show');
Route::post('store/Company', '\App\Http\Controllers\Admin\CompanyController@store');
Route::put('update/Company/{id}', '\App\Http\Controllers\Admin\CompanyController@update');
Route::delete('delete/Company/{id}', '\App\Http\Controllers\Admin\CompanyController@delete');
//Kind اضافه نوع
Route::get('show/Kind', '\App\Http\Controllers\Admin\KindController@show');
Route::post('store/Kind', '\App\Http\Controllers\Admin\KindController@store');
Route::put('update/Kind/{id}', '\App\Http\Controllers\Admin\KindController@update');
Route::delete('delete/Kind/{id}', '\App\Http\Controllers\Admin\KindController@delete');
//Measuring اضافه مقاس
Route::get('show/Measuring', '\App\Http\Controllers\Admin\MeasuringController@show');
Route::post('store/Measuring', '\App\Http\Controllers\Admin\MeasuringController@store');
Route::put('update/Measuring/{id}', '\App\Http\Controllers\Admin\MeasuringController@update');
Route::delete('delete/Measuring/{id}', '\App\Http\Controllers\Admin\MeasuringController@delete');
//Unit اضافه وحده
Route::get('show/Unit', '\App\Http\Controllers\Admin\UnitController@show');
Route::post('store/Unit', '\App\Http\Controllers\Admin\UnitController@store');
Route::put('update/Unit/{id}', '\App\Http\Controllers\Admin\UnitController@update');
Route::delete('delete/Unit/{id}', '\App\Http\Controllers\Admin\UnitController@delete');


//Supplier الموردين
Route::get('show/Supplier', '\App\Http\Controllers\Admin\SupplierController@show');
Route::post('store/Supplier', '\App\Http\Controllers\Admin\SupplierController@store');
Route::put('update/Supplier/{id}', '\App\Http\Controllers\Admin\SupplierController@update');
Route::delete('delete/Supplier/{id}', '\App\Http\Controllers\Admin\SupplierController@delete');
//PurchasesInvoice فاتوره مشتروات
Route::get('show/PurchasesInvoice', '\App\Http\Controllers\Admin\PurchasesInvoiceController@show');
Route::post('store/PurchasesInvoice', '\App\Http\Controllers\Admin\PurchasesInvoiceController@store');
Route::put('update/PurchasesInvoice/{id}', '\App\Http\Controllers\Admin\PurchasesInvoiceController@update');
Route::delete('delete/PurchasesInvoice/{id}', '\App\Http\Controllers\Admin\PurchasesInvoiceController@delete');
//InvoiceReturned مرتجع فاتوره
Route::get('show/InvoiceReturned', '\App\Http\Controllers\Admin\InvoiceReturnedController@show');
Route::post('store/InvoiceReturned', '\App\Http\Controllers\Admin\InvoiceReturnedController@store');
Route::put('update/InvoiceReturned/{id}', '\App\Http\Controllers\Admin\InvoiceReturnedController@update');
Route::delete('delete/InvoiceReturned/{id}', '\App\Http\Controllers\Admin\InvoiceReturnedController@delete');
//VendorAccounts حسابات الموريدين
Route::get('show/VendorAccounts', '\App\Http\Controllers\Admin\VendorAccountsController@show');
Route::post('store/VendorAccounts', '\App\Http\Controllers\Admin\VendorAccountsController@store');
Route::put('update/VendorAccounts/{id}', '\App\Http\Controllers\Admin\VendorAccountsController@update');
Route::delete('delete/VendorAccounts/{id}', '\App\Http\Controllers\Admin\VendorAccountsController@delete');
//DiscountOrAddNotice اشعار خصم او اضافه
Route::get('show/DiscountOrAddNotice', '\App\Http\Controllers\Admin\DiscountOrAddNoticeController@show');
Route::post('store/DiscountOrAddNotice', '\App\Http\Controllers\Admin\DiscountOrAddNoticeController@store');
Route::put('update/DiscountOrAddNotice/{id}', '\App\Http\Controllers\Admin\DiscountOrAddNoticeController@update');
Route::delete('delete/DiscountOrAddNotice/{id}', '\App\Http\Controllers\Admin\DiscountOrAddNoticeController@delete');
//patient اضافه مريض
Route::get('show/Patient', '\App\Http\Controllers\Admin\PatientController@show');
Route::post('store/Patient', '\App\Http\Controllers\Admin\PatientController@store');
Route::put('update/Patient/{id}', '\App\Http\Controllers\Admin\PatientController@update');
Route::delete('delete/Patient/{id}', '\App\Http\Controllers\Admin\PatientController@delete');
//PatientReception قبال مريض
Route::get('show/PatientReception', '\App\Http\Controllers\Admin\PatientReceptionController@show');
Route::post('store/PatientReception', '\App\Http\Controllers\Admin\PatientReceptionController@store');
Route::put('update/PatientReception/{id}', '\App\Http\Controllers\Admin\PatientReceptionController@update');
Route::delete('delete/PatientReception/{id}', '\App\Http\Controllers\Admin\PatientReceptionController@delete');
Route::post('report/PatientReception', '\App\Http\Controllers\Admin\PatientReceptionController@reportFromTo');
//LabRequest طلب تركيبه معمل
Route::get('show/LabRequest', '\App\Http\Controllers\Admin\LabRequestController@show');
Route::post('store/LabRequest', '\App\Http\Controllers\Admin\LabRequestController@store');
Route::put('update/LabRequest/{id}', '\App\Http\Controllers\Admin\LabRequestController@update');
Route::delete('delete/LabRequest/{id}', '\App\Http\Controllers\Admin\LabRequestController@delete');
//ReceivingFixtures طلب تركيبه معمل
Route::get('show/ReceivingFixtures', '\App\Http\Controllers\Admin\ReceivingFixturesController@show');
Route::post('store/ReceivingFixtures', '\App\Http\Controllers\Admin\ReceivingFixturesController@store');
Route::put('update/ReceivingFixtures/{id}', '\App\Http\Controllers\Admin\ReceivingFixturesController@update');
Route::delete('delete/ReceivingFixtures/{id}', '\App\Http\Controllers\Admin\ReceivingFixturesController@delete');
//Specialties تخصص اضافه
Route::get('show/Specialties', '\App\Http\Controllers\Admin\SpecialtiesController@show');
Route::post('store/Specialties', '\App\Http\Controllers\Admin\SpecialtiesController@store');
Route::put('update/Specialties/{id}', '\App\Http\Controllers\Admin\SpecialtiesController@update');
Route::delete('delete/Specialties/{id}', '\App\Http\Controllers\Admin\SpecialtiesController@delete');
//ScientificDegree اضافه درجه علميه
Route::get('show/ScientificDegree', '\App\Http\Controllers\Admin\ScientificDegreeController@show');
Route::post('store/ScientificDegree', '\App\Http\Controllers\Admin\ScientificDegreeController@store');
Route::put('update/ScientificDegree/{id}', '\App\Http\Controllers\Admin\ScientificDegreeController@update');
Route::delete('delete/ScientificDegree/{id}', '\App\Http\Controllers\Admin\ScientificDegreeController@delete');
//Bank اضافه بنك
Route::get('show/Bank', '\App\Http\Controllers\Admin\BankController@show');
Route::post('store/Bank', '\App\Http\Controllers\Admin\BankController@store');
Route::put('update/Bank/{id}', '\App\Http\Controllers\Admin\BankController@update');
Route::delete('delete/Bank/{id}', '\App\Http\Controllers\Admin\BankController@delete');
Route::get('show/Bank/steps', '\App\Http\Controllers\Admin\BankController@steps');
Route::get('show/Bank/days', '\App\Http\Controllers\Admin\BankController@days');

//Treasury اضافه حزنه
Route::get('show/Treasury', '\App\Http\Controllers\Admin\TreasuryController@show');
Route::post('store/Treasury', '\App\Http\Controllers\Admin\TreasuryController@store');
Route::put('update/Treasury/{id}', '\App\Http\Controllers\Admin\TreasuryController@update');
Route::delete('delete/Treasury/{id}', '\App\Http\Controllers\Admin\TreasuryController@delete');
Route::get('show/Treasury/steps', '\App\Http\Controllers\Admin\TreasuryController@steps');
Route::get('show/Treasury/days', '\App\Http\Controllers\Admin\TreasuryController@days');

//General accounts الحسابات العامه
Route::get('show/GeneralAccounts', '\App\Http\Controllers\Admin\GeneralAccountsController@show');
Route::post('store/GeneralAccounts', '\App\Http\Controllers\Admin\GeneralAccountsController@store');
Route::put('update/GeneralAccounts/{id}', '\App\Http\Controllers\Admin\GeneralAccountsController@update');
Route::delete('delete/GeneralAccounts/{id}', '\App\Http\Controllers\Admin\GeneralAccountsController@delete');

//Bank to  bank التحويل من بنك لبنك
Route::get('show/BankToBank', '\App\Http\Controllers\Admin\BankToBankController@show');
Route::post('store/BankToBank', '\App\Http\Controllers\Admin\BankToBankController@store');
Route::put('update/BankToBank/{id}', '\App\Http\Controllers\Admin\BankToBankController@update');
Route::delete('delete/BankToBank/{id}', '\App\Http\Controllers\Admin\BankToBankController@delete');
//Treasury to  Treasury التحويل من خزينه الي خزينه
Route::get('show/TreasuryToTreasury', '\App\Http\Controllers\Admin\TreasuryToTreasuryController@show');
Route::post('store/TreasuryToTreasury', '\App\Http\Controllers\Admin\TreasuryToTreasuryController@store');
Route::put('update/TreasuryToTreasury/{id}', '\App\Http\Controllers\Admin\TreasuryToTreasuryController@update');
Route::delete('delete/TreasuryToTreasury/{id}', '\App\Http\Controllers\Admin\TreasuryToTreasuryController@delete');

//Bank to  Treasury التحويل من بنك الي خزينه
Route::get('show/BankToTreasury', '\App\Http\Controllers\Admin\BankToTreasuryController@show');
Route::post('store/BankToTreasury', '\App\Http\Controllers\Admin\BankToTreasuryController@store');
Route::put('update/BankToTreasury/{id}', '\App\Http\Controllers\Admin\BankToTreasuryController@update');
Route::delete('delete/BankToTreasury/{id}', '\App\Http\Controllers\Admin\BankToTreasuryController@delete');
//Treasury to  Bank التحويل من خزينه الي بنك
Route::get('show/TreasuryToBank', '\App\Http\Controllers\Admin\TreasuryToBankController@show');
Route::post('store/TreasuryToBank', '\App\Http\Controllers\Admin\TreasuryToBankController@store');
Route::put('update/TreasuryToBank/{id}', '\App\Http\Controllers\Admin\TreasuryToBankController@update');
Route::delete('delete/TreasuryToBank/{id}', '\App\Http\Controllers\Admin\TreasuryToBankController@delete');
//معلومات المريض
Route::get('/show/data/patientData/{id}', 'App\Http\Controllers\Admin\PatientController@patientData');
//items الاصناف////////////////////////////////////////////////////////////////////////////////
Route::get('show/Item', '\App\Http\Controllers\Admin\ItemController@show');
Route::get('show/items/Tables/{id}', '\App\Http\Controllers\Admin\ItemController@showTables');
Route::post('store/Item', '\App\Http\Controllers\Admin\ItemController@store');
Route::put('update/Item/{id}', '\App\Http\Controllers\Admin\ItemController@update');
Route::delete('delete/Item/{id}', '\App\Http\Controllers\Admin\ItemController@delete');
//Stocking تسويه كميات المخزن
Route::get('show/Stocking', '\App\Http\Controllers\Admin\StockingController@show');
Route::get('show/Stocking/Tables/{id}', '\App\Http\Controllers\Admin\StockingController@showTables');
Route::post('store/Stocking', '\App\Http\Controllers\Admin\StockingController@store');
Route::put('update/Stocking/{id}', '\App\Http\Controllers\Admin\StockingController@update');
Route::delete('delete/Stocking/{id}', '\App\Http\Controllers\Admin\StockingController@delete');
//Exchange permission اذن صرف
Route::get('show/ExchangePermission', '\App\Http\Controllers\Admin\ExchangePermissionController@show');
Route::get('show/ExchangePermission/Tables/{id}', '\App\Http\Controllers\Admin\ExchangePermissionController@showTables');
Route::post('store/ExchangePermission', '\App\Http\Controllers\Admin\ExchangePermissionController@store');
Route::put('update/ExchangePermission/{id}', '\App\Http\Controllers\Admin\ExchangePermissionController@update');
Route::delete('delete/ExchangePermission/{id}', '\App\Http\Controllers\Admin\ExchangePermissionController@delete');
//Mortal  الهالك
Route::get('show/Mortal', '\App\Http\Controllers\Admin\MortalController@show');
Route::get('show/Mortal/Tables/{id}', '\App\Http\Controllers\Admin\MortalController@showTables');
Route::post('store/Mortal', '\App\Http\Controllers\Admin\MortalController@store');
Route::put('update/Mortal/{id}', '\App\Http\Controllers\Admin\MortalController@update');
Route::delete('delete/Mortal/{id}', '\App\Http\Controllers\Admin\MortalController@delete');
//Store To Store  التحويل من محزن لمحزن
Route::get('show/StoreToStore', '\App\Http\Controllers\Admin\StoreToStoreController@show');
Route::get('show/StoreToStore/Tables/{id}', '\App\Http\Controllers\Admin\StoreToStoreController@showTables');
Route::post('store/StoreToStore', '\App\Http\Controllers\Admin\StoreToStoreController@store');
Route::put('update/StoreToStore/{id}', '\App\Http\Controllers\Admin\StoreToStoreController@update');
Route::delete('delete/StoreToStore/{id}', '\App\Http\Controllers\Admin\StoreToStoreController@delete');
//InventoryOfTheStore  جرد المحزن
Route::get('show/InventoryOfTheStore', '\App\Http\Controllers\Admin\InventoryOfTheStoreController@show');
Route::get('show/InventoryOfTheStore/Tables/{id}', '\App\Http\Controllers\Admin\InventoryOfTheStoreController@showTables');
Route::post('store/InventoryOfTheStore', '\App\Http\Controllers\Admin\InventoryOfTheStoreController@store');
Route::put('update/InventoryOfTheStore/{id}', '\App\Http\Controllers\Admin\InventoryOfTheStoreController@update');
Route::delete('delete/InventoryOfTheStore/{id}', '\App\Http\Controllers\Admin\InventoryOfTheStoreController@delete');
//DoctorIncomeExpenses ايرادات ومصروفات دكتور
Route::get('show/DoctorIncomeExpenses', '\App\Http\Controllers\Admin\DoctorIncomeExpensesController@show');
Route::post('store/DoctorIncomeExpenses', '\App\Http\Controllers\Admin\DoctorIncomeExpensesController@store');
Route::put('update/DoctorIncomeExpenses/{id}', '\App\Http\Controllers\Admin\DoctorIncomeExpensesController@update');
Route::delete('delete/DoctorIncomeExpenses/{id}', '\App\Http\Controllers\Admin\DoctorIncomeExpensesController@delete');
//contractingPartyIncomeExpenses ايرادات ومصروفات جهه التعاقد
Route::get('show/contractingPartyIncomeExpenses', '\App\Http\Controllers\Admin\contractingPartyIncomeExpensesController@show');
Route::post('store/contractingPartyIncomeExpenses', '\App\Http\Controllers\Admin\contractingPartyIncomeExpensesController@store');
Route::put('update/contractingPartyIncomeExpenses/{id}', '\App\Http\Controllers\Admin\contractingPartyIncomeExpensesController@update');
Route::delete('delete/contractingPartyIncomeExpenses/{id}', '\App\Http\Controllers\Admin\contractingPartyIncomeExpensesController@delete');
//LabIncomeExpenses ايرادات ومصروفات جهه التعاقد
Route::get('show/LabIncomeExpenses', '\App\Http\Controllers\Admin\LabIncomeExpensesController@show');
Route::post('store/LabIncomeExpenses', '\App\Http\Controllers\Admin\LabIncomeExpensesController@store');
Route::put('update/LabIncomeExpenses/{id}', '\App\Http\Controllers\Admin\LabIncomeExpensesController@update');
Route::delete('delete/LabIncomeExpenses/{id}', '\App\Http\Controllers\Admin\LabIncomeExpensesController@delete');
////////مصروفات عامه
Route::get('show/GeneralAccountIncomeExpenses', '\App\Http\Controllers\Admin\GeneralAccountIncomeExpensesController@show');
Route::post('store/GeneralAccountIncomeExpenses', '\App\Http\Controllers\Admin\GeneralAccountIncomeExpensesController@store');
Route::put('update/GeneralAccountIncomeExpenses/{id}', '\App\Http\Controllers\Admin\GeneralAccountIncomeExpensesController@update');
Route::delete('delete/GeneralAccountIncomeExpenses/{id}', '\App\Http\Controllers\Admin\GeneralAccountIncomeExpensesController@delete');



// Ahmed Abdelwahab

// اضافة عيادة مستخدم
Route::get('show/user/clinic', [AddClinicToUserController::class , 'show']);
Route::post('store/user/clinic', [AddClinicToUserController::class , 'store']);
Route::put('update/user/clinic/{id}', [AddClinicToUserController::class , 'update']);
Route::delete('delete/user/clinic/{id}', [AddClinicToUserController::class , 'delete']);

// اضافة متجر لمستخدم
Route::get('show/user/store', [AddStoreToUserController::class , 'show']);
Route::post('create/user/store', [AddStoreToUserController::class , 'store']);
Route::put('update/user/store/{id}', [AddStoreToUserController::class , 'update']);
Route::get('delete/user/store/{id}', [AddStoreToUserController::class , 'delete']);

// اضافة خزنة لستخدم
Route::get('show/user/treasury', [AddTreasuryToUserController::class , 'show']);
Route::post('create/user/treasury', [AddTreasuryToUserController::class , 'store']);
Route::put('update/user/treasury/{id}', [AddTreasuryToUserController::class , 'update']);
Route::delete('delete/user/treasury/{id}', [AddTreasuryToUserController::class , 'delete']);

// اضافة بنك لمستخدم
Route::get('show/user/bank', [AddBankToUserController::class , 'show']);
Route::post('create/user/bank', [AddBankToUserController::class , 'store']);
Route::put('update/user/bank/{id}', [AddBankToUserController::class , 'update']);
Route::delete('delete/user/bank/{id}', [AddBankToUserController::class , 'delete']);
