<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('social_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);
                return redirect('/welcome');
            } else {
                $newUser = User::create([
                    'fullname' => $user->name, // Assuming 'fullname' is the appropriate field in your database
                    'email' => $user->email,
                    'password' => Hash::make('my-google'), // You might want to generate a random password here
                    'social_id' => $user->id,
                    'social_type' => 'google',
                    'username' => $user->nickname ?? 'default_username', // Provide a default if not available
                ]);

                Auth::login($newUser);
                return redirect('/welcome');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}