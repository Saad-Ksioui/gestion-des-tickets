<?php

namespace App\Models;

use App\Models\User;
use App\Models\Statut;
use App\Models\Priorite;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'sujet',
        'description',
        'user_id',
        'priorite_id',
        'statut_id',
        'categorie_id',
        'assigned_to',
    ];

    /* Les Relations */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function priorite()
    {
        return $this->belongsTo(Priorite::class);
    }

    public function statut()
    {
        return $this->belongsTo(Statut::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /* Les Méthodes */

    public function getUser()
    {
        return User::find($this->user_id)->nom_complet;
    }
    public function getAssignedTo()
    {
        $user = User::find($this->assigned_to);
        if ($user != null) {
            return $user->nom_complet;
        }
    }
    public function getUserEmail()
    {
        return User::find($this->user_id)->email;
    }
    public function getPriorite()
    {
        return Priorite::find($this->priorite_id)->nom;
    }
    public function getStatut()
    {
        return Statut::find($this->statut_id)->nom;
    }
    public function getCategorie()
    {
        return Categorie::find($this->categorie_id)->nom;
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
