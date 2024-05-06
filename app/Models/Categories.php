<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Categories extends Model
{
    protected $table = 'categories';

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_parent');
            $table->boolean('is_leaf');
            $table->string('path');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function subcategories()
    {
        return $this->hasMany(Categories::class, 'parent_id');
    }
    
}
