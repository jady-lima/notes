<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditNoteRequest extends FormRequest
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
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:3|max:3000'
        ];
    }

    public function messages()
    {
        return [
            'text_title.required' => 'Oops! Title is required. Please enter a valid title address.',
            'text_title.min' => '"Oops! Title can have a minimum of :min characters',
            'text_title.max' => '"Oops! Title can have a maximum of :max  characters',
            'text_note.required' => 'Oops! Note is required.',
            'text_note.min' => '"Oops! Note can have a minimum of :min characters',
            'text_note.max' => '"Oops! Note can have a maximum of :max  characters',
        ];
    }
}
