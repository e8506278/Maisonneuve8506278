<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;

use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class EtudiantController extends Controller
{
    /**
     * Affiche la liste des étudiants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $etudiants = Etudiant::paginate(10);

        $msgRetour = $request->session()->get('msgRetour');
        $request->session()->put('msgRetour', '');

        return view(
            'etudiant.index',
            [
                'etudiants'  => $etudiants,
                'msg_retour' => $msgRetour
            ]
        );
    }

    /**
     * Affiche le formulaire de création d'un nouvel étudiant.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villes = Ville::all();
        return  view('etudiant.create', ['villes' => $villes]);
    }

    /**
     * Stocke un étudiant nouvellement créé dans la BD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nouvelEtudiant = Etudiant::create([
            'nom'            => $request->nom,
            'adresse'        => $request->adresse,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville_id'       => $request->ville_id
        ]);

        $nom = $request->nom;

        $request->session()->put('msgRetour', "Ajout de '" . $nom . "' effectué !");
        return redirect(route('etudiant.show', $nouvelEtudiant->id));
    }

    /**
     * Affiche l'étudiant spécifié.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Etudiant $etudiant)
    {
        $villes = Ville::all();

        $msgRetour = $request->session()->get('msgRetour');
        $request->session()->put('msgRetour', '');

        return  view(
            'etudiant.show',
            [
                'etudiant'   => $etudiant,
                'villes'     => $villes,
                'msg_retour' => $msgRetour
            ]
        );
    }

    /**
     * Affiche le formulaire de modification de l'étudiant spécifié.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        $villes = Ville::all();

        return  view(
            'etudiant.edit',
            [
                'etudiant' => $etudiant,
                'villes'   => $villes
            ]
        );
    }

    /**
     * Met à jour l'étudiant spécifié dans la BD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $etudiant->update([
            'nom'            => $request->nom,
            'adresse'        => $request->adresse,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville_id'       => $request->ville_id
        ]);

        $nom = $etudiant->nom;
        $request->session()->put('msgRetour', "Modification de '" .  $nom . "' effectuée !");

        return redirect(route('etudiant.show', $etudiant->id));
    }

    /**
     * Supprime l'étudiant spécifié de la BD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Etudiant $etudiant)
    {
        $nom = $etudiant->nom;
        $etudiant->delete();

        $request->session()->put('msgRetour', "Destruction de '" . $nom . "' effectuée !");
        return redirect(route('etudiant'));
    }
}
