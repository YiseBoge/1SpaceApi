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
use Accounts\UserController;
use Accounts\WorkExperienceController;
use App\User;
use Chats\ConversationController;
use Chats\PrivateMessageController;
use Companies\CompanyController;
use Companies\DepartmentController;
use Companies\PositionController;
use Companies\RoleController;
use Forums\ForumCommentController;
use Forums\ForumController;
use Forums\ForumPostController;
use Generics\AddressController;
use Generics\FileController;
use Generics\SystemLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Notices\NoticeController;
use Projects\CoordinateController;
use Projects\FileCategoryController;
use Projects\PMOController;
use Projects\ProjectCategoryController;
use Projects\ProjectController;
use Projects\TeamMemberController;

Route::post('login', function (Request $request) {
    $password = $request->input('password');
    $login = $request->input('login');
    $user = User::where('email', $login)->orWhere('phone_number', $login)->first();

    if ($user && Hash::check($password, $user->password)) {
        $token = JWTAuth::fromUser($user);
        $data = ['token' => $token];
        return response($data);
    } else {
        return response('Unauthorized', 401);
    }
});


//  API Resources  //

Route::get('accounts/contact-person/user/{userID}', 'Accounts\ContactPersonController@getByUserId');
Route::apiResource('accounts/contact-person', ContactPersonController::class);
Route::get('accounts/education-status/user/{userID}', 'Accounts\EducationStatusController@getByUserId');
Route::apiResource('accounts/education-status', EducationStatusController::class);
Route::get('accounts/family-status/user/{userID}', 'Accounts\FamilyStatusController@getByUserId');
Route::apiResource('accounts/family-status', FamilyStatusController::class);
Route::get('accounts/child/family-status/{familyStatusID}', 'Accounts\ChildController@getByFamilyStatusId');
Route::apiResource('accounts/child', ChildController::class);
Route::get('accounts/work-experience/user/{userID}', 'Accounts\WorkExperienceController@getByUserId');
Route::apiResource('accounts/work-experience', WorkExperienceController::class);
Route::get('accounts/user/{id}/generate-pdf', 'Accounts\UserController@generatePDF');
Route::apiResource('accounts/user', UserController::class);

Route::get('chats/conversation/user/{id}', 'Chats\ConversationController@getByUser');
Route::apiResource('chats/conversation', ConversationController::class);
Route::apiResource('chats/private-message', PrivateMessageController::class);

Route::apiResource('companies/company', CompanyController::class);
Route::apiResource('companies/department', DepartmentController::class);
Route::apiResource('companies/position', PositionController::class);
Route::apiResource('companies/role', RoleController::class);

Route::apiResource('forums/forum', ForumController::class);
Route::apiResource('forums/forum-post', ForumPostController::class);
Route::apiResource('forums/forum-comment', ForumCommentController::class);

Route::apiResource('generics/address', AddressController::class);
Route::apiResource('generics/file', FileController::class);
Route::apiResource('generics/system-log', SystemLogController::class);

Route::apiResource('notices/notice', NoticeController::class);

Route::apiResource('projects/project', ProjectController::class);
Route::apiResource('projects/coordinate', CoordinateController::class);
Route::apiResource('projects/project-category', ProjectCategoryController::class);
Route::apiResource('projects/file-category', FileCategoryController::class);
Route::apiResource('projects/pmo', PMOController::class);
Route::apiResource('projects/team-member', TeamMemberController::class);


//  --end--  API Resources  --end--   //
