<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplainResponse extends Model
{
    use HasFactory;
    protected $table = 'complain_responses';

    protected $fillable = [
        'client_id',
        'user_id',
        'complain_id',
        'respond_direction',
        'respond_txt',
        'file1',
        'file2',
        'file3',
        'file4',
        'email',
    ];


    public function user_data()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // relation to my ticket
    public function complain_data()
    {
        return $this->belongsTo(Complains::class, 'complain_id');
    }
    
    public function client_data()
    {
        return $this->belongsTo(Clients::class, 'client_id', 'id');
    }
    

    }
