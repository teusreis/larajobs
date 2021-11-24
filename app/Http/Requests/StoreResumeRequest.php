<?php

namespace App\Http\Requests;

use App\Rules\ArrayMax;
use App\Rules\ArrayMin;
use Illuminate\Foundation\Http\FormRequest;

class StoreResumeRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'min:100', 'max:1500'],
            'skills' => ['required', 'string', new ArrayMin(1), new ArrayMax(50)],

            'position.*' => ['sometimes', 'required', 'string', 'max:25'],
            'company_name.*' => ['sometimes', 'required', 'string', 'max:50'],
            'job_description.*' => ['sometimes', 'required', 'string', 'min:100', 'max:1500'],
            'start.*' => ['sometimes', 'required', 'date'],
            'end.*' => [],

            'level.*' => ['sometimes', 'required', 'integer'],
            'course_name.*' => ['sometimes', 'required', 'string', 'max:255'],
            'institution_name.*' => ['sometimes', 'required', 'string', 'max:255'],
            'stillCoursing.*' => ['sometimes', 'required'],
            'start_date.*' => ['sometimes', 'required', 'date'],
            'end_date.*' => ['sometimes', 'nullable', 'date'],
        ];
    }

    public function messages()
    {
        return [];
    }

    public function attributes()
    {
        return [
            'company_name.*' => 'company name',
            'position.*' => 'position',
            'job_description.*' => 'description',
            'start.*' => 'start',
            'end.*' => 'end',

            'level.*' => 'level',
            'course_name.*' => 'course name',
            'institution_name.*' => 'institution name',
            'stillCoursing.*' => 'still coursing',
            'start_date.*' => 'start date',
            'end_date' => 'end date',
        ];
    }
}
