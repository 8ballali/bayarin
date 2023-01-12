<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','nim','address','fakultas','prodi','phone','gender','university_id'
    ];

    public function users()
    {
        return $this->hasOne(Roles::class,'id','user_id');
    }
    public function universities()
    {
        return $this->hasOne(Universities::class,'id','university_id');
    }
}
