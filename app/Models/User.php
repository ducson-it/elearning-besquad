<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use MohamedGaber\SanctumRefreshToken\Traits\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'phone',
        'username',
        'address',
        'point',
        // 'role_id',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function role()
    // {
    //     return $this->belongsTo(Role::class,'role_id');
    // }

    public function vouchers()
    {
        return $this->belongsToMany(Voucher::class, 'user_voucher', 'user_id', 'voucher_id');
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_user', 'user_id', 'notification_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function studies()
    {
        return $this->hasMany(Study::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class,'studies','user_id','course_id');
    }

    public function teacherCourse()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
