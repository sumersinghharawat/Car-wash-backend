<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBooking extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','service_id', 'employee_id', 'slot', 'price'];

    public function getCustomerIdAttribute($val) {
        $customer = Customer::where('id',$val)->first();
        return $customer;
    }

    public function getServiceIdAttribute($val) {
        $service = Service::where('id',$val)->first();
        return $service;
    }

    public function getEmployeeIdAttribute($val) {
        $employee = Employee::where('id',$val)->first();
        return $employee;
    }
}
