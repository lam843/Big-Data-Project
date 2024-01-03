<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;

class Recipe extends NeoEloquent
{
    protected $label = 'Recipe';
    protected $fillable = ['title', 'instructions', 'ingredients','photo'];

    /**
     * Relation ManyToMany avec Ingredient.
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'HAS_INGREDIENT', 'Recipe', 'Ingredient');
    }
    /**
     * Récupère toutes les recettes ayant le même titre que celui passé en paramètre.
     *
     * @param string $title
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getRecipesByTitle($title)
    {
        return self::where('title', $title)->get();
    }

}