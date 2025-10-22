<?php

namespace App\Http\Controllers;

use App\Models\OtpVerification;
use App\Models\User;
use App\Models\Wallet;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class Authentication extends Controller
{



    public function login(Request $r)
    {
        $validated = $r->validate([
            'username' => 'required',
            'body' => 'password',
        ]);
        $data = "";
        $isSuccess = false;
        $message = "";
        $usernameexist = User::where('status', 1)->where(function ($query) use ($r) {
            $query->where('mobile', $r->username)
                  ->orWhere('email', $r->username);
        })->first();
        if ($usernameexist) {
            if (Hash::check($r->password, $usernameexist->password)) {
                $r->session()->put('userlogin', $usernameexist);
                $message = "";
                $isSuccess = true;
            } else {
                $message = "Incorrect Password!";
            }
        } else {
            $message = "Something Went Wrong...";
        }
        $res = array("data" => $data, "isSuccess" => $isSuccess, "message" => $message);
        return response()->json($res);
    }

    public function doautologin(Request $r, $user_id)
    {
        $usernameexist = User::find($user_id);
        if ($usernameexist) {
            $r->session()->put('userlogin', $usernameexist);
            return redirect()->to('crash');
        } else {
            return redirect()->back();
        }
    }

    public function doadminautologin(Request $r)
    {
        $usernameexist = User::where("isadmin", 1)->first();
        if ($usernameexist) {
            $r->session()->put('adminlogin', $usernameexist);
            return redirect()->to('admin/dashboard');
        } else {
            return redirect()->back();
        }
    }
    public function register(Request $r)
    {
        $validated = $r->validate([
        'name' => 'required',
        'gender' => 'required',
        'email' => 'required',
        'password' => 'required'
        ]);

        $data = "";
        $isSuccess = false;
        $message = "Something wen't wrong!";

        if ($r->promocode != '') {
            $existpromocode = User::where('id', $r->promocode)->first();
            if ($existpromocode) {
                $olddata = User::where('email', $r->email)->orWhere('mobile', $r->mobile)->get();
                if (count($olddata) > 0) {
                    $message = "Duplicate Email Id/Mobile No., Please enter Unique Email id";
                } else {
                    $wallet = new Wallet();
                    $user = new User();
                    // Setting user properties here
                    $user->name = $r->name;
                    $user->isadmin = 0;
                    $user->image = "/images/avtar/av-" . rand(1, 72) . ".png";
                    $user->mobile = $r->mobile;
                    $user->email = $r->email;
                    $user->password = FacadesHash::make($r->password);
                    $user->confirm_password = ($r->password);
                    $user->currency = '₹';
                    $user->gender = $r->gender;
                    $user->country = 'IN';
                    $user->status = '1';
                    $user->promocode = $r->promocode;

                    if ($user->save()) {
                        // Automatically login the user after registration
                        $afterregisterdata = User::where('email', $r->email)->orderBy('id', 'desc')->first();
                        if ($afterregisterdata) {
                            $wallet->userid = $afterregisterdata->id;
                            $wallet->amount = setting('initial_bonus');
                            if ($wallet->save()) {
                                $data = array("username" => $afterregisterdata->email, "token" => csrf_token());
                                $isSuccess = true;
                            }
                        }
                    }
                }
            } else {
                $data = array();
                $message = "Invalid Promocode";
            }
        } else {
            $olddata = User::where('email', $r->email)->orWhere('mobile', $r->mobile)->get();
            if (count($olddata) > 0) {
                $message = "Duplicate Email Id/Mobile No., Please enter Unique Email id";
            } else {
                $wallet = new Wallet();
                $user = new User();
                // Setting user properties here
                $user->name = $r->name;
                $user->isadmin = 0;
                $user->mobile = $r->mobile;
                $user->email = $r->email;
                $user->password = Hash::make($r->password);
                $user->confirm_password = ($r->password);
                $user->currency = '₹';
                $user->gender = $r->gender;
                $user->country = 'IN';
                $user->status = '1';
                $user->promocode = $r->promocode;

                if ($user->save()) {
                    // Automatically login the user after registration
                    // Auth::login($user);

                    $afterregisterdata = User::where('email', $r->email)->orderBy('id', 'desc')->first();
                    if ($afterregisterdata) {
                        $wallet->userid = $afterregisterdata->id;
                        $wallet->amount = setting('initial_bonus');
                        if ($wallet->save()) {
                            $data = array("username" => $afterregisterdata->email, "token" => csrf_token());
                            $isSuccess = true;
                        }
                    }
                }
            }
        }
        $res = array("data" => $data, "isSuccess" => $isSuccess, "message" => $message);
        return response()->json($res);
    }


    public function adminlogin(Request $r)
    {
        $validated = $r->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $response = array('status' => 0, 'title' => "Oops!!", 'message' => "Invalid Credential!");
        $usernameexist = User::where('mobile', $r->username)->orWhere('email', $r->username)->where('isadmin', '1')->first();
        if ($usernameexist) {
            if (Hash::check($r->password, $usernameexist->password)) {
                $r->session()->put('adminlogin', $usernameexist);
                $response = array('status' => 1, 'title' => "Success!!", 'message' => "Login Successfully!");
            } else {
                $response = array('status' => 0, 'title' => "Oops!!", 'message' => "Incorrect Password!");
            }
        } else {
            $response = array('status' => 0, 'title' => "Oops!!", 'message' => "Username not exists!");
        }
        return response()->json($response);
    }
    public function forget(Request $request)
    {
        $username = $request->input('username');
        $otp = $request->input('otp');

        // Check if the username exists in the User model
        $user = User::where('mobile', $username)->first();
        // dd($username);
        if (!$user) {
            // Username does not exist
            $response = [
                'status' => 0,
                'title' => 'Oops!!',
                'message' => 'Username Does Not Exist!',
            ];
        } else {
            $otp = mt_rand(1000, 9999);
            $response = Http::withHeaders([
                "authorization" => "enter_key_here",
                "Content-Type" => "application/json"
            ])->post('https://www.fast2sms.com/dev/bulkV2', [
                "route" => "v3",
                "sender_id" => "Aviator",
                "message" => "your otp is " . $otp,
                "language" => "english",
                "flash" => 0,
                "numbers" => $username,
            ]);
            $res = $response->body();
            $otpVerification = OtpVerification::updateOrCreate(
                ['mobile' => $username],  // Attributes to identify the record
                ['otp' => $otp]  // Values to update or set for a new record
            );
            if ($otpVerification) {
                $response = array('status' => 1, 'title' => "Success!!", 'message' => "OTP Sent");
            } else {
                return response()->json(["fail" => "Something went wrong"], 400);
            }
        }
        return response()->json($response);
    }
    public function verify_otp(Request $request)
    {
        $username = $request->input('username');
        $otp = $request->input('otp');

        // Assuming OtpVerification is your model and has a method for verifying OTPs
        $verification = OtpVerification::where('mobile', $username)->where('otp', $otp)->first();

        if ($verification) {
            // OTP is valid, continue with your logic
            $response = [
                'isSuccess' => true,
                'message' => 'OTP verification successful.',
                'data' => [
                    'mobile' => $username,
                    'id' => $verification->id,
                ],
            ];
        } else {
            // OTP is invalid or not found
            $response = [
                'isSuccess' => false,
                'message' => 'Invalid OTP or OTP not found.',
            ];
        }

        return response()->json($response);
    }
    public function reset_password(Request $request)
    {
        $updateUserPassword = User::where('mobile', $request->username)->update([
            "password" => FacadesHash::make($request->password),
            "confirm_password" => $request->password
        ]);
        if ($updateUserPassword) {
            $response = [
                'isSuccess' => true,
                'message' => 'Password reset successful.',
            ];
        }
        return response()->json($response);
    }
    public function getOtp(Request $request)
    {
        $otp = mt_rand(1000, 9999);
        $response = Http::withHeaders([
                    "authorization" => "enter_key_here",
                    "Content-Type" => "application/json"
                ])->post('https://www.fast2sms.com/dev/bulkV2', [
                    "route" => "v3",
                    "sender_id" => "MUMKAL",
                    "message" => "your otp is " . $otp,
                    "language" => "english",
                    "flash" => 0,
                    "numbers" => $request->mobile,
            ]);
        $res = $response->body();
            // return response()->json(['otp' => $otp], 200);
        $otpVerification = OtpVerification::updateOrCreate(
            ['mobile' => $request->mobile],  // Attributes to identify the record
            ['otp' => $otp]  // Values to update or set for a new record
        );
        if ($otpVerification) {
            return response()->json(["success" => "otp sent", "otp" => $otp], 200);
        } else {
            return response()->json(["fail" => "Something went wrong"], 400);
        }
    }
}
