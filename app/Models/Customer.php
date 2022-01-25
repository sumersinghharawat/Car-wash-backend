<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = ['phone', 'password','name','email','address','profile'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProfileAttribute($val)
    {
        if($val == null){   
            return $val = "";
        }else{
            return Storage::url("app/public/".$val);
        }
    }

    public function getGenderAttribute($val)
    {
        if($val == null){   
            return $val = "";
        }else{
            return $val;
        }
    }
}
