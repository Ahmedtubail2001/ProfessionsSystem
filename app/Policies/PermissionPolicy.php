<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Contracts\Permission;

class PermissionPolicy
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
        return $user->hasPermissionTo('Index_Permissions') ? $this->allow() : $this->deny('Cannot be access to view Any Permissions');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $Permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $user, Permission $Permission)
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
        return $user->hasPermissionTo('Create_Permissions') ? $this->allow() : $this->deny('Cannot be access to create Permissions');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $Permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $user, Permission $Permission)
    {
        //
        return $user->hasPermissionTo('Update_Permissions') ? $this->allow() : $this->deny('Cannot be access to Edit Permissions');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $Permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $user, Permission $Permission)
    {
        return $user->hasPermissionTo('Delete_Permissions') ? $this->allow() : $this->deny('Cannot be access to Delete Permissions');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $Permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $user, Permission $Permission)
    {
        // return $user->hasPermissionTo('Restore-Speciality') ? $this->allow() : $this->deny('Cannot be access to Restore Speciality');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permission  $Permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $user, Permission $Permission)
    {
        //
    }
}
