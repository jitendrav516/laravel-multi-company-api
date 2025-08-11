<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetActiveCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_id' => 'required|integer|exists:companies,id',
        ];
    }
}
