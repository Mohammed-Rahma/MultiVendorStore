<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    protected $forbaddin;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function __construct($forbaddin)
    {
        $this->forbaddin = $forbaddin;
    } 
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (in_array(strtolower($value) , $this->forbaddin)){
           $fail('this is name forbbiden');
        }
    }
}
