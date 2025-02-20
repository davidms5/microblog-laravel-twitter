<?php

namespace Modules\Timeline\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowTimelineRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "usuario_id" => "required|numeric|exists:usuarios,id"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
