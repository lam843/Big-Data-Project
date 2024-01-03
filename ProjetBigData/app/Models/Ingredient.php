<?php

namespace App\Models;

use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;

class Ingredient extends NeoEloquent
{
    protected $label = 'Ingredient';
    protected $fillable = ['name'];

    /**
     * Relation ManyToMany avec Recipe.
     */
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'HAS_INGREDIENT', 'Ingredient', 'Recipe');
    }
}
