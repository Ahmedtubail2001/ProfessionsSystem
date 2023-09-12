<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use App\Models\specialties;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecialityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $user)
    {
        return $user->hasPermissionTo('Index-Speciality') ? $this->allow() : $this->deny('Cannot be access to view Any Speciality');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\specialties  $specialties
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $user, specialties $specialties)
    {
        // return $user->hasPermissionTo('Show-Speciality') ? $this->allow() : $this->deny('Cannot be access to create Speciality');

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $user)
    {
        return $user->hasPermissionTo('Create-Speciality') ? $this->allow() : $this->deny('Cannot be access to create Speciality');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\specialties  $specialties
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $user, specialties $specialties)
    {
        //
        return $user->hasPermissionTo('Edit-Speciality') ? $this->allow() : $this->deny('Cannot be access to create Speciality');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\specialties  $specialties
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $user, specialties $specialties)
    {
        return $user->hasPermissionTo('Delete-Speciality') ? $this->allow() : $this->deny('Cannot be access to Delete Speciality');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\specialties  $specialties
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $user, specialties $specialties)
    {
        return $user->hasPermissionTo('Restore-Speciality') ? $this->allow() : $this->deny('Cannot be access to Restore Speciality');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\specialties  $specialties
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $user, specialties $specialties)
    {
        //
    }
}
