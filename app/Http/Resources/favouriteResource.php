<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\QuestionResource;
use App\Models\Question;

class favouriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {   //$w=Question::find($this->question_id)->first();
        return [


             new  QuestionResource($this->question),

        ] ;}
}
