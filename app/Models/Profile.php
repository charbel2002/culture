<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['id','c_name','pic','user_id'];

    public function bio()
    {
        return $this->hasOne(Bio::class);
    }

}
