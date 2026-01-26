<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'categories_id';
    protected $fillable = [
        'categories_name',
        'type',
    ];

    public $timestamps = true;

    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'categories_id', 'categories_id');
    }

    public function budgets()
    {
        return $this->hasMany(Budgets::class, 'categories_id', 'categories_id');
    }
}