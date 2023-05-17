<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleSaveRequest extends FormRequest
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
        $requestMethod = request()->isMethod('post');
        $rule = $requestMethod ? 'required' : 'sometimes';

        return [
            'name' => $rule . '|string|min:2',
            'year' => $rule . '|numeric',
            'price' => $rule . '|numeric',
            'color' => $rule . '|string|min:2',
            'stock' => $rule . '|numeric',
            'car_id' => [
                $requestMethod ? 'required_without:motorcycle_id' : '',
                'prohibited_unless:motorcycle_id,null',
                'string',
                'nullable',
                'exists:cars,_id',
            ],
            'motorcycle_id' => [
                $requestMethod ? 'required_without:car_id' : '',
                'prohibited_unless:car_id,null',
                'string',
                'nullable',
                'exists:motorcycles,_id',
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {

        if (!request()->isMethod('post')) {
            if (!is_null($this->car_id)) {
                $this->merge([
                    'motorcycle_id' => null,
                ]);
            }
            if (!is_null($this->motorcycle_id)) {
                $this->merge([
                    'car_id' => null,
                ]);
            }
        }
    }

}
