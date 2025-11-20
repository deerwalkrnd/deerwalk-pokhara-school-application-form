<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyRequest extends FormRequest
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
            "first_name" => ['required', 'string'],
            "middle_name" => ['string', 'nullable'],
            "last_name" => ['required', 'string'],
            "image" => ['required', 'file', 'mimes:png,jpg,jpeg'],
            "province" => ['required', 'string'],
            "district" => ['required', 'string'],
            "town" => ['required', 'string'],
            "emis_no" => ['string', 'nullable'],
            "passed_grade" => ['required', 'string'],
            "grade_applied" => ['required', 'string'],
            "gpa" => ['required', 'string'],
            "current_school" => ['required', 'string'],
            'home_language' => ['string', 'nullable'],
            "physical_condition" => ['string', 'nullable'],
            "allergy" => ['string', 'nullable'],
            "special_assistance" => ['string', 'nullable'],
            "parent_name" => ['required', 'string'],
            "province_parent" => ['required', 'string'],
            "district_parent" => ['required', 'string'],
            "town_parent" => ['required', 'string'],
            "contact_parent" => ['required', 'string'],
            "email_parent" => ['required', 'string'],
            "academic_qualification_parent" => ['string', 'nullable'],
            "profession_parent" => ['string', 'nullable'],
            "guardian_name" => ['string', 'nullable'],
            "province_guardian" => ['string', 'nullable'],
            "district_guardian" => ['string', 'nullable'],
            "town_guardian" => ['string', 'nullable'],
            "contact_guardian" => ['string', 'nullable'],
            "email_guardian" => ['string', 'nullable'],
            "academic_qualification_guardian" => ['string', 'nullable'],
            "profession_guardian" => ['string', 'nullable'],
        ];
    }
}
