<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

class CustomerController extends Controller
{
    use HasApiTokens;

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/[0-9]{8,12}/|max:12',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => (object)[],
                'errors' => $validator->errors()
            ], 422);
        }

        // $password = $this->getRandomString(8);

        // $message = $password;
        // $response = SendCustomerOtp::sendMessage($request->phone, $message);
        // $response = json_decode($response, true);

        // $response = [
        //     "return" => true,
        //     "request_id" => "lwdtp7cjyqxvfe9",
        //     "message" => [
        //         "Message sent successfully"
        //     ]
        // ];


        if ($request->phone) {

            $data = Customer::where('phone', $request->phone)->count();
            if ($data == 1) {

                $data = Customer::where('phone', $request->phone)->first();

                if (Customer::where('phone', $request->phone)->count() != 1) {
                    return response()->json([
                        'response_code' => 422,
                        'message' => 'Invalid details',
                        'errors' => (object)[],
                        'data' => (object)[]
                    ], 422);
                }

                $data['token'] = $data->createToken('myapptoken')->plainTextToken;

                return response()->json([
                    'response_code' => 201,
                    'message' => "Login successfully",
                    'errors' => (object)[],
                    'data' => $data
                ], 201);
            }

            $data = Customer::create([
                'phone' => $request->phone
            ]);

            $data['token'] = $data->createToken('myapptoken')->plainTextToken;

            return response()->json([
                'response_code' => 201,
                'message' => 'Registered successfully',
                'errors' => (object)[],
                'data' => $data
            ], 201);
        }
        return response()->json([
            'resonse_code' => 500,
            'message' => 'Error while sending SMS. Please try again later...',
            'data' => (object)[],
            'errors' => (object)[]
        ], 500);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone|regex:/[0-9]{8,12}/|max:12'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
                'data' => (object)[]
            ], 422);
        }

        $phone = $request->phone;

        $data = Customer::where('phone', $phone)->first();

        if (Customer::where('phone', $phone)->count() != 1) {
            return response()->json([
                'response_code' => 422,
                'message' => 'Invalid details',
                'errors' => (object)[],
                'data' => (object)[]
            ], 422);
        }

        $data['token'] = $data->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'response_code' => 201,
            'message' => "Login successfully",
            'errors' => (object)[],
            'data' => $data
        ], 201);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone|regex:/[0-9]{8,12}/|max:12',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
                'data' => (object)[]
            ], 422);
        }

        $password = $this->getRandomString(8);

        $message = $password;
        $response = SendCustomerOtp::sendMessage($request->phone, $message);
        $response = json_decode($response, true);

        if ($response['return']) {
            $data = [];

            Customer::where('phone', $request->phone)->update([
                'password' => bcrypt($password)
            ]);

            // $data['token'] = $data->createToken('myapptoken')->plainTextToken;
            $data['message'] = $response['message'];
            $data['password'] = $password;

            return response()->json([
                'response_code' => 201,
                'message' => 'Reset password sent successfully.',
                'errors' => (object)[],
                'data' => $data
            ], 201);
        }
        return response()->json([
            'resonse_code' => 500,
            'message' => 'Error while sending SMS. Please try again later...',
            'data' => (object)[],
            'errors' => (object)[]
        ], 500);
    }

    public function api_profile($phone)
    {
        return response()->json([
            'response_code' => 201,
            'message' => "View Profile",
            'errors' => (object)[],
            'data' => (object) [
                "profile" => Customer::where('phone', $phone)->first()
            ]
        ], 201);
    }


    public function api_updateprofile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:200',
            'phone' => 'required|regex:/[0-9]{8,12}/|max:12'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => (object)[],
                'errors' => $validator->errors()
            ], 422);
        }


        if ($request->has('image')) {
            $customer = Customer::where("id", $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'profile' => $request->image->store('Profile', 'public')
            ]);
        } else {
            $customer = Customer::where("id", $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address
            ]);
        }

        // dd(Customer::where("id",$request->id)->first());

        return response()->json([
            'response_code' => 201,
            'message' => "Your Profile Updated",
            'errors' => (object)[],
            'data' => (object) [
                "profile" => Customer::where("id", $request->id)->first()
            ]
        ], 201);
    }

    public function remove_token(Request $request)
    {

        $token = $request->token;
        $token_id = explode('|', $token)[0];

        $token = PersonalAccessToken::where('id', $token_id)->delete();

        if ($token) {
            $data = "Successfully Logout";
            return response()->json([
                'response_code' => 201,
                'message' => $data,
                'errors' => (object)[],
                'data' => (object)[]
            ]);
        } else {
            $data = "Error, Token Invalid";
            return response()->json([
                'response_code' => 422,
                'message' => $data,
                'errors' => (object)[],
                'data' => (object)[]
            ], 422);
        }
    }

    public function api_ChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone|regex:/[0-9]{8,12}/|max:12',
            // 'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
                'data' => (object)[]
            ], 422);
        }

        Customer::where('phone', $request->phone)->update([
            'password' =>  bcrypt($request->password)
        ]);

        return response()->json([
            'response_code' => 201,
            'message' => 'Password changed successfully.',
            'errors' => (object)[],
            'data' => (object)[]
        ], 201);
    }

    public function getRandomString($n)
    {
        $characters = '0123456789';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}
