<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'image',
        'branch_id',
        'sub_branch_id'
    ];

    // Trainer.php

public function branch()
{
    return $this->belongsTo(Branch::class, 'branch_id');
}

public function subBranch()
{
    return $this->belongsTo(SubBranch::class, 'sub_branch_id');
}


}


