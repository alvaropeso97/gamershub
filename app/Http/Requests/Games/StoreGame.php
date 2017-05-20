<?php

namespace App\Http\Requests\Games;

use Illuminate\Foundation\Http\FormRequest;

class StoreGame extends FormRequest
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
            'desc' => 'required',
            'genres' => 'required',
            'categories[]' => 'array',
            'developers' => 'required',
            'distributors' => 'required',
            'available_on' => 'required',
            'players_quantity' => 'required',
            'duration' => 'required',
            'language' => 'required',
            'release_date' => 'required',
            'boxed_image' => 'required',
            'header_image' => 'required',
        ];
    }
}
