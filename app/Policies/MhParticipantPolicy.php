<?php

namespace App\Policies;

use App\MhParticipant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MhParticipantPolicy
{
    use HandlesAuthorization;

    public static $role_allowed = [
        1, // Admin
        3  // Registration
    ];
    /**
     * Determine whether the user can view any mh participants.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the mh participant.
     *
     * @param  \App\User  $user
     * @param  \App\MhParticipant  $mhParticipant
     * @return mixed
     */
    public function view(User $user, MhParticipant $mhParticipant)
    {
        return true;
    }

    /**
     * Determine whether the user can create mh participants.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $checkRole = $user->roles->whereIn("id", self::$role_allowed);
        if (count($checkRole) < 1) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can update the mh participant.
     *
     * @param  \App\User  $user
     * @param  \App\MhParticipant  $mhParticipant
     * @return mixed
     */
    public function update(User $user, MhParticipant $mhParticipant)
    {
        $checkRole = $user->roles->whereIn("id", self::$role_allowed);
        if ($checkRole->count() < 1) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the mh participant.
     *
     * @param  \App\User  $user
     * @param  \App\MhParticipant  $mhParticipant
     * @return mixed
     */
    public function delete(User $user, MhParticipant $mhParticipant)
    {
        $checkRole = $user->roles->firstWhere("id", 1);
        if (!$checkRole) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can restore the mh participant.
     *
     * @param  \App\User  $user
     * @param  \App\MhParticipant  $mhParticipant
     * @return mixed
     */
    public function restore(User $user, MhParticipant $mhParticipant)
    {
        $checkRole = $user->roles->firstWhere("id", 1);
        if (!$checkRole) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can permanently delete the mh participant.
     *
     * @param  \App\User  $user
     * @param  \App\MhParticipant  $mhParticipant
     * @return mixed
     */
    public function forceDelete(User $user, MhParticipant $mhParticipant)
    {
        return false;
    }
}
