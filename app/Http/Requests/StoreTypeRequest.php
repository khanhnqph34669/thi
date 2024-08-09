<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route("room")->id;
        return [
            "name" => "required|unique:rooms,name,".$id,
            "describe" => "nullable",
            "image" => "nullable|image:jpeg,png,jpg,gif,svg|max:2048",
            "is_Active"=> "required",
            "type_id" => "required",
        ];
    }
}
