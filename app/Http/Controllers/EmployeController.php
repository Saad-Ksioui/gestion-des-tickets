<?php

namespace App\Http\Controllers;

use App\Models\Statut;
use App\Models\Ticket;
use App\Models\Priorite;
use App\Models\Categorie;
use App\Models\Notification;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function dashboard()
    {
        $tickets = Ticket::where('user_id', auth()->id())->get();
        $statuts = Statut::all();
        $notifications = Notification::where('user_id', auth()->id())->get();
        return view('employe.employe-dashboard', compact('tickets', 'statuts', 'notifications'));
    }
    public function listTickets()
    {
        $tickets = Ticket::where('user_id', auth()->id())->paginate(5);
        $statuts = Statut::all();
        $priorites = Priorite::all();
        $categories = Categorie::all();
        return view('employe.Ticket Management.list-tickets', compact('tickets', 'statuts', 'priorites', 'categories'));
    }
    public function storeTicket(Request $request)
    {
        $validatedData = $request->validate([
            'sujet'=>'required|string',
            'description'=>'required|string',
            'priorite_id'=>'required|string',
            'categorie_id'=>'required|string',
        ]);
        Ticket::create([
            'sujet' => $validatedData["sujet"],
            'description' => $validatedData["description"],
            'user_id' => auth()->id(),
            'priorite_id' => $validatedData["priorite_id"],
            'statut_id' => 1,
            'categorie_id' => $validatedData["categorie_id"],
        ]);
        return redirect()->route('employe-list-tickets')->with("success", "Le ticket a été ajouté avec succès");
    }
}
