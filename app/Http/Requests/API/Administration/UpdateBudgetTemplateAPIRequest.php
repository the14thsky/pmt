<?php

namespace App\Http\Requests\API\Administration;

use App\Models\Administration\BudgetTemplate;
use InfyOm\Generator\Request\APIRequest;

class UpdateBudgetTemplateAPIRequest extends APIRequest
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
        $rules = BudgetTemplate::$rules;
        
        return $rules;
    }
}