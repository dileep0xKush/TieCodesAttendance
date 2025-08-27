<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        // Hook into the creating event
        static::creating(function ($employee) {
            $employee->slug = $employee->generateUniqueString('slug', 'employees');
        });
    }

    public function generateUniqueString($column, $table)
    {
        do {
            $uniqueString = $this->generateRandomString(40);
        } while (DB::table($table)->where($column, $uniqueString)->exists());

        return $uniqueString;
    }

    public function generateRandomString($length)
    {
        $characters = 'b1L2p3G4w5Q6u1Z9t7K8l5V4C2j5a6m6X9n0i1R3A5h6v7Z8c9I2F6f7E9T2N4D7o2W0H1e4Y6M2B3z7P9q1r6S8w1U6k9d4y1x5g';
        return substr(str_shuffle(str_repeat($characters, ceil($length / strlen($characters)))), 0, $length);
    }


    public function attendance(){
        return $this->hasOne(Attendance::class,'user_id','id');
    }
}
