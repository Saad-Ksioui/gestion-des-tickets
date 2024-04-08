<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Role;
use App\Models\User;
use App\Models\Statut;
use App\Models\Ticket;
use App\Models\Priorite;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $statuts = Statut::all();
        $tickets = Ticket::all();
        return view('admin.admin-dashboard', compact('tickets', 'statuts'));
    }
    //!/* User Management */
    public function createUser()
    {
        $roles = Role::all();
        return view('admin.User Management.create-user', compact('roles'));
    }
    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'nom_complet' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer',
        ]);

        User::create([
            'nom_complet' => $validatedData['nom_complet'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'],
        ]);
        return back()->with('success', 'Vous avez bien créé un compte');
    }
    public function listUsers()
    {
        $currentUserId = Auth::id();
        $users = User::where('id', '!=', $currentUserId)->paginate(5);
        return view('admin.User Management.list-users', compact('users'));
    }
    //!/* Statut Management */
    public function listStatuts()
    {
        $statuts = Statut::all();
        return view('admin.Statut Management.list-statuts', compact('statuts'));
    }
    public function storeStatut(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
        ]);
        Statut::create(['nom' => $validatedData["nom"]]);
        return redirect()->route('list-statuts')->with("success", "Le statut a été ajouté avec succès");
    }
    public function editStatut($id)
    {
        $statut = Statut::where('id', $id)->first();
        return view('admin.Statut Management.edit-statut', compact('statut'));
    }
    public function updateStatut(Request $request, $id)
    {
        $statut = Statut::where('id', $id);
        $validatedData = $request->validate([
            'nom'=>'required|string'
        ]);
        $statut->update(['nom' => $validatedData['nom']]);
        return redirect()->route('list-statuts')->with("success", "Le statut a été modifié avec succès");
    }
    public function deleteStatut($id)
    {
        $statut = Statut::where('id', $id);
        $statut -> delete();
        return redirect()->back()->with("warning", "Le statut a été supprimé");
    }
    //!/* Priorite Management */
    public function listPriorites()
    {
        $priorites = Priorite::all();
        return view('admin.Priorite Management.list-priorites', compact('priorites'));
    }
    public function storePriorite(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
        ]);
        Priorite::create(['nom' => $validatedData["nom"]]);
        return redirect()->route('list-priorites')->with("success", "Le priorite a été ajouté avec succès");
    }
    public function editPriorite($id)
    {
        $priorite = Priorite::where('id', $id)->first();
        return view('admin.Priorite Management.edit-priorite', compact('priorite'));
    }
    public function updatePriorite(Request $request, $id)
    {
        $priorite = Priorite::where('id', $id);
        $validatedData = $request->validate([
            'nom'=>'required|string'
        ]);
        $priorite->update(['nom' => $validatedData['nom']]);
        return redirect()->route('list-priorites')->with("success", "Le priorite a été modifié avec succès");
    }
    public function deletePriorite($id)
    {
        $priorite = Priorite::where('id', $id);
        $priorite -> delete();
        return redirect()->back()->with("warning", "Le priorite a été supprimé");
    }
    //!/* Category Management */
    public function listCategories()
    {
        $categories = Categorie::all();
        return view('admin.Category Management.list-categories', compact('categories'));
    }
    public function storeCategorie(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
        ]);
        Categorie::create(['nom' => $validatedData["nom"]]);
        return redirect()->route('list-categories')->with("success", "Le categorie a été ajouté avec succès");
    }
    public function editCategorie($id)
    {
        $categorie = Categorie::where('id', $id)->first();
        return view('admin.Category Management.edit-categorie', compact('categorie'));
    }
    public function updateCategorie(Request $request, $id)
    {
        $categorie = Categorie::where('id', $id);
        $validatedData = $request->validate([
            'nom'=>'required|string'
        ]);
        $categorie->update(['nom' => $validatedData['nom']]);
        return redirect()->route('list-categories')->with("success", "Le categorie a été modifié avec succès");
    }
    public function deleteCategorie($id)
    {
        $categorie = Categorie::where('id', $id);
        $categorie -> delete();
        return redirect()->back()->with("warning", "Le categorie a été supprimé");
    }
    //!/* Ticket Management */
    public function listTickets()
    {
        $tickets = Ticket::paginate(5);
        return view('admin.Ticket Management.list-tickets', compact('tickets'));
    }
    public function showTicket($id)
    {
        $ticket = Ticket::where('id', $id)->first();
        $commentaires = Commentaire::where('ticket_id', $id)->get();
        return view('admin.Ticket Management.ticket', compact('ticket', 'commentaires'));
    }
    //!/* Comment Management */
    public function storeComment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'commentaire'=>'required|string',
        ]);
        Commentaire::create([
            'commentaire' => $validatedData["commentaire"],
            'user_id' => auth()->id(),
            'ticket_id' => $id
        ]);
        return back()->with('success', 'The comment has been added');
    }
    public function deleteComment($id)
    {
        $commentaire = Commentaire::where('id', $id)->first();
        $commentaire->delete();
        return back()->with('warning', 'The comment has been deleted');
    }
}
