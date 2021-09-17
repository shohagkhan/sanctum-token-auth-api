<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; //3. For Sanctum Authentication

//0. First three command in Sanctum documentation.
//1. Update Route Service provider file- uncomment - protected $namespace = 'App\\Http\\Controllers';
//4. Then register, create sanctum token in login controller and group all route with sanctum middleware that need auth.


class Student extends Model
{
    use HasFactory, HasApiTokens; //2. For Sanctum Authentication (HasApiTokens)
    protected $table = "students";
    public $timestamps = false; // Important if I don't keep timestap field
    protected $fillable = ['name', 'email', 'password', 'phone_no']; // For mass input
}
