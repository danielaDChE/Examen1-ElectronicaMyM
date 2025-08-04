<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = ['nombre'];

    /**
     * Obtiene los productos asociados a esta marca.
     */
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }
}