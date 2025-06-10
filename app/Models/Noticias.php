<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Noticias extends Model
{
    
     /** @use HasFactory<\Database\Factories\UserFactory> */
     use HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'titulo_noticia_portada',
        'titulo_noticia',
        'descripcion_noticia',
        'imagenes',
        'imagen_noticia',
        'user_id'
    ];

}
