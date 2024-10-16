<?php

use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SystemController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Main');
})->name('home');

Route::get('/site-policy/{id}', function ($id) {
    return Inertia::render('Policy', [
        'policyId' => $id,
        'terms' => cache('config.policy')->policy->terms,
        'policy' => cache('config.policy')->policy->policy,
    ]);
})->name('site-policy');

Route::middleware('auth')->group(function () {
    /** 프로필 */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /** 마이페이지 */
    Route::get('/mypage', [MypageController::class, 'overview'])->name('mypage.overview');
    Route::post('/mypage/profile-upload', [MypageController::class, 'profileUpload'])->name('mypage.profile.upload');
    Route::delete('/mypage/profile-destroy', [MypageController::class, 'profileDestroy'])->name('mypage.profile.destroy');
    //Route::get('/mypage/userinfo', UserInfo::class)->name('mypage.userinfo');
    //Route::get('/mypage/login-record/list', LoginRecordList::class)->name('mypage.login-record.list');
    //Route::get('/mypage/write/list', MyWrite::class)->name('mypage.write.list');
    //Route::get('/mypage/comment/list', MyComment::class)->name('mypage.comment.list');
    //Route::get('/mypage/rate/list', MyRate::class)->name('mypage.rate.list');
    //Route::get('/mypage/report/list', MyReport::class)->name('mypage.report.list');
    //Route::get('/mypage/point/list', MyPoint::class)->name('mypage.point.list');
    //Route::get('/mypage/notification/list', MyNotification::class)->name('mypage.notification.list');
    //Route::get('/mypage/inquiry/list', MyInquiryList::class)->name('mypage.inquiry.list');
    //Route::get('/mypage/inquiry/create', MyInquiryCreate::class)->name('mypage.inquiry.create');
    //Route::get('/mypage/inquiry/read/{inquiryId}', MyInquiryRead::class)->name('mypage.inquiry.read');
});

require __DIR__.'/auth.php';

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
