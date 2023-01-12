<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','invoice_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class,'id','user_id');
    }
    public function invoice()
    {
        return $this->hasMany(Invoice::class,'id','invoice_id');
    }
}
