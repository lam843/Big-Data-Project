<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;
use Illuminate\Support\Facades\Hash;

class User extends NeoEloquent
{
    protected $label = 'User';
    protected $fillable = ['username', 'email', 'password'];

    public static function authenticate($username, $password)
    {
        // Recherchez l'utilisateur par nom d'utilisateur
        $user = self::where('username', $username)->first();

        if ($user) {
            // Vérifiez si le mot de passe entré correspond au mot de passe haché dans la base de données
            if (Hash::check($password, $user->password)) {
                return $user; // Authentification réussie, retournez l'utilisateur
            }
        }

        return null; // Authentification échouée
    }
}
