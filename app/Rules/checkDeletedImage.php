<?php

namespace App\Rules;

use App\Models\image;
use Illuminate\Contracts\Validation\Rule;

class checkDeletedImage implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $id;
    public function __construct($id)
    {

        $this->id=$id;

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

        $count=image::where("id",$value)->where("imageable_id",$this->id)->count();
        if($count==0){

            return false;
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
        return 'This image is not belongs to this task or feature';
    }
}
