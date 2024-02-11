<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    // public function boot(): void
    // {
    //     //
    // }
    public function boot()
{
 $this->registerPolicies();
//  Permission::create(['name' => 'gestion des soldes']);
//  Permission::create(['name' => 'edition des statistiques']);
//  Permission::create(['name' => 'gérer l état d une commande']);
//  Permission::create(['name' => 'Gestion des produits']);
//  Permission::create(['name' => 'Gestion des catégories']);
//  Permission::create(['name' => 'Gestion des fournisseurs']);
//  Permission::create(['name' => 'Gestion des utilisateurs']);
//  Permission::create(['name' => 'Gestion des roles']);
//  Role::create(['name' => 'Commercial'])
//  ->givePermissionTo(['gestion des soldes', 'edition des statistiques', 'gérer l état d une commande']);

//  Role::create(['name' => 'Magasinier'])
//  ->givePermissionTo(['Gestion des produits', 'Gestion des catégories', 'Gestion des fournisseurs']);

//  Role::create(['name' => 'Admin'])
//  ->givePermissionTo(['Gestion des utilisateurs', 'Gestion des roles']);

}
}
