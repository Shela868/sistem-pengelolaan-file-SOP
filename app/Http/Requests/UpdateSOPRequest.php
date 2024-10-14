<?php

namespace App\Http\Requests;

use App\Enums\SOPType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSOPRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'perihal_SOP' => __('model.SOP.perihal_SOP'),
            'klasifikasi' => __('model.SOP.klasifikasi'),
            'status_SOP' => __('model.Sop.status_SOP'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'perihal_SOP' => ['required'],
            'klasifikasi' => ['required'],
            'status_SOP' => ['nullable'],

        ];
    }
}
