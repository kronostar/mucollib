<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlbumRequest extends FormRequest
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
            'artist_id' => 'required|not_in:0',
            'name' => 'required|not_in:Title|max:120',
			'catno' => 'max:20',
			'origcatno' => 'max:20',
			'label_id' => 'required|not_in:0',
			'origlabel_id' => 'required|not_in:0',
            'format_id' => 'required|not_in:0',
            'genre_id' => 'required|not_in:0'
        ];
    }
}
