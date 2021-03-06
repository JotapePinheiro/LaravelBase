<?php

namespace App\Applications\Site\Http\Controllers\Auth;

use App\Applications\Site\Http\Controllers\BaseController;
use App\Domains\Users\Social;
use App\Domains\Users\User;
use App\Domains\Users\Profile;
use App\Core\Traits\ActivationTrait;
use App\Core\Traits\CaptureIpTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;


class SocialController extends BaseController
{

    use ActivationTrait;

    public function getSocialRedirect( $provider )
    {

        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {

            return view('pages.status')
                ->with('error', trans('socials.noProvider'));

        }

        return Socialite::driver( $provider )->redirect();

    }

    public function getSocialHandle( $provider )
    {

        if (Input::get('denied') != '') {

            return redirect()->to('login')
                ->with('status', 'danger')
                ->with('message', trans('socials.denied'));

        }

        $socialUserObject = Socialite::driver( $provider )->user();

        $socialUser = null;

        // Check if email is already registered
        $userCheck = User::where('email', '=', $socialUserObject->email)->first();

        $email = $socialUserObject->email;

        if (!$socialUserObject->email) {
            $email = 'missing' . str_random(10);
        }

        if (empty($userCheck)) {

            $sameSocialId = Social::where('social_id', '=', $socialUserObject->id)
                ->where('provider', '=', $provider )
                ->first();

            if (empty($sameSocialId)) {

                $ipAddress  = new CaptureIpTrait;
                $socialData = new Social;
                $profile    = new Profile;
                $role       = Role::where('name', '=', 'user')->first();
                $fullname   = explode(' ', $socialUserObject->name);

                $user =  User::create([
                    'name'                  => $socialUserObject->nickname,//explode(' ', $user->name),
                    'first_name'            => $fullname[0],
                    'last_name'             => $fullname[1],
                    'email'                 => $email,
                    'password'              => bcrypt(str_random(40)),
                    'token'                 => str_random(64),
                    'activated'             => true,
                    'signup_sm_ip_address'  => $ipAddress->getClientIp(),

                ]);

                $socialData->social_id  = $user->id;
                $socialData->provider   = $provider;
                $user->social()->save($socialData);
                $user->attachRole($role);
                $user->activated = true;

                $user->profile()->save($profile);
                $user->save();

                if ($socialData->provider == 'github') {
                    $user->profile->github_username = $socialUserObject->nickname;
                }
                if ($socialData->provider == 'twitter') {
                    $user->profile()->twitter_username = $socialUserObject->username;
                }
                $user->profile->save();

                $socialUser = $user;

            }
            else {

                $socialUser = $sameSocialId->user;

            }

            auth()->login($socialUser, true);

            return redirect()->route('public.home')
                ->with('status', 'success')
                ->with('message', trans('socials.registerSuccess'));

        }

        $socialUser = $userCheck;

        auth()->login($socialUser, true);

        return redirect()->route('public.home');

    }
}