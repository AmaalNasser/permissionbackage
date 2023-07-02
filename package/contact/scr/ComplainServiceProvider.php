<?php

namespace amaal\complain;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class ComplainServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'contact');

        // Define a role
        $role = Role::create(['name' => 'Super Admin']);

        // Assign permissions to a role
        $permissions = [
            'Roles View Any',
            'Roles View',
            'Roles Edit',
            'Roles Delete',
            'Roles Create',
        ];
        $role->syncPermissions($permissions);

        // Check if a user has certain permissions
        $user = User::find(1);

        $requiredPermissions = ['Roles View', 'Roles Edit'];

        if ($user->hasAnyPermission($requiredPermissions)) {
            $user->update(['name' => 'Amaal']);
            echo "User's name has been updated.";
        } else {
            echo "You do not have permission to perform the required actions.";
        }
    }

    public function register()
    {
    }
}
