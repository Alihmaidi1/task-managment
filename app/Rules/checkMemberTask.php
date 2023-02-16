<?php

namespace App\Rules;

use App\Models\task;
use Illuminate\Contracts\Validation\Rule;

class checkMemberTask implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $members;
    public function __construct($task_id)
    {
        $this->members=task::findOrFail($task_id)->team->members;
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

        foreach($this->members as $member){

            if($member->id==$value){

                return true;
            }
        }

        return false;
        

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
