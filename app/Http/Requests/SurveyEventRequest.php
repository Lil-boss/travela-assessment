<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyEventRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            "surveyId" => "required",
            "questionId" => "required",
            "answerId" => "required",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            "surveyId.required" => "Survey ID is required",
            "questionId.required" => "Question ID is required",
            "answerId.required" => "Answer ID is required",
        ];
    }
}
