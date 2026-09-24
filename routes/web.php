<?php

use App\Enums\RequestDecision;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentBudgetsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestDisbursementController;
use App\Http\Controllers\RequestDocumentController;
use App\Http\Controllers\RequestManagementController;
use App\Http\Controllers\UserController;
use App\Models\RequestModel;
use App\Models\RequestStep;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/employees', [EmployeeController::class, 'index'])
        ->name('employees.index');

    Route::get('/employees-create', [EmployeeController::class, 'create'])
        ->name('employees.create');

    Route::get('/employees-{employee}-profile', [EmployeeController::class, 'profile'])
        ->name('employees.profile');

    Route::post('/employees', [EmployeeController::class, 'store'])
        ->name('employees.store');

    Route::get(
        '/employees-{employee}-edit',
        [EmployeeController::class, 'edit']
    )->name('employees.edit');

    Route::put(
        '/employees-{employee}-update',
        [EmployeeController::class, 'update']
    )->name('employees.update');

    Route::delete(
        '/employees-{employee}-delete',
        [EmployeeController::class, 'destroy']
    )->name('employees.destroy');



    Route::get('/get-sections/{department}', [EmployeeController::class, 'getSections'])
        ->name('employee.sections');

    Route::get('/get-job-titles/{section}', [EmployeeController::class, 'getJobTitles'])
        ->name('employee.job_titles');

    Route::get('/departments', [DepartmentController::class, 'index'])
        ->name('departments.index');

    Route::post('/departments', [DepartmentController::class, 'store'])
        ->name('departments.store');


    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/roles', [UserController::class, 'role'])
        ->name('roles.index');

    Route::get('/roles-{role}-edit', [UserController::class, 'editRole']) ->name('roles.edit');

    Route::put('/roles-{role}', [UserController::class, 'updateRole']) ->name('roles.update');

    Route::get('/users-{user}-edit', [UserController::class, 'edit']) ->name('users.edit');
    Route::put('/users-{user}', [UserController::class, 'update']) ->name('users.update');

    Route::get('/audit-logs', [AuditLogController::class, 'index'])
        ->name('audit-logs.index');

    Route::get('/audit-logs/{auditLog}', [AuditLogController::class, 'show'])
        ->name('audit-logs.show');

    Route::get('/requests', [RequestController::class, 'index'])
        ->name('requests.index');



//    Route::view('/profile', 'profile')->name('profile');


    /*
|--------------------------------------------------------------------------
| REQUESTS
|--------------------------------------------------------------------------
*/

    // Liste des demandes
    Route::get('/requests', [RequestManagementController::class, 'index',])->name('requests.index');
    Route::get('/requests-create', [RequestManagementController::class, 'create',])->name('requests.create');
    Route::post('/requests', [RequestManagementController::class, 'store',])->name('requests.store');

    Route::get('/requests-{requestModel}', [RequestManagementController::class, 'show',])->name('requests.show');


//     finance

    Route::get(
        '/department-budgets',
        [\App\Http\Controllers\DepartmentBudgetsController::class, 'departmentBudgets']
    )->name('finance.department-budgets');

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');



});



