<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Clientes extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table ='clientes';
    
    protected $fillable = [
           'nome',
           'whatsapp',
           'cpfcnpj',
           'endereco',
           'site',
           'tag',
           'user_id',
     
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
