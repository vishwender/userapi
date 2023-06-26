<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class UserImg extends Model
{
    use HasFactory, HasApiTokens;
    public $timestamps = false;
    protected $table = "user_img";
    protected $fillable = ['location_pincode', 'phone_number','media_link','updated_date','is_checked','is_downloaded','is_deleted'];
}
