<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class CreateRepositoryRequest extends APIFormRequest
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
            'github_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
            'avatar_url' => 'required',
            'stargazers_count' => 'required',
            'language' => 'required',
        ];
    }
}
