<?php

namespace App\Http\Requests;

use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;

class SaleSaveRequest extends FormRequest
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
            'total' => 'required|numeric|min:1|lte:stock',
            'vehicle_id' => 'required|string|exists:vehicles,_id',
            'updatedStock' => 'required|numeric|min:0',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {

        $vehicle = Vehicle::find($this->vehicle_id);
        $this->merge([
            'stock' => $vehicle?->stock,
            'updatedStock' => $vehicle?->stock - $this->total,
        ]);
    }
}
