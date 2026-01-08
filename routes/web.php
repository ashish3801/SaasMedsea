<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BillingCategoryController;
use App\Http\Controllers\Admin\BillingItemController;
use App\Http\Controllers\Admin\BillingPackageController;
use App\Http\Controllers\Admin\ClinicConroller;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmpController;
use App\Http\Controllers\Admin\MasterContsroller;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\ReportDownloadController;
use App\Http\Controllers\FormTemplateController;
use App\Http\Controllers\TestFormController;
use App\Http\Controllers\Admin\SampleController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\QrRegistrationController;
use App\Models\Company;

Route::get('/', [AuthController::class, 'index'])->name('/');
Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'store'])->name('login');

Route::get('registrations/ajax-get-client', [RegistrationController::class, 'ajaxGet'])->name('ajax.get.registers');

// for company management by super admin
Route::prefix('admin')->middleware(['auth', 'role:super_admin', 'company'])->group(function () {
    Route::resource('company', CompanyController::class);
    Route::get('administrator', [CompanyController::class, 'administratorIndex'])->name('administrator.index');
    Route::get('administrator-create', [CompanyController::class, 'administratorCreate'])->name('administrator.create');
    Route::post('administrator-store', [CompanyController::class, 'administratorStore'])->name('administrator.store');
    Route::get('administrator-show/{id}', [CompanyController::class, 'administratorShow'])->name('administrator.show');
    Route::get('administrator-edit/{id}', [CompanyController::class, 'administratorEdit'])->name('administrator.edit');
    Route::put('administrator-update/{id}', [CompanyController::class, 'administratorUpdate'])->name('administrator.update');
    Route::delete('administrator-destroy/{id}', [CompanyController::class, 'administratorDestroy'])->name('administrator.destroy');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard (super admin always allowed)
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Permission-Based Routes
    |--------------------------------------------------------------------------
    */

    // REGISTRATION
    Route::middleware(['check.permission:registration'])->group(function () {
        Route::resource('registrations', RegistrationController::class);
        Route::get('package-list/{registerId}', [RegistrationController::class, 'packageList'])->name('package.list');
        Route::get('test-list/{registerId}', [RegistrationController::class, 'testList'])->name('test.list');
        Route::post('package-registration', [RegistrationController::class, 'packageForRegister'])->name('package.registration');
        Route::post('test-registration', [RegistrationController::class, 'testForRegister'])->name('test.registration');
        Route::post('get-selected-options', [RegistrationController::class, 'getSelectedOptions']);
        Route::get('package-details/{registerId}', [RegistrationController::class, 'packageDetails'])->name('package.details');
        Route::post('registration/upload-scan-docs', [RegistrationController::class, 'uploadScanDocument'])->name('upload.scan.docs');
        Route::get('/registration/docs/{id}', [RegistrationController::class, 'getDocuments']);
        Route::post('/registration/docs/delete', [RegistrationController::class, 'deleteDoc'])->name('registration.docs.delete');

    });

    // AGENT
    Route::middleware(['check.permission:agent'])->group(function () {
        Route::resource('agents', AgentController::class);
    });

    // EMPLOYEE
    Route::middleware(['check.permission:employee'])->group(function () {
        Route::resource('employees', EmpController::class);
    });

    // CLINIC
    Route::middleware(['check.permission:clinic'])->group(function () {
        Route::resource('clinics', ClinicConroller::class);
        Route::get('/get-doctors/{clinicId}', [ClinicConroller::class, 'getDoctorsByClinic']);
    });

    // BILLINGS
    Route::middleware(['check.permission:billings'])->group(function () {

        Route::middleware(['check.permission:billing_test'])->group(function () {
            Route::resource('billing-items', BillingItemController::class);
        });

        Route::middleware(['check.permission:billing_category'])->group(function () {
            Route::resource('billing-categories', BillingCategoryController::class);
        });

        Route::middleware(['check.permission:billing_package'])->group(function () {
            Route::resource('billing-packages', BillingPackageController::class);
        });

        Route::get('/billing-packages/tests/{category_id}', [BillingPackageController::class, 'getTestsByCategory']);
    });


    // QR REGISTRATIONS
    Route::middleware(['check.permission:qr_registration'])->group(function () {
        Route::get('/qr-registrations', [QrRegistrationController::class, 'index'])->name('qr.registrations.index');
        Route::get('/show-qr-registrations/{id}', [QrRegistrationController::class, 'show'])->name('registrations.qr.show');
        Route::put('/registrations/{id}/accept', [QrRegistrationController::class, 'accept'])->name('registrations.accept');
        Route::put('/registrations/{id}/decline', [QrRegistrationController::class, 'decline'])->name('registrations.decline');
    });


    // DOWNLOAD REPORTS (FREE)
    Route::get('sample-reports', [ReportDownloadController::class, 'samplePdf'])->name('sample-reports');
    
    Route::get('preview-reports', [ReportDownloadController::class, 'previewReport'])->name('preview-reports');
    Route::resource('download-reports', ReportDownloadController::class);
    
    Route::post('rank-store', [MasterContsroller::class, 'rankStore'])->name('rank-store');
    
    // TEST FORM ROUTES (Registration Permission Required)
    Route::middleware(['check.permission:registration'])->group(function () {
        Route::get('/test-forms/{registration}/{category}', [TestFormController::class, 'showTestForms'])->name('test-forms.show');
        Route::post('/save-test-results', [TestFormController::class, 'saveTestResults'])->name('test-results.save');
        Route::post('/save-all-tests', [TestFormController::class, 'saveAllTests'])->name('save-all-tests');
        Route::get('/test-results/{registration}/{category}', [TestFormController::class, 'getTestResults'])->name('test-results.get');
        Route::post('/save-data-approval', [TestFormController::class, 'saveDataApproval'])->name('data-approval.save');
        Route::get('/fetch-data-approval', [TestFormController::class, 'fetchDataApproval']);
    });


    // LOGOUT
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/available-templates', [FormTemplateController::class, 'getAvailableTemplates'])->name('available-templates');
    Route::get('/load-template/{template}', [FormTemplateController::class, 'loadTemplate'])->name('load-template');

    Route::get('/billing-packages/tests/{category_id}', [BillingPackageController::class, 'getTestsByCategory']);
});


