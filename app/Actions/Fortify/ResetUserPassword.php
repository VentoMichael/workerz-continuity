<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function reset($user, array $input)
    {
        Validator::make($input, [
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed'
            ]
        ])->validate();

        if(Session::get('applocale') === 'en') {
            Session::flash('success-update', 'Your password has been updated!');
        }elseif(Session::get('applocale') === 'nl') {
            Session::flash('success-update', 'Uw wachtwoord is bijgewerkt!');
        }else{
            Session::flash('success-update', 'Votre mot de passe a bien été mis a jour!');
        }
        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

    }
}
