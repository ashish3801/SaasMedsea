<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        return [
            'clinic_id' => 'nullable',
            'rank' => 'nullable',
            'emp_name' => 'nullable',
            'phone_no' => 'nullable',
            'email' => 'nullable|email',
            'dgs_approval_number' => 'nullable',
            'certificate_issued_by' => 'nullable',
            'certificate_issue_date' => 'nullable|date',
            'sign_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'stamp_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}
