<?php

namespace Modules\Social\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTweetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "usuario_id" => "required|numeric|exists:usuarios,id",
            "contenido"  => "required|string|max:280"
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
