<?php

namespace App\Listeners;

use App\Events\RecipeDeleted;
use App\Models\Ingredient;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteUnlinkedIngredients
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\RecipeDeleted  $event
     * @return void
     */
    use InteractsWithQueue;

    public function handle(RecipeDeleted $event)
    {
        $recipe = $event->recipe;

        // Obtenez tous les ingrédients non liés
        $unlinkedIngredients = Ingredient::doesntHave('recipes')->get();

        // Supprimez ces ingrédients
        $unlinkedIngredients->each->delete();
    }
}
