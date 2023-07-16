<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Notification extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'notifications';
    protected $fillable = ['title', 'content', 'is_send_email', 'expired',
        'priority','is_read','is_processed','is_deleted','link','notification_type','send_to','send_user'];

    public function recipients()
    {
        return $this->belongsToMany(User::class, 'notification_user', 'notification_id', 'user_id');
    }
}
