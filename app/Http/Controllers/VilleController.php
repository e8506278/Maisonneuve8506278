<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    /**
     * Affiche la liste des villes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //récupérer toutes les villes de la DB
        $villes = Ville::all();

        //renvoie la vue avec les villes
        return view(
            'ville.index',
            [
                'villes' => $villes,
            ]
        );
    }

    /**
     * * Affiche le formulaire de création d'une nouvelle ville.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // NON UTILISÉE
    }

    /**
     * Stocke une ville nouvellement créée dans la BD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // NON UTILISÉE
    }

    /**
     * Affiche la ville spédifiée
     *
     * @param  \App\Models\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function show(Ville $ville)
    {
        return $ville; //renvoie les articles récupérés
    }

    /**
     * Affiche le formulaire de modification de la ville spécifiée.
     *
     * @param  \App\Models\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function edit(Ville $ville)
    {
        // NON UTILISÉE
    }

    /**
     * Met à jour la ville spécifiée dans la BD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ville $ville)
    {
        // NON UTILISÉE
    }

    /**
     * Supprime la ville spécifiée de la BD.
     *
     * @param  \App\Models\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ville $ville)
    {
        // NON UTILISÉE
    }
}
