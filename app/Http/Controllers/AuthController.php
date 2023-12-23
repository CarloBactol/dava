<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $attr = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users,email',
            'address' => 'required',
            'phone_number' => 'required|digits:11|unique:users,phone_number',
            'password' => 'required|min:6|confirmed',
        ]);


        // create users
        $user = User::create([
            'first_name' => $attr['first_name'],
            'last_name' => $attr['last_name'],
            'email' => $attr['email'],
            'address' => $attr['address'],
            'phone_number' => $attr['phone_number'],
            'password' => bcrypt($attr['password']),
            'role' => 'client',
        ]);

        Owner::create([
            'first_name' => $attr['first_name'],
            'last_name' => $attr['last_name'],
            'email' => $attr['email']
        ]);

        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken,
        ]);
    }
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        // create users
        if (!Auth::attempt($attr)) {
            return response([
                'message' => 'Invalid credentials'
            ], 403);
        }

        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken,
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success.'
        ], 200);
    }

    public function user_profile(Request $request)
    {
        $user  = User::where('email', $request->email)->first();
        return response(['profile' => $user], 200);
    }


    // public function forgot_password(Request $request)
    // {
    //     $input = $request->all();
    //     $rules = array(
    //         'email' => "required|email",
    //     );
    //     $validator = Validator::make($input, $rules);
    //     if ($validator->fails()) {
    //         $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
    //     } else {
    //         try {
    //             $response = Password::sendResetLink($request->only('email'), function (Message $message) {
    //                 $message->subject($this->getEmailSubject());
    //             });
    //             switch ($response) {
    //                 case Password::RESET_LINK_SENT:
    //                     return Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
    //                 case Password::INVALID_USER:
    //                     return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
    //             }
    //         } catch (\Swift_TransportException $ex) {
    //             $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
    //         } catch (Exception $ex) {
    //             $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
    //         }
    //     }
    //     return \Response::json($arr);
    // }

    public function forgot_password(Request $request)
    {
        $input = $request->only('email');
        $validator = Validator::make($input, [
            'email' => "required|email"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $response = Password::sendResetLink($input);

        $message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : "Something went wrong";

        return response()->json($message);
    }

    public function change_password(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return \Response::json($arr);
    }


    public function name(Request $request)
    {

        $services = Location::where('content', 'LIKE', "%$request->name%")->get();
        return response()->json(['name' => $services]);
    }
}
