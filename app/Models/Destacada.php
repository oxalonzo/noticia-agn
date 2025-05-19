<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Destacada extends Model
{
    
      /** @use HasFactory<\Database\Factories\UserFactory> */
     use HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'titulo_noticia_portada_destacada',
        'titulo_noticia_destacada',
        'descripcion_noticia_destacada',
        'imagen_noticia_destacada',
        'user_id'
    ];

}
