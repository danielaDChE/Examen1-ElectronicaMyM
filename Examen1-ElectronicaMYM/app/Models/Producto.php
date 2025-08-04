<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string, float>
     */
    protected $fillable = [
        'nombre',
        'precio',
        'marca_id' // Clave foránea
    ];

    /**
     * Obtiene la marca a la que pertenece este producto.
     */
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }
}