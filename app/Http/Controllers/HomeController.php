<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\OrderBooking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile(){
        return view('profile',["data"=>User::get()->first()]);
    }

    public function updateprofile(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => ['required', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
                'data' => (object)[]
            ], 422);
        }
        
        if(trim($request->password) == ""){
        User::where('id', 1)
              ->update(['name' => $request->name,'email'=>$request->email]);
        }else{
            User::where('id', 1)
                  ->update(['name' => $request->name,'email'=>$request->email,'password'=>bcrypt($request->password)]);

        }



        return response()->json([
            'response_code' => 201,
            'message' => 'Profile Updated',
            'errors' => (object)[],
            'data' => (object) []
        ], 201);
    }

    public function dashboard(){
        $dashboard = (object)[];
        return view('/dashboard',['dashboard'=>$dashboard]);
    }
}
