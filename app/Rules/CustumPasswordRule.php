<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CustumPasswordRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $messages = [
           0=> 'Le champ :attribute est obligatoire.',
            1=> 'Le mot de passe doit contenir au moins :min caractères.',
             2 => 'Le mot de passe doit contenir au moins un chiffre, une lettre, et un caractère spécial.',
        ];
        $validator = Validator::make(request()->all(), [
            $attribute => ['required', Password::min(8)->letters()->mixedCase()->numbers()->uncompromised()],
        ]);


        if (!$validator->passes()) {
            $fail($validator->messages());
        }
    }
}
