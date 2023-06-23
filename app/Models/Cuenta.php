<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticable;

class Cuenta extends Authenticable
{
    use HasFactory;
    protected $table = 'cuentas';
    protected $primaryKey = 'user';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function perfiles():BelongsTo{
        return $this->belongsTo(Perfil::class, 'perfil_id', 'id');
    }

    public function imagenes():HasMany{
        return $this->hasMany(Imagen::class);
    }
}
