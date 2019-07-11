<?php

namespace App\Http\Requests\Admin\Music;

use Illuminate\Foundation\Http\FormRequest;

class CreateMusicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
	    return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	        'title'=>'bail|required|max:255',
	        'artist'=>'bail|required|max:255',
	        'cover'=>'bail|image|mimes:jpeg,jpg,png',
//	        'music'=>'bail|required|mimes:mp3,mp4,wma',
//	        'music'=>'bail|required',
        ];
    }

	public function attributes()
	{
		return [
			'cover'=>'کاور',
			'music'=>'آهنگ',
			'title'=>'عنوان',
			'artist'=>'خواننده',
		];
	}
}
