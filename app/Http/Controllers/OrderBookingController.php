<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\OrderBooking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class OrderBookingController extends Controller
{
    //

    use HasApiTokens;

    public function api_booking_slot(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'employee_id' => 'required',
            'customer_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => (object)[],
                'errors' => $validator->errors()
            ], 422);
        }

        $slots = $this->checkslot($request->service_id, $request->employee_id);

        return response()->json([
            'response_code' => 201,
            'message' => 'Available slot list',
            'errors' => (object)[],
            'data' => (object) ['slotlist' => $slots]
        ], 201);
    }

    public function api_order_now(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|min:1',
            'service_id' => 'required|min:1',
            // 'employee_id' => 'required|min:1',
            // 'slot' => 'required|date_format:Y-m-d H:i:s',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => (object)[],
                'errors' => $validator->errors()
            ], 422);
        }

        if($request->customer_id <= 0 ||  trim($request->customer_id) == ""){
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => (object)[],
                'errors' => 'Customer Id 0'
            ], 422);
        }

        // $count = OrderBooking::where('status', 0)->where('slot', $request->slot)->count();

        if ($request->id != "") {
            return response()->json([
                'response_code' => 422,
                'message' => 'Sorry, Slot Booked',
                'data' => (object)[],
                'errors' => (object)[]
            ], 422);
        }

        $data = OrderBooking::create([
            'service_id' => $request->service_id,
            // 'employee_id' => $request->employee_id,
            'customer_id' => $request->customer_id,
            // 'slot' => $request->slot,
            'price' => $request->price
        ]);

        return response()->json([
            'response_code' => 201,
            'message' => 'Order Booked',
            'errors' => (object)[],
            'data' => (object) $data
        ], 201);
    }

    public function checkslot($service_id, $employee_id)
    {


        $employee = Employee::where('id', $employee_id)->get()[0];
        $service = Service::where('id', $service_id)->get()[0];

        function minutes($time)
        {
            $time = explode(':', $time);
            return ($time[0] * 60) + ($time[1]) + ($time[2] / 60);
        }



        $slots = [];
        for ($i = 0; $i < 4; $i++) {
            
            date_default_timezone_set("Asia/Kolkata");
            $timein = minutes($employee->time_in);
            $servicetime = minutes($service->time);
            $timeout = minutes($employee->time_out) - $servicetime;
            
            $today = (string) date("Y-m-d", strtotime('+' . $i . ' days'));
            $slots["date"][$i]["name"] = $today;
            $slots["date"][$i]["time"] = [];


            for (; $timein <= $timeout; $timein += $servicetime) {
                $slottimehr = sprintf("%02d", $timein / 60);
                $slottimemin = sprintf("%02d", $timein % 60);
                $actualtime = $slottimehr . ":" . $slottimemin . ":00";
                $slottime =  date("H:i:s", strtotime($actualtime));
                $bookings = OrderBooking::where('status', '0')->get();
                foreach ($bookings as $booking) {
                    if ($today . " " . $slottime != $booking->slot) {
                        array_push($slots["date"][$i]["time"],$slottime);
                    }
                }

                if ($bookings->all() == null) {
                    if(!in_array($slottime,$slots["date"][$i]["time"])){
                        array_push($slots["date"][$i]["time"], $slottime);
                    }else{
                        array_push($slots["date"][$i]["time"], $slottime);
                    }
                }
            }

            $time = $slots["date"][$i]["time"];
            
                        
            $slots["date"][$i]["time"] = (array) $time;
            

        }

        return $slots;
    }

    public function order_confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => (object)[],
                'errors' => $validator->errors()
            ], 422);
        }

        $order = OrderBooking::whereId($request->order_id)->first();

        $data = OrderBooking::where('id', $request->order_id)->update(['status' => $request->status]);

        if ($request->status == -1) {
            return response()->json([
                'response_code' => 201,
                'message' => 'Order Cancelled',
                'errors' => (object)[],
                'data' => (object) OrderBooking::where('id', $request->order_id)->first()
            ], 201);
        } else {
            if ($request->status == 1) {
                return response()->json([
                    'response_code' => 201,
                    'message' => 'Order Confirmed',
                    'errors' => (object)[],
                    'data' => OrderBooking::where('id', $request->order_id)->first()
                ], 201);
            }
        }
    }

    public function api_orders($id){
        // dd($id);
        
        $validator = Validator::make(['id'=>$id], [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => (object)[],
                'errors' => $validator->errors()
            ], 422);
        }

        $orderlist = OrderBooking::where('customer_id',$id)->where('status','0')->get();

        return response()->json([
            'response_code' => 201,
            'message' => 'Order List',
            'errors' => (object)[],
            'data' => (object) $orderlist
        ], 201);

    }
    

    public function api_transaction($id){
        // dd($id);
        
        $validator = Validator::make(['id'=>$id], [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'data' => (object)[],
                'errors' => $validator->errors()
            ], 422);
        }

        $orderlist = OrderBooking::where('customer_id',$id)->where('status', '!=', '0')->get();

        return response()->json([
            'response_code' => 201,
            'message' => 'Order List',
            'errors' => (object)[],
            'data' => (object) $orderlist
        ], 201);

    }




    public function api_deleteorder(Request $request){
        
        try {
            //code...

            if(OrderBooking::where('id',$request->id)->where('status',0)->count() == 1){

                return response()->json([
                    'response_code' => 422,
                    'message' => 'Order not completed.',
                    'errors' => 'Order not completed.',
                    'data' => (object)[]
                ], 422);
            }
            
            OrderBooking::where('id',$request->id)->delete();
            
            return response()->json([
                'response_code' => 201,
                'message' => 'Order deleted successfully.',
                'errors' => (object)[],
                'data' => 'Order deleted successfully'
            ], 201);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'response_code' => 500,
                'message' => 'Something wrong',
                'errors' => (object)[],
                'data' => (object) $th
            ], 201);
        }
        
        
    }

    public function vieworders(){
        return view('vieworders',['orders'=>OrderBooking::all()]);
    }
    
    
    
}
