<?php

namespace App\Http\Requests\Articles;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticle extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'seo_optimized_title' => 'required|max:255',
            'content' => 'required',
            'description' => 'required',
            'type' => 'required',
            'tags' => 'required',
            'image' => 'required|image',

            //Review
            'gameplay_score' => 'required_if:type,3',
            'graphics_score' => 'required_if:type,3',
            'sounds_score' => 'required_if:type,3',
            'innovation_score' => 'required_if:type,3',

            //Video
            'youtube_code' => 'required_if:type,2',
            'duration' => 'required_if:type,2',
        ];
    }
}
