<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use Exception;

class SocialAuthGoogleController extends Controller {

    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback() {
        try {


            $googleUser = Socialite::driver('google')->user();
            // echo $googleUser->email;
            $arrayemail = explode("@", $googleUser->email);
            if ($arrayemail[1] == "iiti.ac.in") {
                //  print_r($arrayemail );exit;
                $existUser = User::where('email', $googleUser->email)->first();


                if ($existUser) {
                    Auth::loginUsingId($existUser->id);
                    if ($existUser->role_id == User::ADMIN) {
                        return redirect()->to('/home');
                    }
                } else {
                    $user = new User;
                    $user->name = $googleUser->name;
                    $user->email = $googleUser->email;
                    $user->role_id=3;
               //     $user->google_id = $googleUser->id;
                    $user->password = md5(rand(1, 10000));
                    $user->save();
                    Auth::loginUsingId($user->id);
                }
                return redirect()->to('/home');
            } else {
                return redirect()->to('/login')->withErrors(['email' => "Please login with Institute Email-Id"]);
            }
        } catch (Exception $e) {
            return 'error' . $e;
        }
    }

}