Route::middleware([
    'auth',
    'verified',
])->group(function () {

    /*
     * =========================================================
     * PENDING REQUESTS
     * =========================================================
     */
    Route::get(
        '/procurement-pending',
        [
            RequestManagementController::class,
            'ProcurementPending'
        ]
    )->name(
        'procurement.pending'
    );


    /*
     * =========================================================
     * PROCESS REQUEST
     * =========================================================
     */
    Route::get(
        '/procurement-requests-{requestModel}-process',
        [
            RequestManagementController::class,
            'processProcurement'
        ]
    )->name(
        'procurement.requests.process'
    );


    /*
     * =========================================================
     * APPROVE REQUEST
     * =========================================================
     */
    Route::post(
        '/procurement/requests/{requestModel}/approve',
        [
            RequestManagementController::class,
            'approveProcurement'
        ]
    )->name(
        'procurement.requests.approve'
    );


    /*
     * =========================================================
     * REJECT REQUEST
     * =========================================================
     */
    Route::post(
        '/procurement/requests/{requestModel}/reject',
        [
            RequestManagementController::class,
            'rejectProcurement'
        ]
    )->name(
        'procurement.requests.reject'
    );


    Route::get(
        '/requests-approved',
        [RequestManagementController::class, 'approvedProcurementRequests']
    )->name('requests.approved');

    Route::get(
        '/requests-rejected',
        [RequestManagementController::class, 'rejectedRProcurementequests']
    )->name('procurement.requests.rejected');


//         finance

    Route::get(
        '/finance-pending',
        [
            RequestManagementController::class,
            'FinancePending'
        ]
    )->name(
        'finance.pending'
    );


    Route::get(
        '/finance-requests-{requestModel}-process',
        [
            RequestManagementController::class,
            'processFinance',
        ]
    )->name(
        'finance.requests.process');

    Route::post(
        '/finance/requests/{requestModel}/approve',
        [RequestManagementController::class, 'approveFinanceRequest']
    )->name('finance.requests.approve');

    Route::post(
        '/finance/requests/{requestModel}/reject',
        [RequestManagementController::class, 'rejectFinanceRequest']
    )->name('finance.requests.reject');


    Route::get(
        '/finance-approved',
        [RequestManagementController::class, 'approvedFinanceRequests']
    )->name('finance.approved');


    Route::get(
        '/rejected',
        [RequestManagementController::class, 'rejectedFinanceRequests']
    )->name('finance.rejected');



//    ceo

    /*
|--------------------------------------------------------------------------
| CEO
|--------------------------------------------------------------------------
*/

    Route::get(
        '/ceo-pending',
        [RequestManagementController::class, 'CeoPending']
    )->name('ceo.pending');


    Route::get(
        '/ceo-requests-{requestModel}-process',
        [RequestManagementController::class, 'processCeo']
    )->name('ceo.requests.process');


    Route::post(
        '/ceo-requests-{requestModel}-approve',
        [RequestManagementController::class, 'approveCeoRequest']
    )->name('ceo.requests.approve');


    Route::post(
        '/ceo-requests-{requestModel}-reject',
        [RequestManagementController::class, 'cancelCeoRequest']
    )->name('ceo.requests.reject');


    Route::get(
        '/ceo-approved',
        [RequestManagementController::class, 'approvedCeoRequests']
    )->name('ceo.approved');


    Route::get(
        '/ceo-rejected',
        [RequestManagementController::class, 'rejectedCeoRequests']
    )->name('ceo.rejected');


// end ceo


    Route::get(
        '/finance-department-budgets-create-{department}',
        [DepartmentBudgetsController::class, 'create']
    )->name('finance.department-budgets.create');

    Route::post(
        '/finance-department-budgets',
        [DepartmentBudgetsController::class, 'store']
    )->name('finance.department-budgets.store');


    Route::get(
        '/finance-department-budgets-edit-{departmentBudget}',
        [DepartmentBudgetsController::class, 'edit']
    )->name('finance.department-budgets.edit');

    Route::put(
        '/finance-department-budgets-{departmentBudget}',
        [DepartmentBudgetsController::class, 'update']
    )->name('finance.department-budgets.update');

//    Route::resource('quotations', QuotationController::class);

    Route::get('/quotations', [QuotationController::class, 'index'])->name('quotations.index');

    Route::get('/quotations-create', [QuotationController::class, 'create'])->name('quotations.create');

    Route::post('/quotations', [QuotationController::class, 'store'])->name('quotations.store');
    Route::get('/quotations-{quotation}', [QuotationController::class, 'show'])->name('quotations.show');
    Route::get('/quotations/{quotation}/edit', [QuotationController::class, 'edit'])->name('quotations.edit');
    Route::put('/quotations/{quotation}', [QuotationController::class, 'update'])->name('quotations.update');
    Route::delete('/quotations/{quotation}', [QuotationController::class, 'destroy'])->name('quotations.destroy');
//    Route::get('/quotations/{quotation}/print', [QuotationController::class, 'print'])->name('quotations.print');
//    Route::get('/quotations/{quotation}/download', [QuotationController::class, 'download'])->name('quotations.download')


//     PO

    Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])
        ->name('purchase-orders.index')
        ->middleware('can:purchase_orders.view');

    Route::get('/purchase-orders-create-{quotation}', [PurchaseOrderController::class, 'create'])
        ->name('purchase-orders.create')
        ->middleware('can:purchase_orders.create');

    Route::post('/purchase-orders', [PurchaseOrderController::class, 'store'])
        ->name('purchase-orders.store')
        ->middleware('can:purchase_orders.create');

    Route::get('/purchase-orders/{purchaseOrder}', [PurchaseOrderController::class, 'show'])
        ->name('purchase-orders.show')
        ->middleware('can:purchase_orders.view');

    Route::get('/purchase-orders/{purchaseOrder}/download', [PurchaseOrderController::class, 'download'])
        ->name('purchase-orders.download')
        ->middleware('can:purchase_orders.view');

    Route::delete('/purchase-orders/{purchaseOrder}', [PurchaseOrderController::class, 'destroy'])
        ->name('purchase-orders.destroy')
        ->middleware('can:purchase_orders.delete');


//     user

    Route::get('/users-create', [UserController::class, 'create'])
        ->name('users.create');


    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');


    Route::get(
        '/users-{user}-edit-password',
        [UserController::class, 'editPassword']
    )->name('users.edit-password');

    Route::put(
        '/users/{user}/update-password',
        [UserController::class, 'updatePassword']
    )->name('users.update-password');

    Route::get(
        '/requests/{request}/document',
        [RequestDocumentController::class, 'create']
    )->name('requests.document.create');


    Route::post(
        '/requests/{request}/document',
        [RequestDocumentController::class, 'store']
    )->name('requests.document.store');
    Route::get(
        '/my-profile',
        [EmployeeController::class, 'myProfile']
    )->name('employees.myProfile');

    Route::get(
        '/language/{locale}',
        [LanguageController::class, 'switch']
    )->name('language.switch');


});

require __DIR__.'/auth.php';
