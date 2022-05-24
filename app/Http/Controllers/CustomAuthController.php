<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ville;
use App\Models\Etudiant;
use App\Models\Article;
use App\Models\Doc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villes = Ville::all();

        return view(
            'auth.registration',
            [
                'villes' => $villes
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|min:2|max:191',
            'adresse'        => 'required',
            'phone'          => 'required',
            'date_naissance' => 'required',
            'ville_id'       => 'required|min:1',
            'email'          => 'required|email|unique:users',
            'password'       => 'required|min:6|max:20'
        ]);

        // On crée le user en premier, question d'obtenir le user_id
        $user_data = [
            'name'     => $request->name,
            'email'    => $request->email
        ];

        $user = new User;
        $user->fill($user_data);
        $user->password = Hash::make($request->password);
        $user->save();

        // On crée l'étudiant ensuite
        $user_id = $user->id;

        $etu_data = [
            'nom'               => $request->name,
            'adresse'           => $request->adresse,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'date_naissance'    => $request->date_naissance,
            'ville_id'          => $request->ville_id,
            'user_id'           => $user_id
        ];

        $etudiant = new Etudiant;
        $etudiant->fill($etu_data);
        $etudiant->save();

        // On retourne avec un message selon la langue en vigueur.
        $locale = session()->get('locale');

        if ($locale == 'fr') {
            $msgRetour = "Félicitations !";
        } else {
            $msgRetour = "Congratulations !";
        }        

        return redirect(route('login'))->withSuccess($msgRetour);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::validate($credentials)) :
            return redirect(route('login'))
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user, $request->get('remember'));

        return redirect()->intended('dashboard');
    }

    public function logout()
    {
        $locale = session()->get('locale');
        Session::flush();
        session()->put('locale', $locale);

        Auth::logout();
        return Redirect(route('login'));
    }

    public function showStudent(Request $request)
    {
        $user_id = Auth::user()->id;

        $etudiant = Etudiant::select()
            ->where('user_id', $user_id)
            ->get();

        $villes = Ville::all();

        $articles = Article::select()
            ->where('user_id', $user_id)
            ->orderby('updated_at', 'desc')
            ->get();

        $docs = Doc::paginate(10);
        $request->session()->put('referer', "");

        $msgRetour = $request->session()->get('msgRetour');
        $request->session()->put('msgRetour', '');

        return view(
            'etudiant.dashboard',
            [
                'etudiant'   => $etudiant[0],
                'villes'     => $villes,
                'articles'   => $articles,
                'docs'       => $docs,
                'msg_retour' => $msgRetour
            ]
        );
    }
}
