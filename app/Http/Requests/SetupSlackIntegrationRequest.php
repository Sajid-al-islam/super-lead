<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetupSlackIntegrationRequest extends FormRequest
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
            'webhook_url' => ['required', 'string', 'url', 'starts_with:https://hooks.slack.com/services/'],
            'channel' => ['nullable', 'string', 'max:255'],
            'notify_on_new_lead' => ['boolean'],
            'notify_on_company_resolution' => ['boolean'],
            'notify_on_email_unlock' => ['boolean'],
        ];
    }
    
    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'webhook_url' => 'Slack webhook URL',
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'webhook_url.starts_with' => 'The Slack webhook URL must start with https://hooks.slack.com/services/.',
        ];
    }
} 