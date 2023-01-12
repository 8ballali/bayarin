<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universities extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','email','address','phone','logo'
    ];
    public function students()
    {
        return $this->belongsTo(Students::class, 'university_id');
    }
}
