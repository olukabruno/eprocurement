<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PpmpItemsRequest extends FormRequest
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
        
        $rules = [
            'description' => 'required|string',
            'quantity' => 'required|numeric',
            'unit' => 'required|string',
            'estimated_budget' => 'required|numeric',
            'mode' => 'required|string',
            'code' => 'required|string',
        ];

        foreach($this->request->get('schedule') as $key => $val) { 
            $rules['schedule.'.$key] = 'required|numeric'; 
        }

        return $rules;
    }
    public function messages() { 
      $messages = [
        'estimated_budget.required' => 'Estimated Budget is required.',
        'estimated_budget.numeric' => 'Estimated Budget must be numeric.',
      ]; 

      foreach($this->request->get('schedule') as $key => $val) { 
        $messages['schedule.'.$key.'.required'] = 'Schedule is required.';
        $messages ['schedule.'.$key.'.numeric'] = 'Schedule must be numeric.';
      } 
      return $messages; 
    }
}
