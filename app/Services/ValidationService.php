<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ValidationService
{
    public function validatePostData($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'body' => 'required|max:100000',
            'image' => 'image|max:10000',
            'created_at' => 'date',
            'score' => 'numeric',
            'magnitude' => 'numeric',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        return $validator->validated();
    }
}