<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ["name", "describe", "image", "is_active", "type_id"];
    public function type(){
        return $this->belongsTo(Type::class);
    }
}
