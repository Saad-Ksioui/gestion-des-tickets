<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Statut;
use App\Models\Ticket;
use App\Models\Priorite;
use App\Models\Categorie;
use App\Models\Commentaire;
use App\Models\Notification;
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
            'nom' => 'required|string'
        ]);
        $statut->update(['nom' => $validatedData['nom']]);
        return redirect()->route('list-statuts')->with("success", "Le statut a été modifié avec succès");
    }
    public function deleteStatut($id)
    {
        $statut = Statut::where('id', $id);
        $statut->delete();
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
            'nom' => 'required|string'
        ]);
        $priorite->update(['nom' => $validatedData['nom']]);
        return redirect()->route('list-priorites')->with("success", "Le priorite a été modifié avec succès");
    }
    public function deletePriorite($id)
    {
        $priorite = Priorite::where('id', $id);
        $priorite->delete();
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
            'nom' => 'required|string'
        ]);
        $categorie->update(['nom' => $validatedData['nom']]);
        return redirect()->route('list-categories')->with("success", "Le categorie a été modifié avec succès");
    }
    public function deleteCategorie($id)
    {
        $categorie = Categorie::where('id', $id);
        $categorie->delete();
        return redirect()->back()->with("warning", "Le categorie a été supprimé");
    }
    //!/* Ticket Management */
    public function listTickets()
    {
        $tickets = Ticket::paginate(5);
        return view('admin.Ticket Management.list-all-tickets', compact('tickets'));
    }
    public function showTicket($id)
    {
        $ticket = Ticket::where('id', $id)->first();
        $commentaires = Commentaire::where('ticket_id', $id)->get();
        return view('admin.Ticket Management.ticket', compact('ticket', 'commentaires'));
    }
    public function editTicket($id)
    {
        $ticket = Ticket::where('id', $id)->first();
        $statuts = Statut::all();
        $priorites = Priorite::all();
        $categories = Categorie::all();
        $users = User::where('role_id', 2)->get();
        return view('admin.Ticket Management.edit-ticket', compact('ticket', 'statuts', 'priorites', 'categories', 'users'));
    }

    public function updateTicket(Request $request, $id)
    {
        // Retrieve the ticket instance
        $ticket = Ticket::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'sujet' => 'required|string',
            'description' => 'required|string',
            'priorite_id' => 'required',
            'statut_id' => 'required',
            'categorie_id' => 'required',
            'assigned_to' => 'nullable',
        ]);

        // Get the original value of assigned_to
        $originalAssignedTo = $ticket->getOriginal('assigned_to');

        if ($request->has('assigned_to') && $request->assigned_to != $originalAssignedTo) {

            $notification = new Notification();
            $notification->user_id = $ticket->user_id;
            $notification->message = 'Votre ticket a été attribué à ';
            $notification->type = 'ticket_attribué';
            $notification->save();
        }

        $ticket->update($validatedData);

        return redirect()->route('list-tickets')->with("success", "Le ticket a été modifié avec succès");
    }


    //!/* Comment Management */
    public function storeComment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'commentaire' => 'required|string',
        ]);
        Commentaire::create([
            'commentaire' => $validatedData["commentaire"],
            'user_id' => auth()->id(),
            'ticket_id' => $id
        ]);
        return back()->with('success', 'Le commentaire a été ajouté');
    }
    public function deleteComment($id)
    {
        $commentaire = Commentaire::where('id', $id)->first();
        $commentaire->delete();
        return back()->with('warning', 'Le commentaire a été supprimé');
    }
}
