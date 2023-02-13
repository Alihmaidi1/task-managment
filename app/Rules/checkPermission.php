<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class checkPermission implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
     
        $permission=config("permission");
        foreach($value as $val){

            if(!in_array($val,$permission)){

                return false;
            }

        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the permission value is not correct';
    }
}
