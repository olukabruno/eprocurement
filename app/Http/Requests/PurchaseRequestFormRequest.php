<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequestFormRequest extends FormRequest
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
            //

            'pr_status' => 'required|string|max:255',
            'pr_number' => 'required|string|max:255',
            'pr_department' => 'required|string|max:255',
            'pr_requestor_name' => 'required|string|max:255',
            'pr_requestor_position' => 'required|string|max:255',
            'pr_purpose' => 'required|string|max:255',

        ];
    }
}
