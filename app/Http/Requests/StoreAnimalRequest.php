<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cage;

class StoreAnimalRequest extends FormRequest
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
            'species' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string|max:1000',
            'cage_id' => 'required|exists:cages,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
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
            'species.required' => 'Поле "Вид животного" обязательно для заполнения.',
            'species.max' => 'Название вида не должно превышать 255 символов.',
            'name.required' => 'Поле "Имя животного" обязательно для заполнения.',
            'name.max' => 'Имя животного не должно превышать 255 символов.',
            'age.required' => 'Поле "Возраст" обязательно для заполнения.',
            'age.integer' => 'Возраст должен быть целым числом.',
            'age.min' => 'Возраст не может быть отрицательным.',
            'age.max' => 'Возраст не может превышать 100 лет.',
            'description.max' => 'Описание не должно превышать 1000 символов.',
            'cage_id.required' => 'Необходимо выбрать клетку.',
            'cage_id.exists' => 'Выбранная клетка не существует.',
            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Изображение должно быть в формате: jpeg, png, jpg, gif.',
            'image.max' => 'Размер изображения не должен превышать 2MB.'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->cage_id) {
                $cage = Cage::find($this->cage_id);
                if ($cage && !$cage->hasSpace()) {
                    $validator->errors()->add('cage_id', 'В выбранной клетке нет свободных мест!');
                }
            }
        });
    }
}
