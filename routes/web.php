<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController; // สำหรับ admin
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LearningResourceController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\IncidentStatusController;
use App\Http\Controllers\Auth\LoginuserController; // สำหรับ user
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserNewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\accidentController;
use App\Http\Controllers\RescueOperationController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\UserLoginController;

Route::get('password/forgot', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
Route::get('/login/user', [LoginuserController::class, 'showLoginForm'])->name('user.login');
Route::post('/login/user', [LoginuserController::class, 'login']);
Route::post('/logout/user', [LoginuserController::class, 'logout'])->name('logout.user');
Route::get('/user/dashboard', function () {
    return view('dashboards');
})->middleware('auth:web');

Route::get('/member/login', [MemberController::class, 'showLoginForm'])->name('member.login');
Route::post('/member/login', [MemberController::class, 'login']);
Route::get('/member/logout', [MemberController::class, 'logout'])->name('member.logout');
Route::get('/member/dashboard', function () {
    return view('home');
})->middleware('auth:member');




// Routes สำหรับ member
Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
Route::post('/member/store', [MemberController::class, 'store'])->name('member.store');
Route::get('/member', [MemberController::class, 'index'])->name('member.index');
Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
Route::put('/member/{id}/update', [MemberController::class, 'update'])->name('member.update');
Route::delete('/member/{id}', [MemberController::class, 'destroy'])->name('member.destroy');

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home', function () {
        return view('home');
    });
});

Route::group(['middleware' => ['auth:user']], function () {
    Route::get('/dashboard', function () {
        return view('dashboards');
    });
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('operations', OperationController::class);
// เพิ่มเส้นทางสำหรับการแสดงผลหน้า operation หรือการบันทึกข้อมูลการปฏิบัติการช่วยเหลือ
// หรือหากเป็นการบันทึกข้อมูล
Route::get('/incident/operation', [IncidentController::class, 'operation'])->name('incident.operation');

Route::post('/incident/operation', [RescueOperationController::class, 'store'])->name('operation.store');

// Routes สำหรับ admin login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/newss', [NewsController::class, 'showFrontend'])->name('news.frontend');
Route::get('/news/{id}', [NewsController::class, 'showNewsDetail'])->name('news.detail');
Route::resource('news', NewsController::class);
Route::resource('contacts', ContactController::class);
Route::resource('learning-resources', LearningResourceController::class);

// Routes สำหรับ incident
Route::resource('incident', IncidentController::class);
Route::get('/incidents', [IncidentController::class, 'index'])->name('incident.index');
Route::get('/incident/create', [IncidentController::class, 'create'])->name('incident.create')->middleware('auth');

Route::post('/incident', [IncidentController::class, 'store'])->name('incident.store');
Route::get('/incident-status', [IncidentController::class, 'status'])->name('incident.status');
Route::get('incidents/{incident}/edit', [IncidentController::class, 'edit'])->name('incidents.edit');
Route::put('incidents/{incident}', [IncidentController::class, 'update'])->name('incidents.update');
Route::delete('incidents/{incident}', [IncidentController::class, 'destroy'])->name('incidents.destroy');
Route::put('/incident/{id}', [IncidentController::class, 'update'])->name('incident.update');
Route::get('/incident-status/{id}', [IncidentController::class, 'showStatus']);
Route::get('/incident/showuser/{id}', [IncidentController::class, 'showUser'])->name('incident.showuser');
Route::get('/notifications', [IncidentController::class, 'notifications'])->name('notifications.index');

Route::get('/reports/incident', [accidentController::class, 'index'])->name('accident');
Route::get('/incident-report', [accidentController::class, 'index'])->name('incident.report');
Route::get('/reports/accident/year', [accidentController::class, 'getByYear'])->name('accident.getByYear');

Route::match(['get', 'post'], '/incident/{id}/process', [IncidentController::class, 'process'])->name('incident.process');
// ตรวจสอบว่า Route นี้มีอยู่และถูกต้อง
Route::get('/incident/{id}/progress', [IncidentController::class, 'progress'])->name('incident.progress');
Route::post('/incident/{id}/process', [IncidentController::class, 'updateStatus'])->name('incident.process');

Route::get('/progress', [IncidentController::class, 'progress'])->name('incident.progress');
Route::match(['get', 'post'],'/completed', [IncidentController::class, 'completedIncidents'])->name('incident.completed');
Route::post('/incidents/{id}/complete', [IncidentController::class, 'markAsCompleted'])->name('incident.markAsCompleted');




// Routes สำหรับ register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard');
})->name('dashboard');
Route::get('/dashboard', [NewsController::class, 'index']);
Route::get('/dashboard', [NewsController::class, 'index'])->name('dashboard');
Route::get('/dashboards', [LearningResourceController::class, 'index'])->name('dashboard');

Route::get('/Learning', [LearningResourceController::class, 'index']);
Route::get('/Learning', [LearningResourceController::class, 'index'])->name('dashboard');

Route::get('/learning-resources', [LearningResourceController::class, 'index'])->name('learning-resources.index');
use App\Http\Controllers\DashboardController;

Route::get('Dashboards', [DashboardController::class, 'index'])->name('Dashboards');


Route::get('home', function() {
    return view('home');
});


Route::get('/', function () {
    return view('welcome');
});
Route::get('/incident/{id}/markAsRead', [IncidentController::class, 'markAsRead'])->name('incident.markAsRead');



Route::get('home/user', function () {
    return view('home');
});


Route::get('incident/user', function () {
    return view('incident');
});


Route::get('form/admin', function () {
    return view('form');
});

Route::get('member/a', function () {
    return view('member');
});

Route::fallback(function () {
    return "<h1>ไม่พบหน้าเว็บ</h1>";
});

Route::get('/status', function () {
    
    
return view('/tes');
});
Auth::routes();

Route::get('tes', function() {
    return view('tes');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
