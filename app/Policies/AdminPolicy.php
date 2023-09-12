<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $user)
    {
        return $user->hasPermissionTo('Index_Admin') ? $this->allow() : $this->deny('Cannot be access to view Any Admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $Admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $user, Admin $admin)
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
        return $user->hasPermissionTo('Create_Admin') ? $this->allow() : $this->deny('Cannot be access to create Admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $Admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $user, Admin $admin)
    {
        //
        return $user->hasPermissionTo('Update_Admin') ? $this->allow() : $this->deny('Cannot be access to Edit Admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $Admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $user, Admin $admin)
    {
        return $user->hasPermissionTo('Delete_Admin') ? $this->allow() : $this->deny('Cannot be access to Delete Admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $Admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $user, Admin $admin)
    {
        // return $user->hasPermissionTo('Restore-Speciality') ? $this->allow() : $this->deny('Cannot be access to Restore Speciality');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $Admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $user, Admin $admin)
    {
        //
    }
}
