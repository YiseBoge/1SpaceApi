<?php

namespace App\Http\Controllers\Notifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Notifications\NotificationResource;
use App\Models\Forums\ForumPost;
use App\Notifications\PostLiked;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
      
    public function index(){
        return NotificationResource::collection(auth()->user()->notifications()->paginate());
    }
}
