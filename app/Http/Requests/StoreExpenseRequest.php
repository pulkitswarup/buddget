<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'name' => 'required|max:191',
            'amount' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'category' => 'required|integer',
            'currency' => 'required|integer',
            'purchased_date' => 'date_format:"d-m-Y"|required',
            'description' => 'sometimes|max:1000'
        ];
    }
}
