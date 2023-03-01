<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;

    protected $fillable = ['title','keywords','description','generated_content','use_case_id','user_id'];

    public function useCase(){
        return $this->belongsTo(UseCase::class,'use_case_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
