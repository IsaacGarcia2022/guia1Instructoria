<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = ['id_usuario', 'fecha_prestamo', 'fecha_devolucion'];

    public function usuario()
    {
        // Usamos el modelo User que Laravel trae por defecto
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePrestamo::class, 'id_prestamo');
    }
}
