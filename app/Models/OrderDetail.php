<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that can not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The relationship with orders table
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * The relationship with menus table
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
