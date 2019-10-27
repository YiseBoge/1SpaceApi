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
use Notices\NoticeController;

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
Route::apiResource('accounts/user', UserController::class);

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


//  --end--  API Resources  --end--   //
