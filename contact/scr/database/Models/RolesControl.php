<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesControl extends Model
{
    use HasFactory;
    protected $table = 'roles_controls';
    protected $fillable = [
        'roles',
        'permission',
       
    ];
}
