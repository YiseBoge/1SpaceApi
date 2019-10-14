<?php

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

use Accounts\ChildController;
use Accounts\ContactPersonController;
use Accounts\EducationStatusController;
use Accounts\FamilyStatusController;
use Accounts\WorkExperienceController;
use Chats\PrivateMessageController;
use Forums\ForumCommentController;
use Forums\ForumController;
use Forums\ForumPostController;
use Generics\AddressController;
use Generics\DepartmentController;
use Generics\PositionController;
use Generics\RoleController;
use Notices\NoticeController;

Route::middleware(['jwt.auth', 'auth.permission:can_add_user'])->get('/user', function (Request $request) {
    // return $request->user();
    // $token = JWTAuth::fromUser(User::first());
    // print $token;
    print('user can add user');

});


//  API Resources  //

Route::apiResource('accounts/contact-person', ContactPersonController::class);
Route::apiResource('accounts/education-status', EducationStatusController::class);
Route::apiResource('accounts/family-status', FamilyStatusController::class);
Route::apiResource('accounts/child', ChildController::class);
Route::apiResource('accounts/work-experience', WorkExperienceController::class);

Route::apiResource('chats/private-message', PrivateMessageController::class);

Route::apiResource('forums/forum', ForumController::class);
Route::apiResource('forums/forum-post', ForumPostController::class);
Route::apiResource('forums/forum-comment', ForumCommentController::class);

Route::apiResource('generics/address', AddressController::class);
Route::apiResource('generics/department', DepartmentController::class);
Route::apiResource('generics/position', PositionController::class);
Route::apiResource('generics/role', RoleController::class);
//Route::apiResource('generics/file', \Generics\FileController::class);
//Route::apiResource('generics/system-log', \Generics\SystemLogController::class);

Route::apiResource('notices/notice', NoticeController::class);


//  --end--  API Resources  --end--   //
