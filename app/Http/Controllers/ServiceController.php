<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class ServiceController extends Controller
{


    use HasApiTokens;

    // public function addservices(){
        //     return view('addservices');
        // }

        public function api_addservice(Request $request){
            if($request->has('image')){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'short_description' => 'required',
                    'long_description' => 'required',
                    'category' => 'required',
                    'price' => 'required',
                    'time' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:200'
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'response_code' => 422,
                        'message' => 'The given data was invalid.',
                        'data' => $validator->errors()
                    ], 422);
                }


                $count = Service::where('name',$request->name)->count();

                // if ($count > 0) {
                //     # code...
                //     return response()->json([
                //         'status' => 409,
                //         'data' => [
                //             'name' => 'Already service existed!'
                //             ]
                //     ]);
                // }

                //`id`, `name`, `short_description`, `long_description`,
                // `service_image`, `category`, `employee`, `discountprice`, `price`, `time`, `status`,
                $service = Service::create([
                    'name' => $request->name,
                    'short_description' => $request->short_description,
                    'long_description' => $request->long_description,
                    'category' => $request->category,
                    'employee' => $request->employee,
                    'discountprice' => $request->discountprice,
                    'price' => $request->price,
                    'time' => $request->time,
                    'status' => $request->has('status')? $request->status : 0,
                    'service_image' => $request->image->store('Service','public')
                ]);
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'short_description' => 'required',
                    'long_description' => 'required',
                    'category' => 'required',
                    'discountprice' => 'required',
                    'price' => 'required',
                    'employee' => 'required',
                    'time' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:200'
                ]);


            }else{

                $validator = Validator::make($request->all(), [
                    'name' => $request->name,
                    'short_description' => $request->short_description,
                    'long_description' => $request->long_description,
                    'category' => $request->category,
                    'employee' => $request->employee,
                    'discountprice' => $request->discountprice,
                    'price' => $request->price,
                    'time' => $request->time,
                    'status' => $request->has('status')? $request->status : 0
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'response_code' => 422,
                        'message' => 'The given data was invalid.',
                        'data' => $validator->errors()
                    ], 422);
                }


                $count = Service::where('name',$request->name)->count();

                // if ($count > 0) {
                //     # code...
                //     return response()->json([
                //         'status' => 409,
                //         'data' => [
                //             'name' => 'Already service existed!'
                //         ]
                //     ]);
                // }

                $service = Service::create([
                    'name' => $request->name,
                    'short_description' => $request->short_description,
                    'long_description' => $request->long_description,
                    'category' => $request->category,
                    'employee' => $request->employee,
                    'discountprice' => $request->discountprice,
                    'price' => $request->price,
                    'time' => $request->time,
                    'status' => $request->has('status')? $request->status : 0
                ]);
            }


            if($service){
                return response()->json([
                    'status' => 201,
                    'data' => "Service Created"
                ]);
            }else{
                return response()->json([
                    'status' => 409,
                    'data' => "Something wrong"
                ]);
            }

        }

    public function api_servicestatus(Request $request){

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

        $result = Service::where('id',$request->id)->update(['status'=>($request->status)]);

        if($result){
            return response()->json([
                'status' => 201,
                'data' => "Service Status Updated"
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

    public function api_updateservice(Request $request){


        if($request->has('image')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'short_description' => 'required',
                'long_description' => 'required',
                'category' => 'required',
                'price' => 'required',
                'time' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:200'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'response_code' => 422,
                    'message' => 'The given data was invalid.',
                    'data' => $validator->errors()
                ], 422);
            }

            //`id`, `name`, `short_description`, `long_description`,
            // `service_image`, `category`, `employee`, `discountprice`, `price`, `time`, `status`,

            if($request->subcategory != null){
                $request->category = $request->subcategory; 
            }

            $service = Service::where('id',$request->id)->update([
                'name' => $request->name,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'category' => $request->category,
                'employee' => $request->employee,
                'discountprice' => $request->discountprice,
                'price' => $request->price,
                'time' => $request->time,
                'status' => $request->has('status')? $request->status : 0,
                'service_image' => $request->image->store('Service','public')
            ]);

        }else{

          
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'short_description' => 'required',
                'long_description' => 'required',
                'category' => 'required',
                'price' => 'required',
                'time' => 'required'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'response_code' => 422,
                    'message' => 'The given data was invalid.',
                    'data' => $validator->errors()
                ], 422);
            }

            if($request->subcategory != null){
                $request->category = $request->subcategory; 
            }
            
            $service = Service::where('id',$request->id)->update([
                'name' => $request->name,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'category' => $request->category,
                'employee' => $request->employee,
                'discountprice' => $request->discountprice,
                'price' => $request->price,
                'time' => $request->time,
                'status' => $request->has('status')? $request->status : 0
            ]);
        }


        if($service){
            return response()->json([
                'status' => 201,
                'data' => "Service Updated"
            ]);
        }else{
            return response()->json([
                'status' => 409,
                'data' => "Something wrong"
            ]);
        }

    }

    public function api_viewservice($category="",$id = ""){
        if($id == ""){
            return [
                'Services'=>Service::where('status',1)->where('category',$category)->get()
            ];
        }else{
            return [
                'Service'=>Service::where('id',$id)->where('category',$category)->where('status',1)->get()
            ];
        }
    }

    public function addservice($id = ""){
        if($id == ""){
            return view('addservice',["singleservice"=>"","categories"=>Category::where('parent_id',0)->get(),'employees'=>Employee::where('status',1)->get()]);
        }else{
            // dd(Service::where('id',$id)->get()[0]);
            return view('editservice',
                [
                    "categories"=>Category::where('parent_id',0)->get(),
                    'employees'=>Employee::where('status',1)->get(),
                    'singleservice'=>Service::where('id',$id)->get()[0]
                ]
            );
        }
    }

    public function viewservice(){
        $services = ['services'=>Service::all()];
        return view('viewservice',$services);
    }


    public function api_deleteservice(Request $request){

        if(Service::where("id",$request->id)->delete()){

            return response()->json([
                'status' => 201,
                'data' => "Service Deleted"
            ]);

        }else{

            return response()->json([
                'status' => 422,
                'data' => "Service not existed"
            ]);
        }
    }
}
