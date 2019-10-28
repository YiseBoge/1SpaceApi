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
            case 'Profile Picture':
                $owner = User::findOrFail($ownerId);
                $data->file_url = '';
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

        if ($owner->files()->save($data)) {
            if ($data->file_type == 'Project File') {
                $fileCategory = FileCategory::findOrFail($request->input('file_category_id'));
                $fileCategory->files()->attach([$data->id]);
            }
            return new FileResource($data);
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
}
