<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Contracts\Role;

class RolePolicy
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
        return $user->hasPermissionTo('Index_Roles') ? $this->allow() : $this->deny('Cannot be access to view Any Roles');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $Role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $user, Role $Role)
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
        return $user->hasPermissionTo('Create_Roles') ? $this->allow() : $this->deny('Cannot be access to create Roles');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $Role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $user, Role $Role)
    {
        //
        return $user->hasPermissionTo('Update_Roles') ? $this->allow() : $this->deny('Cannot be access to Edit Roles');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $Role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $user, Role $Role)
    {
        return $user->hasPermissionTo('Delete_Roles') ? $this->allow() : $this->deny('Cannot be access to Delete Roles');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $Role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $user, Role $Role)
    {
        // return $user->hasPermissionTo('Restore-Speciality') ? $this->allow() : $this->deny('Cannot be access to Restore Speciality');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $Role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $user, Role $Role)
    {
        //
    }
}
