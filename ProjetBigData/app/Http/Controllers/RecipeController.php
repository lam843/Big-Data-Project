<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Storage;
use GraphAware\Neo4j\Client\ClientBuilder;

class RecipeController extends Controller
{
    // Affiche le formulaire de création de recette
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('recipes.create', compact('ingredients'));
    }
    public function index2()
    {
        $recipes = Recipe::all();
        return view('web.index', compact('recipes'));
    }

public function index(Request $request)
{
    $searchTitle = $request->input('searchTitle');

    if ($searchTitle) {
        // Si le titre de recherche est fourni, utilisez la fonction pour obtenir les recettes
        $recipes = Recipe::getRecipesByTitle($searchTitle);
      } else {
        // Sinon, récupérer toutes les recettes
        $recipes = Recipe::all();
    }

    return view('recipes.index', compact('recipes'));
}


    // Stocke une nouvelle recette dans la base de données
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $this->validate($request,[
            'title' => 'required|string|max:255',
            'instructions' => 'required|string',
            'ingredients' => 'required|string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Stockage de la recette dans la base de données Neo4j
        $recipe = Recipe::create([
            'title' => $request->input('title'),
            'instructions' => $request->input('instructions'),
            'ingredients' => $request->input('ingredients'),
            'photo' => null,
        ]);
            // Gestion de la photo si elle est fournie
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('recipes', 'public'); // Stockez la photo dans le dossier "recipes" du répertoire "public"
        $recipe->photo = $photoPath;
        $recipe->save();
    }
        // Sauvegarde de la recette
        $recipe->save();

        // Récupération des ingrédients saisis par l'utilisateur
        $ingredientsList = explode(',', $request->input('ingredients'));

        // Enregistrez chaque ingrédient dans la base de données
        foreach ($ingredientsList as $ingredientName) {
              $ingredient = Ingredient::firstOrCreate(['name' => trim($ingredientName)]);
             // Attachez l'ingrédient à la recette
              $recipe->ingredients()->attach($ingredient->id);
         }

      
    // // Redirection avec un message de succès
// Redirection avec un message de succès
return redirect()->route('web.index')->with('success', 'Recette ajoutée avec succès');
   
    }
    
    ////////////////////////////////////////////////////////////////////
   
public function edit(Recipe $recipe)
{
    return view('recipes.edit', compact('recipe'));
}

public function update(Request $request, Recipe $recipe)
{
    // Validation des données du formulaire
    $this->validate($request,[
        'title' => 'required|string|max:255',
        'instructions' => 'required|string',
        'ingredients' => 'required|string',
    ]);

    // Mettez à jour les données de la recette
    $recipe->update([
        'title' => $request->input('title'),
        'instructions' => $request->input('instructions'),
        'ingredients' => $request->input('ingredients'),
        ]);

    // Mettez à jour les ingrédients associés à la recette
    $recipe->ingredients()->detach(); // Détachez tous les ingrédients actuels
    $ingredientsList = explode(',', $request->input('ingredients'));

    foreach ($ingredientsList as $ingredientName) {
        $ingredient = Ingredient::firstOrCreate(['name' => trim($ingredientName)]);
        $recipe->ingredients()->attach($ingredient->id);
    }
    $recipe->save();
    // Redirection avec un message de succès
    return redirect()->route('web.index')->with(['success' => 'Recette est mettre a jour avec succès']);
}
//////////////////////////////////////////////////////////////////
public function destroy(Recipe $recipe)
{
    // Détachez tous les ingrédients associés à la recette
    $recipe->ingredients()->detach();

    // Supprimez la recette
    $recipe->delete();
    
    // Redirection avec un message de succès
    return redirect()->route('web.index')->with('success', 'Recette supprimée avec succès');
}
/////////////////////////////////////////////////////////////////
}