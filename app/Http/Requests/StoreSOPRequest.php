<?php

namespace App\Http\Requests;

use App\Enums\SOPType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSOPRequest extends FormRequest
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
            'type_SOP' => __('model.Sop.type_SOP'),
            'title' => __('model.Sop.title'),
            'description' => __('model.Sop.description'),
            'content' => __('model.letter.content'),

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

            'type_SOP' => ['nullable'],
            'title' => ['required'],
            'description' => ['nullable'],
            'content' => ['nullable'],
        ];
    }
}
