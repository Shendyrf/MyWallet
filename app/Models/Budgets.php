<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budgets extends Model
{
    protected $table = 'budgets';
    protected $primaryKey = 'budget_id';
    protected $fillable = [
        'user_id',
        'categories_id',
        'amount_limit',
        'period',
        'start_date',
        'end_date',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'categories_id', 'categories_id');
    }
}
