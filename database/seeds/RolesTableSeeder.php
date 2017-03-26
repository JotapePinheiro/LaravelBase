<?php

use App\Domains\Users\User;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    /**
	     * Add Roles
	     *
	     */
        if (Role::where('slug', '=', 'admin')->first() === null) {
            $adminRole = Role::create([
                'name' => 'Administrador',
                'slug' => 'admin',
                'description' => 'Função de Administrador',
                'level' => 5,
            ]);
        }

    	if (Role::where('slug', '=', 'moderador')->first() === null) {
	        $moderadorRole = Role::create([
	            'name' => 'Moderador',
	            'slug' => 'moderador',
	            'description' => 'Função de Moderador',
	            'level' => 4,
        	]);
	    }

    	if (Role::where('slug', '=', 'empresa')->first() === null) {
	        $empresaRole = Role::create([
	            'name' => 'Empresa',
	            'slug' => 'empresa',
	            'description' => 'Função de Empresa',
	            'level' => 3,
	        ]);
	    }

        if (Role::where('slug', '=', 'motorista')->first() === null) {
            $motoristaRole = Role::create([
                'name' => 'Motorista',
                'slug' => 'motorista',
                'description' => 'Função de Motorista',
                'level' => 2,
            ]);
        }

        if (Role::where('slug', '=', 'usuario')->first() === null) {
            $userRole = Role::create([
                'name' => 'Usuário',
                'slug' => 'usuario',
                'description' => 'Função de Usuário',
                'level' => 1,
            ]);
        }

    	if (Role::where('slug', '=', 'unverified')->first() === null) {
	        $userRole = Role::create([
	            'name' => 'Não Verificado',
	            'slug' => 'unverified',
	            'description' => 'Função de Usuário não Verificado',
	            'level' => 0,
	        ]);
	    }

    }

}