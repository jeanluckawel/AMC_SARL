<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestManagementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/employees', [EmployeeController::class, 'index'])
        ->name('employees.index');

    Route::get('/employees-create', [EmployeeController::class, 'create'])
        ->name('employees.create');

    Route::get('/employees/{employee}/profile', [EmployeeController::class, 'profile'])
        ->name('employees.profile');

    Route::post('/employees', [EmployeeController::class, 'store'])
        ->name('employees.store');



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

    Route::get('/requests/{requestModel}', [RequestManagementController::class, 'show',])->name('requests.show');

//    Route::get( '/procurement-pending', [RequestManagementController::class, 'ProcurementPending'] )->name('procurement.pending');
//
//
//    Route::post(
//        '/procurement/requests/{requestModel}/approve',
//        [RequestManagementController::class, 'approveProcurement']
//    )->name('procurement.requests.approve');
//
//    Route::post(
//        '/procurement/requests/{requestModel}/reject',
//        [RequestManagementController::class, 'rejectProcurement']
//    )->name('procurement.requests.reject');




    // Formulaire de création
//    Route::get('/requests/create', [
//        RequestManagementController::class,
//        'create',
//    ])->name('requests.create');
//
//
//    // Enregistrer une nouvelle demande
//    Route::post('/requests', [
//        RequestManagementController::class,
//        'store',
//    ])->name('requests.store');
//
//
//    // Voir une demande
//    Route::get('/requests/{requestModel}', [
//        RequestManagementController::class,
//        'show',
//    ])->name('requests.show');
//
//
//    /*
//    |--------------------------------------------------------------------------
//    | PROCUREMENT
//    |--------------------------------------------------------------------------
//    */
//
//    // Procurement traite la demande
//    Route::post(
//        '/requests/{requestModel}/procurement/process',
//        [
//            RequestManagementController::class,
//            'procurementProcess',
//        ]
//    )->name('requests.procurement.process');
//
//
//    // Procurement rejette la demande
//    Route::post(
//        '/requests/{requestModel}/procurement/reject',
//        [
//            RequestManagementController::class,
//            'procurementReject',
//        ]
//    )->name('requests.procurement.reject');
//
//
//    /*
//    |--------------------------------------------------------------------------
//    | FINANCE
//    |--------------------------------------------------------------------------
//    */
//
//    // Finance approuve
//    Route::post(
//        '/requests/{requestModel}/finance/approve',
//        [
//            RequestManagementController::class,
//            'financeApprove',
//        ]
//    )->name('requests.finance.approve');
//
//
//    // Finance rejette
//    Route::post(
//        '/requests/{requestModel}/finance/reject',
//        [
//            RequestManagementController::class,
//            'financeReject',
//        ]
//    )->name('requests.finance.reject');
//
//
//    /*
//    |--------------------------------------------------------------------------
//    | CEO
//    |--------------------------------------------------------------------------
//    */
//
//    // CEO approuve définitivement
//    Route::post(
//        '/requests/{requestModel}/ceo/approve',
//        [
//            RequestManagementController::class,
//            'ceoApprove',
//        ]
//    )->name('requests.ceo.approve');
//
//
//    // CEO rejette
//    Route::post(
//        '/requests/{requestModel}/ceo/reject',
//        [
//            RequestManagementController::class,
//            'ceoReject',
//        ]
//    )->name('requests.ceo.reject');


});


/*
|--------------------------------------------------------------------------
| PROCUREMENT
|--------------------------------------------------------------------------
*/

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
        '/procurement-requests/{requestModel}-process',
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



});


require __DIR__.'/auth.php';
