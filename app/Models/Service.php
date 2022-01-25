<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;

    //`id`, `name`, `short_description`, `long_description`,
    // `service_image`, `category`, `emplyee`, `discountprice`, `price`, `time`, `status`,

    protected $fillable = ['name', 'short_description','long_description','service_image','category','employee','discountprice','price','time','status'];

    protected $casts = [
        'employee' => 'array'
    ];

    // public function singlecategory(){
    //     return $this->belongsTo(Category::class, 'category');
    // }

    public function getCategoryAttribute($val) {
        $category = Category::where('id', (int)$val)->get();
        return $category;
    }

    public function getEmployeeAttribute($val) {
        if($val != null && $val != ""){
            $employees = Employee::whereIn('id', json_decode($val, true))->get();
            return $employees;
        }else{
            return $val;
        }
    }

    public function getServiceImageAttribute($val)
    {
        return Storage::url("app/public/".$val);
        // return Storage::url($val);
    }
}
