<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CpfValidation implements Rule
{
    public function passes($attribute, $value)
    {
        // Remove any non-digit characters
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Check if length is 11 digits
        if (strlen($cpf) != 11) {
            return false;
        }

        // Check for invalid patterns like all same digits
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Validate CPF using calculation
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'O CPF informado é inválido.';
    }
}
