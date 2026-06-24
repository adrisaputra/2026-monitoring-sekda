<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $fillable =[
        'office_id',
        'name',
        'desc'
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}
