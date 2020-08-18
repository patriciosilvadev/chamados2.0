<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportRequest extends FormRequest
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
            'environment' => request('subdepartment') == 8 ? 'required|exists:environments,id' : 'nullable',
            'spot' => request('subdepartment') == 8 ? 'required|exists:spots,id' : 'nullable',
            'sector' => 'required|exists:sectors,id',
            'service' => 'required|exists:services,id',
            'description' => 'required',
            'attach_file_name' => 'nullable|file',
            'subdepartment' => request('department') == 7 ? 'required' : 'nullable',
            'department' => 'required',
            'desired_date' => 'nullable',
            'expected_date' => request('is_recurrent') ? 'required' : 'nullable',
            'recurrent' => request('is_recurrent') ? 'required' : 'nullable',
        ];
    }
}
