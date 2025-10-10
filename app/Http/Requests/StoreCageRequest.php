<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCageRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:cages,name',
            'capacity' => 'required|integer|min:1|max:50',
            'description' => 'nullable|string|max:1000'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Название клетки" обязательно для заполнения.',
            'name.max' => 'Название клетки не должно превышать 255 символов.',
            'name.unique' => 'Клетка с таким названием уже существует.',
            'capacity.required' => 'Поле "Вместимость" обязательно для заполнения.',
            'capacity.integer' => 'Вместимость должна быть целым числом.',
            'capacity.min' => 'Вместимость должна быть не менее 1.',
            'capacity.max' => 'Вместимость не должна превышать 50 животных.',
            'description.max' => 'Описание не должно превышать 1000 символов.'
        ];
    }
}
