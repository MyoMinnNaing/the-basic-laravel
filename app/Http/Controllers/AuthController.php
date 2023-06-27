<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // Authentication Methods
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        $request->validate([
            "name" => "required|min:4",
            "email" => "required|email|unique:students,email",
            "password" => "required|min:8",
            "password_confirmation" => "same:password"
        ]);

        $verify_code = rand(100000, 999999);

        //mailing step
        logger('Your verify code is' . $verify_code);


        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->verify_code = $verify_code;
        $student->user_token = md5($verify_code);
        $student->save();
        return redirect()->route("auth.login")->with('message', "registered successful");
    }

    public function login()
    {
        return view('auth.login');
    }

    public function check(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:students,email",
            "password" => "required|min:8",
        ], [
            "email.exists" => "email or password wrong"
        ]);

        $student = Student::where('email', $request->email)->first();

        if (!Hash::check($request->password, $student->password)) {
            return redirect()->route('auth.login')->withErrors(['email' => "email or password wrong"]);
        }

        session(['auth' => $student]);

        return redirect()->route('dashboard.home');
    }


    public function logout()
    {

        session()->forget('auth');
        return redirect()->route('auth.login');
    }


    // Verify Email Methods
    public function passwordChange()
    {
        return view('auth.password-change');
    }

    public function passwordChanging(Request $request)
    {

        $request->validate([
            "current_password" => "required|min:8",
            "password" => "required|min:8",
            "password_comfirmation" => "same:password"
        ]);


        // check current_password(New password) ===  user's logoin password(Old Password) in session
        if (!Hash::check($request->current_password, session('auth')->password)) {
            return redirect()->back()->withErrors(['current_password' => "Password does not mathch"]);
        }


        //  Updat New Password
        $student = Student::find(session('auth')->id);
        // return $student;
        $student->password = Hash::make($request->password);
        $student->update();

        // clear auth session
        session()->forget('auth');

        return redirect()->route('auth.login');
    }

    public function verify()
    {
        return view('auth.verify_email');
    }

    public function verifying(Request $request)
    {

        $request->validate([
            "verify_code" => "required|numeric"
        ]);

        if ($request->verify_code != session('auth')->verify_code) {
            return redirect()->back()->withErrors(["verify_code" => "Incorrect verify code"]);
        }

        //  Update email_verify_at
        $student = Student::find(session('auth')->id);
        // return $student;
        $student->email_verified_at = now();
        $student->update();


        session(['auth' => $student]);

        return redirect()->route('dashboard.home');
    }


    // Password Reset Methods
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:students,email"
        ], [
            'email.exists' => "registered လုပ်ခဲ့တုန်းက email မဟုတ်ပါ"
        ]);

        $student = Student::where('email', $request->email)->first();
        // return $student;
        $link = route('auth.newPassword', ['user_token' => $student->user_token]);

        logger('your password reset link is ' . $link);
        session(['link' => $link]);

        return redirect()->route('auth.login')->with('link', $link);
    }

    public function newPassword()
    {
        $token = request()->user_token;
        $student = Student::where("user_token", $token)->first();

        // Student က null ဖြစ်နေရင် 403 နဲ့ ခွင့်မပြုကြောင်း ပြောမယ်
        if (is_null($student)) {
            return abort(403, "u are not allowed");
        }

        // Student Object ပါလာခဲ့ရင်တေ့ာ password reset change တဲ့ form ကို ပြပေးမယ်။။
        return view('auth.to-reset-password', ['user_token' => $token]);
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            "user_token" => "required|exists:students,user_token",
            "password" => "required|min:8",
            "password_comfirmation" => "same:password"
        ], [
            // user_token မမှန်ခဲ့ရင် noti message ကို custom ရေးခြင်း
            "user_token.exists" => "something worng"

        ]);

        // to update pasword
        $student = Student::where("user_token", $request->user_token)->first();
        $student->password = Hash::make($request->password);
        $student->user_token = md5(rand(100000, 999999));
        $student->update();

        $link = route('auth.newPassword', ['user_token' => $student->user_token]);


        return redirect()->route('auth.login')->with("message", "reset password successful");
    }
}
