<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomCategorie',
        'imageCategorie'
    ];

    public function sCategorie() {
        return $this -> hasMany(Scategorie::class, 'categorieID');
    }
}
