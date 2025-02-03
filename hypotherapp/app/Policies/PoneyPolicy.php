<?php

namespace App\Policies;

use App\Models\Poney;
use App\Models\User;

class PoneyPolicy
{
    /**
     * Détermine si l'utilisateur peut voir tous les poneys.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Détermine si l'utilisateur peut voir un poney spécifique.
     */
    public function view(User $user, Poney $poney): bool
    {
        return false;
    }

    /**
     * Détermine si l'utilisateur peut créer un poney.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Détermine si l'utilisateur peut modifier un poney.
     */
    public function update(User $user, Poney $poney): bool
    {
        return false;
    }

    /**
     * Détermine si l'utilisateur peut supprimer un poney.
     */
    public function delete(User $user, Poney $poney): bool
    {
        return $user->role === 'admin'; // Seul un administrateur peut supprimer un poney
    }

    /**
     * Détermine si l'utilisateur peut restaurer un poney.
     */
    public function restore(User $user, Poney $poney): bool
    {
        return false;
    }

    /**
     * Détermine si l'utilisateur peut supprimer définitivement un poney.
     */
    public function forceDelete(User $user, Poney $poney): bool
    {
        return false;
    }
}
