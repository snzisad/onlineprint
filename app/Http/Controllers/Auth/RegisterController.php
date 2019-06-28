<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controlleruse Illuminate\Support\Facades\Redirect;
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    |--------------------------------------------------------------------------
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    public function showRegistrationForm()
    {
        return redirect('/');
    }

    // protected $redirectTo = '/verify';

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return \Redirect::route('showVerifyForm', ['id'=>$user->id]);
    }

    public function showVerificationForm($id){
        return view("auth/verification");
    }

    public function verify(Request $request, $id){
        $this->validate($request,[
            'code' => 'required|integer'
        ]);

        $user = User::where('id', $id)->first();

        if($user->verificaton_code == $request->code){
            $user->status = "1"; //changed the status as verified
            $user->save();

            Auth::guard()->login($user);

            return redirect("/profile");
        }
        else{
            return redirect()->back()->withErrors("Invalid verification code");
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'phone' => ['required', 'string', 'max:15', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {
        // return dd($data);
        $verification_code = rand(123456, 999999);
        $email = $data['email'];
        $this->send_verification_code_to_mail($verification_code, $email);

        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $email,
            'verificaton_code' => $verification_code,
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function send_verification_code_to_mail($code, $email)
    {
        $data = [
            'code' => $code
        ];

        Mail::send('mail', $data, function ($message) use ($email) {
            $message->to($email)->subject('Onlineprint Verification Code');
            $message->from('support@onlineprint.com', 'Onlineprint');
        });
    }
}
