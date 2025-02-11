<?php

namespace Modules\Social\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "follower_id" => "required|numeric|exists:usuarios,id",
            "followed_id" => "required|numeric|exists:usuarios,id|different:follower_id"
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
