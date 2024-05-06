<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ParentModel;

class ChildModel extends Model
{
    protected $fillable = ['child_name', 'parent_model_id'];

    // many to one
    public function parents()
    {
        return $this->belongsTo(ParentModel::class, 'parent_model_id');
    }
}
