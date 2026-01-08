<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class AgentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $route = Route::currentRouteName();
        // dd($route);
        $arr =  [
            'name' => 'required|string|max:100',
            'company_id' => 'nullable|string|max:100',
            'phone_no' => 'required|string|max:15',
            'email' => 'required|email|max:100|unique:agents,email',

        ];
        
        if ($route === 'agents.update') {
            $arr['email'] = 'sometimes|nullable|string|min:8';
            
        }
        
        return $arr;
        
    }
}
