<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArrayMax implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        public int $max,
        private string $delimiter = ';'
    ) {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $array = explode($this->delimiter, $value);

        return count($array) <= $this->max;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The you cannot be add more than {$this->max} :attribute";
    }
}
