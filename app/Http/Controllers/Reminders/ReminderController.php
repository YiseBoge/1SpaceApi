<?php

namespace App\Http\Controllers\Reminders;

use Illuminate\Http\Request;
use App\Models\Reminders\Reminder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Reminders\ReminderResource;

class ReminderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Reminder::where('poster_id', auth()->user()->id)
        ->orWhere('is_personal', false)
        ->orderBy('created_at', 'desc');

        return request()->has('no_pagination') ? ReminderResource::collection($data->get()) : ReminderResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ReminderResource
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = new Reminder([
            'poster_id' => $user->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        $data->target_date = $request->input('target_date');
        $data->remind_before = $request->input('remind_before');
        $data->is_personal = $request->input('is_personal');

        $data->save();
        return new ReminderResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ReminderResource
     */
    public function show($id)
    {
        $data = Reminder::findOrFail($id);
        return new ReminderResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return ReminderResource
     */
    public function update(Request $request, $id)
    {
        $data = Reminder::findOrFail($id);

        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->target_date = $request->input('target_date');
        $data->remind_before = $request->input('remind_before');

        if ($data->save()) {
            return new ReminderResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ReminderResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Reminder::findOrFail($id);
        if ($data->delete()) {
            return new ReminderResource($data);
        }
    }
}
