<?php

namespace App\Policies;

use App\ThPayment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThPaymentPolicy
{
    use HandlesAuthorization;

    public static $role_allowed = [
        1, // Admin
        4  // Accomodation User
    ];

    /**
     * Determine whether the user can view any th payments.
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
     * Determine whether the user can view the th payment.
     *
     * @param  \App\User  $user
     * @param  \App\ThPayment  $thPayment
     * @return mixed
     */
    public function view(User $user, ThPayment $thPayment)
    {
        return true;
    }

    /**
     * Determine whether the user can create th payments.
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
     * Determine whether the user can update the th payment.
     *
     * @param  \App\User  $user
     * @param  \App\ThPayment  $thPayment
     * @return mixed
     */
    public function update(User $user, ThPayment $thPayment)
    {
        $checkRole = $user->roles->whereIn("id", self::$role_allowed);
        if (count($checkRole) < 1) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the th payment.
     *
     * @param  \App\User  $user
     * @param  \App\ThPayment  $thPayment
     * @return mixed
     */
    public function delete(User $user, ThPayment $thPayment)
    {
        $checkRole = $user->roles->firstWhere("id", 1);
        if (!$checkRole) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can restore the th payment.
     *
     * @param  \App\User  $user
     * @param  \App\ThPayment  $thPayment
     * @return mixed
     */
    public function restore(User $user, ThPayment $thPayment)
    {
        $checkRole = $user->roles->firstWhere("id", 1);
        if (!$checkRole) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can permanently delete the th payment.
     *
     * @param  \App\User  $user
     * @param  \App\ThPayment  $thPayment
     * @return mixed
     */
    public function forceDelete(User $user, ThPayment $thPayment)
    {
        $checkRole = $user->roles->firstWhere("id", 1);
        if (!$checkRole) {
            return false;
        }

        return true;
    }
}
