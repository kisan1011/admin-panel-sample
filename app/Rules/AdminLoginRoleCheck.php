<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\{User};

class AdminLoginRoleCheck implements Rule
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
       $count= User::where($attribute,$value)->orwhere('username',$value)->where('role','admin')->count();
       if($count>0)
       {
            return true;
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
        return "We can't find a user with that username or email address.";
    }
}
