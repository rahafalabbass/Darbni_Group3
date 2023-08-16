<?php

namespace App\Http\Controllers\images;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploader;
use App\Http\Traits\GeneralTrait;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class imageController extends Controller
{
    use FileUploader;
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }

// ...



    public function uploadUserImage(Request $request)
    {
        try {
            // Get the currently authenticated user
            $user = Auth::user();

            // Call the 'uploadMultiImage' method from the trait
            $uploadedImages = $this->uploadMultiImage($request, $user, 'multi image');

            // Check if the response is an error
            if (isset($uploadedImages['status']) && $uploadedImages['status'] === 'Error') {
                // Return the error response as it is
                return $this->errorResponse($uploadedImages['message'], 422);
            }

            // Store the image URLs in the database for the user
            // foreach ($uploadedImages as $imageData) {
                // $user->images->create([
                //     'url' => $uploadedImages['url'],
                //  ]);
            // }
            dd($uploadedImages);

            // Return a success response or do whatever you need
            return $this->successResponse(['image_urls' => $uploadedImages], 'Images uploaded successfully', 200);
        } catch (\Throwable $th) {
            // Handle the exception if needed
            report($th);
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
}






