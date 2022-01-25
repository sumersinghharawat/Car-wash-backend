<?php

namespace App\Http\Controllers;

use App\Http\Requests\addcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function api_category(){
        return ["categories"=>Category::where('parent_id',0)->get()];
    }

    public function api_subcategory($id){
        return ["subcategories"=>Category::where('parent_id',$id)->get()];
    }

    public function addcategory(Request $request){
        $data = ['categories'=>Category::where('parent_id',0)->get()];
        return view('addcategory',$data);
    }

    public function editcategory($id)
    {
        $data["categories"] = Category::where('parent_id',0)->get();
        $data["singlecategory"] = Category::where('id',$id)->first();
        return view('addcategory',$data);
    }

    public function api_addcategory(Request $request){

        if($request->id == ""){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:200'
            ]);
        }else{
            if($request->has('image')){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'description' => 'required|string',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:200'
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'description' => 'required|string|max:255'
                ]);
            }
        }
        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => $validator->errors()
            ], 422);
        }


        if($request->id == ""){

            $count = Category::where('category_name',$request->name)->count();

            if ($count > 0) {
                # code...
                return response()->json([
                    'status' => 409,
                    'data' => [
                        'category_name' => 'Already name existed!'
                    ]
                ]);
            }

            $category = Category::create([
                'category_name' => $request->name,
                'category_description' => $request->description,
                'category_status' => $request->has('status')? $request->status : 0,
                'parent_id' => !empty($request->parent) ? $request->parent : 0,
                'category_image' => $request->image->store('Category','public')
            ]);
            return response()->json([
                'status' => 201,
                'data' => "Category Added"
            ]);
        }else{

            $count = Category::where('category_name', $request->name)->where('id','<>',$request->id)->count();

            if ($count > 0) {
                # code...
                return response()->json([
                    'status' => 409,
                    'data' => [
                        'category_name' => 'Already name existed!'
                    ]
                ]);
            }

            $category = Category::whereId($request->id)->first();

            if($request->has('image')){
                $category = $category->update([
                    'category_name' => $request->name,
                    'category_description' => $request->description,
                    'category_status' => $request->has('status')? $request->status : 0,
                    'parent_id' => !empty($request->parent) ? $request->parent : 0,
                    'category_image' => $request->image->store('Category','public')
                ]);
            }else{

                $category = $category->update([
                    'category_name' => $request->name,
                    'category_description' => $request->description,
                    'category_status' => $request->has('status')? $request->status : 0,
                    'parent_id' => !empty($request->parent) ? $request->parent : 0
                ]);
            }
            return response()->json([
                'status' => 201,
                'data' => "Category Updated"
            ]);
        }


        // dd();
    }

    public function viewcategory(){
        $categories = Category::all();
        return view('viewcategory',['categories'=>$categories]);
    }

    public function deletecategory(Request $request){

        if(Category::where("id",$request->id)->delete()){

            return response()->json([
                'status' => 201,
                'data' => "Category Deleted"
            ]);

        }else{

            return response()->json([
                'status' => 422,
                'data' => "Category not existed"
            ]);
        }
    }

    public function api_categorystatus(Request $request){
// dd($request->all()["status"]);
        $result = Category::where(["id" => $request->all()["id"]])->update(["category_status" => $request->all()["status"]]);


        return response()->json([
            'status' => 201,
            'data' => "Category Status Updated"
        ]);
    }

}
