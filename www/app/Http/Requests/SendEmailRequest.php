<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('send-email');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ];

        if (true || $this->user()->can('send-email-with-attachments')) {
            $rules['attachments'] = 'nullable|file';
        }

        return $rules;
    }
}
