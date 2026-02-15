<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
     * @return array<string, mixed>
     */
     public function rules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'file'  => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        ];
    }
}
