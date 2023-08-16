<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function logout(Request $request)
  {
      auth('sanctum')->user()->tokens()->delete();

      return $this->successResponse([],'User has logged out successfully.');
  }

}
