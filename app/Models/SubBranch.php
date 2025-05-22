<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubBranch extends Model
{
  protected $fillable = [
    'branch_id',
    'name',
    'contact',
    'address',
];



    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
