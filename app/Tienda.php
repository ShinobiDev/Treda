<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'tienda_id', 'id');
    }
}
