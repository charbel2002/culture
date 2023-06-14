<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function can($permission, $arguments = [])
    {
        [$operation, $resource] = explode('-', $permission);

        $data = explode('-', $permission);

        $operation = $data[0];

        array_shift($data);

        $resource = implode('-',$data);

        $role_permissions = $this->roles[0]->role_permissions;

        $permissions = [];

        $slugs = [];

        foreach($role_permissions as $key => $r_perm)
        {

            $permissions[] = Permission::find($r_perm->permission_id);

        }

        foreach($permissions as $key => $permission)
        {

            $slugs[] = $permission->slug;

        }

        // return $this->roles->load('permissions')->flatMap(function ($role) {
        //     return $role->permissions->map->slug;
        // })->contains("{$operation}-{$resource}");

        return in_array("{$operation}-{$resource}",$slugs);
    }

    public function roles()
    {
        return $this->hasManyThrough(Role::class, UserRole::class,'user_id','id');
    }

    public function role()
    {
        return $this->hasOneThrough(Role::class, UserRole::class,'user_id','id');
    }

    public function user_role()
    {
        return $this->hasOne(UserRole::class);
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function music()
    {
        return $this->hasManyThrough(Music::class,Playlist::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function music_read()
    {
        return $this->hasMany(MusicRead::class);
    }

    public function music_download()
    {
        return $this->hasMany(MusicDownload::class);
    }

    public function playlist_consult()
    {
        return $this->hasMany(PlaylistConsult::class);
    }

}
