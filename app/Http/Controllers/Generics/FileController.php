<?php

namespace App\Http\Controllers\Generics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Generics\FileResource;
use App\Models\Generics\File;
use App\Models\Projects\FileCategory;
use App\Models\Projects\Project;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = File::paginate();
        return FileResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return FileResource
     */
    public function store(Request $request)
    {
        $data = new File;
        $data->file_name = $request->input('file_name');
        $data->file_type = $request->input('file_type');
        $data->file_description = $request->input('file_description');

        $ownerId = $request->input('fileable_id');
        $owner = null;

        switch ($data->file_type) {
            case 'PROFILE_PICTURE':
                $owner = User::findOrFail($ownerId);
                return $this->__uploadProfilePictures($owner);              
                break;
            case 'Project File':
                $owner = Project::findOrFail($ownerId);
                $folder = 'project_files';
                $file = $request->file('file');

                list($fileName, $fileNameToStore) = $this->__storeFile($file, 'public/' . $folder);

                $data->file_url = "/storage/$folder/$fileNameToStore";
                $data->file_name = $fileName;

                break;
            default:
                break;
        }

        if ($owner->files()->save($data))
        {
            return new FileResource($data);
        }
        else{
            return response(['message' => 'Can not upload file'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return FileResource
     */
    public function show($id)
    {
        $data = File::findOrFail($id);
        return new FileResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return FileResource
     */
    public function update(Request $request, $id)
    {
        $data = File::findOrFail($id);

        $data->file_name = $request->input('file_name');
        $data->file_description = $request->input('file_description');

        if ($data->save()) {
            return new FileResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return FileResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = File::findOrFail($id);

        if ($data->delete()) {
            return new FileResource($data);
        }
    }

    /**
     * @param $file
     * @param string $folder
     * @return array
     */
    private function __storeFile(UploadedFile $file, string $folder): array
    {
        $fileNameWithExt = $file->getClientOriginalName();
        $fileExt = $file->getClientOriginalExtension();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $fileNameToStore = $fileName . '_' . time() . '_' . $fileExt;
        $file->storeAs($folder, $fileNameToStore);
        return array($fileName, $fileNameToStore);
    }

    private function __uploadProfilePictures(User $user)
    {
        $port_path = '/users/profile/port/port'.time().'.png';
        $square_path = '/users/profile/square/square'.time().'.png';

        $port_profile = request()->input('img_port');
        $square_profile = request()->input('img_square');

        $port_profile = substr($port_profile, strpos($port_profile, ",") + 1);
        $square_profile = substr($square_profile, strpos($square_profile, ",") + 1);

        $port_img = base64_decode($port_profile);
        $square_img = base64_decode($square_profile);

        file_put_contents(public_path().$port_path, $port_img);
        file_put_contents(public_path().$square_path, $square_img);

        //store portrait image
        $previousPortraitPicture = $user->files->where('file_type', 'PROFILE_PICTURE_PORTRAIT')->first();
        if ($previousPortraitPicture) {
            $previousPortraitPicture->file_url = $port_path;
            $previousPortraitPicture->save();
        }
        else{
            $portraitData = new File;
            $portraitData->file_type = 'PROFILE_PICTURE_PORTRAIT';
            $portraitData->file_name = '';
            $portraitData->file_url = $port_path;
            $user->files()->save($portraitData);
        }


        //store square image
        $previousSquarePicture = $user->files->where('file_type', 'PROFILE_PICTURE_SQUARE')->first();
        if ($previousSquarePicture) {
            $previousSquarePicture->file_url = $square_path;
            $previousSquarePicture->save();
        }
        else{
            $squareData = new File;
            $squareData->file_type = 'PROFILE_PICTURE_SQUARE';
            $squareData->file_name = '';
            $squareData->file_url = $square_path;
            $user->files()->save($squareData);
        }


    }
}
