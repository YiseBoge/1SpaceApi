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

use App\User;
use Forums\ForumController;
use Generics\RoleController;
use Illuminate\Http\Request;
use Accounts\ChildController;
use Notices\NoticeController;
use Forums\ForumPostController;
use Generics\AddressController;
use Generics\PositionController;
use Forums\ForumCommentController;
use Generics\DepartmentController;
use Chats\PrivateMessageController;
use Accounts\FamilyStatusController;
use Accounts\ContactPersonController;
use Accounts\WorkExperienceController;
use Accounts\EducationStatusController;
use Accounts\UserController;

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

Route::get('accounts/contact-person/user/{userID}', 'Accounts\ContactPersonController@getByUserId');
Route::apiResource('accounts/contact-person', ContactPersonController::class);
Route::get('accounts/education-status/user/{userID}', 'Accounts\EducationStatusController@getByUserId');
Route::apiResource('accounts/education-status', EducationStatusController::class);
Route::get('accounts/family-status/user/{userID}', 'Accounts\FamilyStatusController@getByUserId');
Route::apiResource('accounts/family-status', FamilyStatusController::class);
Route::get('accounts/child/family-status/{familyStatusID}','Accounts\ChildController@getByFamilyStatusId');
Route::apiResource('accounts/child', ChildController::class);
Route::get('accounts/work-experience/user/{userID}', 'Accounts\WorkExperienceController@getByUserId');
Route::apiResource('accounts/work-experience', WorkExperienceController::class);
Route::apiResource('accounts/user', UserController::class);

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
