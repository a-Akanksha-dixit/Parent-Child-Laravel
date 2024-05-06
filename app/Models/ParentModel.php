<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ChildModel;

class ParentModel extends Model
{
    protected $fillable = ['father_name', 'mother_name'];

    // one to many relationship
    public function children()
    {
        return $this->hasMany(ChildModel::class);
    }
}
