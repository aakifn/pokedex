<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search'))
        {
            $pokemons = Pokemon::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        }
        else
        {
            $pokemons = Pokemon::paginate(10);
        }

        return Inertia::render('Pokedex/Index', [
            'pokemons' => $pokemons,
            'search' => $request->search,
        ]);
    }
}