// USER ROLE MANAGEMENT
Route::middleware(['auth', 'check.permission:user_role'])->group(function () {
    Route::resource('get-user-role', UserRoleController::class);
    Route::get('get-user-role/access/{id}', [UserRoleController::class, 'editAccess'])->name('user-role.access.edit');
    Route::post('get-user-role/access/{id}', [UserRoleController::class, 'updateAccess'])->name('user-role.access.update');
});

Route::get('download-reports/ilo/{id}', [ReportDownloadController::class, 'iloView'])->name('ilo.view');
Route::get('download-reports/aiv/{id}', [ReportDownloadController::class, 'aivView'])->name('aiv.view');
Route::get('download-reports/av/{id}', [ReportDownloadController::class, 'avView'])->name('av.view');
Route::get('download-reports/dna/{id}', [ReportDownloadController::class, 'dnaView'])->name('dna.view');
Route::get('download-reports/singapore/{id}', [ReportDownloadController::class, 'singaporeView'])->name('singapore.view');
Route::get('download-reports/liberian/{id}', [ReportDownloadController::class, 'liberianView'])->name('liberian.view');
Route::get('download-reports/belize/{id}', [ReportDownloadController::class, 'belizeView'])->name('belize.view');
Route::get('download-reports/vanatau/{id}', [ReportDownloadController::class, 'vanatauView'])->name('vanatau.view');
Route::get('download-reports/marshall/{id}', [ReportDownloadController::class, 'marshallView'])->name('marshall.view');
Route::get('download-reports/bahamas/{id}', [ReportDownloadController::class, 'bahamasView'])->name('bahamas.view');
Route::get('download-reports/oguk/{id}', [ReportDownloadController::class, 'ogukView'])->name('oguk.view');
Route::get('download-reports/malta/{id}', [ReportDownloadController::class, 'maltaView'])->name('malta.view');
Route::get('download-reports/dental/{id}', [ReportDownloadController::class, 'dentalView'])->name('dental.view');
Route::get('download-reports/audiometry/{id}', [ReportDownloadController::class, 'audiometryView'])->name('audiometry.view');

Route::prefix('qr-registration')->group(function () {
    
    // Step 1: Registration Form
    Route::get('/', [SampleController::class, 'registrationQrForm'])->name('qr.registration.form');
    Route::post('/store', [SampleController::class, 'storeFirstForm'])->name('qr.registration.store');

    // Step 2: Declaration Form
    Route::get('/declaration', [SampleController::class, 'showDeclarationForm'])->name('qr.declaration.form');
    Route::post('/declaration/store', [SampleController::class, 'storeDeclaration'])->name('qr.declaration.store');

    // Step 3: Document Upload
    Route::get('/documents', [SampleController::class, 'showUploadDocumentForm'])->name('qr.documents.form');
    Route::post('/documents/store', [SampleController::class, 'storeDocuments'])->name('qr.documents.store');

    // Step 4: Success Page
    Route::get('/success', [SampleController::class, 'showSuccessPage'])->name('qr.registration.success');

    
    Route::post('/clear-session', function () {
        session()->forget('reg_token');
        session()->forget('registration_data');
        session()->forget('medical_declaration');
        session()->forget('qr_registration_id');
        return response()->json(['status' => 'cleared']);
    })->name('clear.registration.session');
});