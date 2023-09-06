<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class profileController extends Controller
{
    use GeneralTrait;
    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('users')->ignore(Auth::id())],
            'number' => ['required', Rule::unique('users')->ignore(Auth::id()), 'min:10', 'max:10'],


        ]);


        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        $filename = null;
        $user = Auth::user();
        if ($request->hasfile('url')) {

            $image_name = $user->url;
            $image_path = public_path('users/' . $image_name);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('url');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('users/', $filename);
        }
        try {

            $user->name = $request->name;
            $user->number = $request->number;
            $user->url = $filename;
            $user->save();
            $user = Auth::user();

            $data['name'] = $user->name;
            $data['number'] = $user->number;
            $data['specialization'] = $user->collage->name;
            $data['collage'] = $user->collage->type;
            $data['url'] = str_replace('"', '', asset('users/' . $user->url));

            return $this->successResponse($data, 'The changes have updated successfully.');
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }

        return response()->json(['response' => ['code' => '200', 'message' => 'تم تعديل البيانات بنجاح',]]);
    }
}
?>