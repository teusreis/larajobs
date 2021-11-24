<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArrayMin implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        public int $min,
        public string $delimiter = ';'
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

        return count($array) >= $this->min;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "You must add at least {$this->min} :attribute";
    }
}
