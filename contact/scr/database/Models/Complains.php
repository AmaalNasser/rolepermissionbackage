<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Complains extends Model
{
    use HasFactory;
    protected $table = 'complains';
    protected $fillable = [
        'client_id',
        'project_id',
        'email',
        'complain_category_id',
        'details',
        'file1',
        'file2',
        'file3',
        'file4',
        'status',
        'closed_by',
        'updated_by',
        'created_by',
        'deleted_by',
        'priority',
        'complain_subject',
    ];

    public function client_data()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
    public function project_data()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
    public function category_data()
    {
        return $this->belongsTo(ComplainsCategory::class, 'complain_category_id');
    }
    public function user_data()
    {
        return $this->belongsTo(User::class, 'closed_by');
    }
    
    // relation to may ticket
    public function complain_responses()
{
    return $this->hasMany(ComplainResponse::class, 'complain_id');
}
}
