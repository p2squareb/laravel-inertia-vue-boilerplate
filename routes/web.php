<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\WriteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

require __DIR__.'/auth.php';

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

/** 게시판 */
Route::group(['prefix' => '/bbs/{tableId}', 'middleware' => 'board-auth-check:status'], function()
{
    Route::get('/list', [WriteController::class, 'list'])->name('write.list');
    //Route::get('/password/{writeId}/{access}', WritePassword::class)->name('write.password.check');
    //Route::get('/create', WriteCreate::class)->name('write.create')->middleware('board-auth-check:write');
    //Route::get('/read/{writeId}', WriteRead::class)->name('write.read')->middleware('board-auth-check:read');
    //Route::get('/update/{writeId}', WriteUpdate::class)->name('write.update')->middleware('board-auth-check:update');
    //Route::get('/delete/{writeId}', WriteDelete::class)->name('write.delete');
});

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

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin']], function() {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    /** 시스템 설정 */
    Route::get('/system/basic', [SystemController::class, 'basic'])->name('admin.system.basic');
    Route::post('/system/basic', [SystemController::class, 'basicUpdate'])->name('admin.system.basic.update');
    Route::get('/system/external', [SystemController::class, 'external'])->name('admin.system.external');
    Route::get('/system/policy-terms', [SystemController::class, 'policyTerms'])->name('admin.system.policy-terms');
    Route::post('/system/policy-terms', [SystemController::class, 'updatePolicyTerms'])->name('admin.system.policy-terms.update');

    /** 회원 */
    Route::get('/user/list', [UserManageController::class, 'list'])->name('admin.user.list');
    Route::get('/user/read/{userId}', [UserManageController::class, 'read'])->name('admin.user.read');
    Route::get('/user/group-list', [UserManageController::class, 'groupList'])->name('admin.user.group-list');
    Route::get('/user/prohibit-list', [UserManageController::class, 'prohibitList'])->name('admin.user.prohibit-list');
    Route::get('/user/dormant-list', [UserManageController::class, 'dormantList'])->name('admin.user.dormant-list');
    Route::get('/user/withdrawal-list', [UserManageController::class, 'withdrawalList'])->name('admin.user.withdrawal-list');
    Route::post('/user/change-group', [UserManageController::class, 'changeGroup'])->name('admin.user.changeGroup');

    /** 포인트 */
    //Route::get('/point/set', PointSet::class)->name('admin.point.set');
    //Route::get('/point/list', PointList::class)->name('admin.point.list');

    /** 게시판 */
    //Route::get('/board/list', BoardList::class)->name('admin.board.list');
    //Route::get('/board/create', BoardCreate::class)->name('admin.board.create');
    //Route::get('/board/update/{boardId}', BoardUpdate::class)->name('admin.board.update');
    //Route::get('/board/write/list', BoardWriteList::class)->name('admin.board.write.list');
    //Route::get('/board/comment/list', BoardCommentList::class)->name('admin.board.comment.list');
    //Route::get('/board/report/list', BoardReportList::class)->name('admin.board.report.list');

    /** 1:1문의 */
    //Route::get('/inquiry/list', InquiryList::class)->name('admin.inquiry.list');
    //Route::get('/inquiry/read/{inquiryId}', InquiryRead::class)->name('admin.inquiry.read');
});
