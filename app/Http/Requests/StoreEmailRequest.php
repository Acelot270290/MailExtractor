<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Aqui você pode colocar lógica de autorização. Para permitir a todos, retorne true.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'affiliate_id' => 'required|integer',
            'envelope' => 'required|string',
            'from' => 'required|string|email',
            'subject' => 'required|string',
            'dkim' => 'nullable|string',
            'SPF' => 'nullable|string',
            'spam_score' => 'nullable|numeric',
            'email' => 'required|string',
            'raw_text' => 'nullable|string',
            'sender_ip' => 'nullable|ip',
            'to' => 'required|string',
            'timestamp' => 'required|integer',
        ];
    }
}
