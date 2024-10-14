<?php

namespace App\Http\Requests;

use App\Enums\LetterType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLetterRequest extends FormRequest
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
            'agenda_number' => __('model.letter.agenda_number'),
            'from' => __('model.letter.from'),
            'to' => __('model.letter.to'),
            'reference_number' => __('model.letter.reference_number'),
            'received_date' => __('model.letter.received_date'),
            'letter_date' => __('model.letter.letter_date'),
            'description' => __('model.letter.description'),
            'note' => __('model.letter.note'),
            'classification_code' => __('model.letter.classification_code'),
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
            'agenda_number' => ['nullable'],
            'from' => ['nullable'],
            'to' => ['nullable'],
            'type' => ['required'],
            'reference_number' => ['nullable', Rule::unique('letters')],
            'received_date' => ['nullable'],
            'letter_date' => ['nullable'],
            'description' => ['required'],
            'note' => ['nullable'],
            'classification_code' => ['nullable'],
        ];
    }
}
