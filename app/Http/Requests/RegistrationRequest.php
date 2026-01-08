<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class RegistrationRequest extends FormRequest
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
            'indos_no' => 'required|string|alpha_num|max:15',
            'passport_no' => 'required|string|alpha_num|max:15',
            'cdc_no' => 'nullable|string|alpha_num|max:15',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:25',
            'dob' => 'required|date_format:Y-m-d',
            'rank' => 'nullable|string|max:255',
            'gender' => 'required|integer|in:1,2,3',
            'nationality' => 'required|integer',
            'clinic' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'vessel_name' => 'nullable|string|max:255',
            'vessel_type' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'contact_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'referred_by' => 'nullable|string|max:255',
            'aadhaar_no'  => 'nullable|digits:12|unique:registrations,aadhaar_no',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateUniqueForToday($validator);
        });
    }

    private function validateUniqueForToday($validator)
    {
        $today = now()->toDateString();

        $exists = DB::table('registrations')
            ->whereDate('created_at', $today)
            ->where(function ($query) {
                $query->where('cdc_no', $this->cdc_no)
                    ->orWhere('passport_no', $this->passport_no)
                    ->orWhere('indos_no', $this->indos_no);
            })
            ->exists();

        if ($exists) {
            $validator->errors()->add('cdc_no', 'The CDC No, Passport No, or INDOS No has already been registered for today.');
        }
    }
}
