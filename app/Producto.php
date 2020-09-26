<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function tienda(){
        return $this->belongsTo(Tienda::class, 'tienda_id');
    }
}
