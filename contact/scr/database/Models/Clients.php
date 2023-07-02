<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Clients extends Model
{
    use SoftDeletes;

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'clients';

    protected $fillable = [
        'client_id',
        'name',
        'contact_name_1',
        'contact_name_2',
        'email_1',
        'email_2',
        'contact_number_1',
        'contact_number_2',
        'description',
        'deleted_by',
        'contract',
        'notes',
        'status',
    ];

    public function complains()
    {
        return $this->hasMany(Complains::class, 'client_id');
    }
    
    public function complainResponse()
    {
        return $this->hasOne(ComplainResponse::class, 'client_id');
    }
    
    public function user_data()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
