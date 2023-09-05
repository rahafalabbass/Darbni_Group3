<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Code;
use App\Models\Collage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use Illuminate\Database\Schema\Builder;




class AuthController extends Controller
{
    use GeneralTrait;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|unique:users|max:10',
            'number' => 'bail|required|unique:users|min:10|max:10',
            'uuid' => 'bail|required|exists:collages'
 ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        try {

                        $collage_id = Collage::where('uuid', $request['uuid'])->first()->id;
                        $code = (string)random_int(100000, 999999);

                        $user = User::create([
                            'name' => $request->name,
                            'number' => $request->number,
                            'collage_id' => $collage_id,
                            'code' => $code

                        ]);
                        return $this->successResponse([], 'Registered Successfully.');
            } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>[ 'required','exists:users','max:12'],
            'code' =>[ 'required','max:6']
        ]);


        if ($validator->fails()) {

            return $this->errorResponse($validator->errors(), 422);
        }


            $user=User::where('name',$request->name)->first();

            if($user->code == $request->code ){
             $collage = $user->collage;

            $data['name'] = $collage->name;
            $data['specialization'] = $collage->name;
            $data['collage'] = $collage->type;
            $data['url'] = str_replace('"', '', asset('users/' . $user->url));
            $data['token'] = $user->createToken('MyApp')->plainTextToken;

          return $this->successResponse($data, 'User has logged in successfully.');
        }else {
            return $this->errorResponse('The name or code uncorrect', 400);
        }
    }


    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();

        return $this->successResponse([], 'User has logged out successfully.');
    }
}
?>