<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','slug'];

    public function permissions()
    {
        return $this->hasManyThrough(Permission::class,RolePermission::class,'role_id','id');
    }

    public function role_permissions()
    {
        return $this->hasMany(RolePermission::class);
    }

}
