<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name', 'contact', 'established'];

    public function subBranches() {
        return $this->hasMany(SubBranch::class);
    }
}
