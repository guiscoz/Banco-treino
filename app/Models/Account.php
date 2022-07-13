<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    //o protected de casts é importe para informar que items é um array e não uma string
    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    protected $guarded = []; //tudo que é atualizado pelo POST pode ser guardado aqui

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
