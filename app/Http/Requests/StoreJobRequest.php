<?php

namespace App\Http\Requests;

use App\Rules\ArrayMax;
use App\Rules\ArrayMin;
use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:1000'],
            'salary' => ['required', 'integer'],
            'isRemote' => [],
            'required_skills' => ['required', new ArrayMin(1), new ArrayMax(20)],
            'optional_skills' => [new ArrayMax(20)],
            'state' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:50'],
        ];

        if ($this->get('isRemote') == null) {
            $rules['state'] = ['required', 'string', 'max:50'];
            $rules['address'] = ['required', 'string', 'max:100'];
        }

        return $rules;
    }
}
