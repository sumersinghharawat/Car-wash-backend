<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //

    use HasApiTokens;

    public function addemployee($id = ""){
        if($id == ""){
            $singleemployee = [];
            return view('addemployee',$singleemployee);
        }else{
            $singleemployee = ['singleemployee'=>Employee::where('id',$id)->get()[0]];
            return view('addemployee',$singleemployee);
        }
    }

    public function viewemployee(){
        $employee = ['employees'=>Employee::all()];
        return view('viewemployee',$employee);
    }

    public function api_addemployee(Request $request){

        // dd($request->all());

        if($request->has('image')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'contact' => 'required|min:10|numeric',
                'timein' => 'required',
                'timeout' => 'required|after:timein',
                'address' => 'required|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:200'
            ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => $validator->errors()
            ], 422);
        }


        $count = Employee::where('email',$request->email)->count();

        if ($count > 0) {
            # code...
            return response()->json([
                'status' => 409,
                'data' => [
                    'name' => 'Already email existed!'
                ]
            ]);
        }

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact,
            'address' => $request->address,
            'time_in' => $request->timein,
            'time_out' => $request->timeout,
            'status' => $request->has('status')? $request->status : 0,
            'profile_image' => $request->image->store('Employee','public')
        ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'contact' => 'required|min:10|numeric',
                'timein' => 'required',
                'timeout' => 'required|after:timein',
                'address' => 'required|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'response_code' => 422,
                    'message' => 'The given data was invalid.',
                    'data' => $validator->errors()
                ], 422);
            }


            $count = Employee::where('email',$request->email)->count();

            if ($count > 0) {
                # code...
                return response()->json([
                    'status' => 422,
                    'data' => [
                        'name' => ['0'=>'Already email existed!']
                    ]
                ]);
            }

            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->contact,
                'address' => $request->address,
                'time_in' => $request->timein,
                'time_out' => $request->timeout,
                'status' => $request->has('status')? $request->status : 0,
            ]);
        }


        if($employee){
            return response()->json([
                'status' => 201,
                'data' => "Employee Created"
            ]);
        }else{
            return response()->json([
                'status' => 409,
                'data' => "Something wrong"
            ]);
        }

    }

    public function api_employeestatus(Request $request){


        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => $validator->errors()
            ], 422);
        }

        $result = Employee::where('id',$request->id)->update(['status'=>($request->status)]);

        if($result){
            return response()->json([
                'status' => 201,
                'data' => "Employee Status Updated"
            ]);
        }else{
            # code...
            return response()->json([
                'status' => 409,
                'data' => [
                    'message' => 'Something Wrong!'
                ]
            ]);
        }
    }


    public function api_deleteemployee(Request $request){


        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => $validator->errors()
            ], 422);
        }

        $result = Employee::where('id',$request->id)->delete();

        if($result){
            return response()->json([
                'status' => 201,
                'data' => "Employee Deleted"
            ]);
        }else{
            # code...
            return response()->json([
                'status' => 409,
                'data' => [
                    'message' => 'Something Wrong!'
                ]
            ]);
        }
    }

    public function api_updateemployee(Request $request){


        if($request->has('image')){
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'contact' => 'required|min:10|numeric',
                'timein' => 'required',
                'timeout' => 'required|after:timein',
                'address' => 'required|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:200'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'response_code' => 422,
                    'message' => 'The given data was invalid.',
                    'data' => $validator->errors()
                ], 422);
            }

            $result = Employee::where('id',$request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->contact,
                'address' => $request->address,
                'time_in' => $request->timein,
                'time_out' => $request->timeout,
                'status' => $request->has('status')? $request->status : 0,
                'profile_image' => $request->image->store('Employee','public')
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'contact' => 'required|min:10|numeric',
                'timein' => 'required',
                'timeout' => 'required|after:timein',
                'address' => 'required|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'response_code' => 422,
                    'message' => 'The given data was invalid.',
                    'data' => $validator->errors()
                ], 422);
            }

            $result = Employee::where('id',$request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->contact,
                'address' => $request->address,
                'time_in' => $request->timein,
                'time_out' => $request->timeout,
                'status' => $request->has('status')? $request->status : 0
            ]);
        }

        if($result){
            return response()->json([
                'status' => 201,
                'data' => "Employee Details Updated"
            ]);
        }else{
            # code...
            return response()->json([
                'status' => 409,
                'data' => [
                    'message' => 'Something Wrong!'
                ]
            ]);
        }
    }

    public function api_viewemployee($id = ""){
        if($id == ""){
            return [
                'Employee'=>Employee::where('status',1)->get()
            ];
        }else{
            return [
                'Employee'=>Employee::where('id',$id)->where('status',1)->get()
            ];
        }
    }

}
