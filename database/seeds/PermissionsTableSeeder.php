<?php

use App\Domains\Users\User;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    /**
	     * Add Permissions
	     *
	     */
        if (Permission::where('slug', '=', 'view.users')->first() === null) {
			Permission::create([
			    'name' => 'Visualizar Usuários',
			    'slug' => 'view.users',
			    'description' => 'Pode visualizar usuários',
			    'model' => 'Permission',
			]);
        }

        if (Permission::where('slug', '=', 'create.users')->first() === null) {
			Permission::create([
			    'name' => 'Criar Usuários',
			    'slug' => 'create.users',
			    'description' => 'Pode criar novos usuários',
			    'model' => 'Permission',
			]);
        }

        if (Permission::where('slug', '=', 'edit.users')->first() === null) {
			Permission::create([
			    'name' => 'Editar Usuários',
			    'slug' => 'edit.users',
			    'description' => 'Pode editar usuários',
			    'model' => 'Permission',
			]);
        }

        if (Permission::where('slug', '=', 'delete.users')->first() === null) {
			Permission::create([
			    'name' => 'Deletar Usuários',
			    'slug' => 'delete.users',
			    'description' => 'Pode deletar usuários',
			    'model' => 'Permission',
			]);
        }

    }
}
