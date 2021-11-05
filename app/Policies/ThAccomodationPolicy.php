<?php

namespace App\Policies;

use App\ThAccomodation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThAccomodationPolicy
{
    use HandlesAuthorization;


    public static $role_allowed = [
        1, // Admin
        5  // Accomodation User
    ];

    /**
     * Determine whether the user can view any th accomodations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $checkRole = $user->roles->whereIn("id", self::$role_allowed);
        if (count($checkRole) < 1) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can view the th accomodation.
     *
     * @param  \App\User  $user
     * @param  \App\ThAccomodation  $thAccomodation
     * @return mixed
     */
    public function view(User $user, ThAccomodation $thAccomodation)
    {
        $checkRole = $user->roles->whereIn("id", self::$role_allowed);
        if (count($checkRole) < 1) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can create th accomodations.
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
     * Determine whether the user can update the th accomodation.
     *
     * @param  \App\User  $user
     * @param  \App\ThAccomodation  $thAccomodation
     * @return mixed
     */
    public function update(User $user, ThAccomodation $thAccomodation)
    {
        $checkRole = $user->roles->whereIn("id", self::$role_allowed);
        if (count($checkRole) < 1) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the th accomodation.
     *
     * @param  \App\User  $user
     * @param  \App\ThAccomodation  $thAccomodation
     * @return mixed
     */
    public function delete(User $user, ThAccomodation $thAccomodation)
    {
        $checkRole = $user->roles->whereIn("id", self::$role_allowed);
        if (count($checkRole) < 1) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can restore the th accomodation.
     *
     * @param  \App\User  $user
     * @param  \App\ThAccomodation  $thAccomodation
     * @return mixed
     */
    public function restore(User $user, ThAccomodation $thAccomodation)
    {
        $checkRole = $user->roles->firstWhere("id", self::$role_allowed[0]);
        if (!$checkRole) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can permanently delete the th accomodation.
     *
     * @param  \App\User  $user
     * @param  \App\ThAccomodation  $thAccomodation
     * @return mixed
     */
    public function forceDelete(User $user, ThAccomodation $thAccomodation)
    {
        $checkRole = $user->roles->firstWhere("id", self::$role_allowed[0]);
        if (!$checkRole) {
            return false;
        }

        return true;
    }
}
