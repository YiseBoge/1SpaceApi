<?php

use Accounts\ContactPersonController;
use Accounts\EducationStatusController;
use Accounts\FamilyStatusController;
use Accounts\WorkExperienceController;
use Chats\PrivateMessageController;
use Forums\ForumController;
use Forums\ForumMessageController;
use Generics\AddressController;
use Generics\DepartmentController;
use Generics\FileController;
use Generics\PositionController;
use Generics\RoleController;
use Generics\SystemLogController;
use Illuminate\Http\Request;
use Notices\NoticeController;
use Reminders\ReminderController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//  API Resources  //

Route::apiResource('accounts/account', ContactPersonController::class);
Route::apiResource('accounts/contact-person', ContactPersonController::class);
Route::apiResource('accounts/education-status', EducationStatusController::class);
Route::apiResource('accounts/family-status', FamilyStatusController::class);
Route::apiResource('accounts/work-experience', WorkExperienceController::class);

Route::apiResource('chats/private-message', PrivateMessageController::class);

Route::apiResource('forums/forum', ForumController::class);
Route::apiResource('forums/forum-message', ForumMessageController::class);

Route::apiResource('generics/forum', AddressController::class);
Route::apiResource('generics/department', DepartmentController::class);
Route::apiResource('generics/file', FileController::class);
Route::apiResource('generics/position', PositionController::class);
Route::apiResource('generics/role', RoleController::class);
Route::apiResource('generics/system-log', SystemLogController::class);

Route::apiResource('notices/notice', NoticeController::class);

Route::apiResource('reminders/reminder', ReminderController::class);

//  --end--  API Resources  --end--   //
