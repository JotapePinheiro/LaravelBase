<?php

use App\Domains\Users\Profile;
use App\Domains\Users\Theme;
use App\Domains\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        $adminRole = Role::whereSlug('admin')->first();
        $moderadorRole = Role::whereSlug('moderador')->first();

        $empresaRole = Role::whereSlug('empresa')->first();
        $motoristaRole = Role::whereSlug('motorista')->first();
        $usuarioRole = Role::whereSlug('usuario')->first();

        // Seed test admin
        $user = User::where('email', '=', 'admin@admin.com')->first();
        if ($user === null) {
            $user = User::create(array(
                'name'              => $faker->userName,
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'email'             => 'admin@admin.com',
                'password'          => Hash::make('password'),
                'token'             => str_random(64),
                'activated'         => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'  => $faker->ipv4
            ));

            $user->profile()->save(new Profile);
            $user->attachRole($adminRole);
            $user->save();
        }

        // Seed test moderador
        $user = User::where('email', '=', 'moderador@moderador.com')->first();
        if ($user === null) {
            $user = User::create(array(
                'name'              => $faker->userName,
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'email'             => 'moderador@moderador.com',
                'password'          => Hash::make('password'),
                'token'             => str_random(64),
                'activated'         => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'  => $faker->ipv4
            ));

            $user->profile()->save(new Profile);
            $user->attachRole($moderadorRole);
            $user->save();
        }

        // Seed test empresa
        $user = User::where('email', '=', 'empresa@empresa.com')->first();
        if ($user === null) {
            $user = User::create(array(
                'name'              => $faker->userName,
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'email'             => 'empresa@empresa.com',
                'password'          => Hash::make('password'),
                'token'             => str_random(64),
                'activated'         => true,
                'signup_ip_address' => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4
            ));

            $user->profile()->save(new Profile);
            $user->attachRole($empresaRole);
            $user->save();
        }

        // Seed test motorista
        $user = User::where('email', '=', 'motorista@motorista.com')->first();
        if ($user === null) {
            $user = User::create(array(
                'name'              => $faker->userName,
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'email'             => 'motorista@motorista.com',
                'password'          => Hash::make('password'),
                'token'             => str_random(64),
                'activated'         => true,
                'signup_ip_address' => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4
            ));

            $user->profile()->save(new Profile);
            $user->attachRole($motoristaRole);
            $user->save();
        }

        // Seed test usuario
        $user = User::where('email', '=', 'usuario@usuario.com')->first();
        if ($user === null) {
            $user = User::create(array(
                'name'              => $faker->userName,
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'email'             => 'usuario@usuario.com',
                'password'          => Hash::make('password'),
                'token'             => str_random(64),
                'activated'         => true,
                'signup_ip_address' => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4
            ));

            $user->profile()->save(new Profile);
            $user->attachRole($usuarioRole);
            $user->save();
        }

        // Seed test users
        // $user = factory(App\Domains\Users\Profile::class, 5)->create();
        // $users = User::All();
        // foreach ($users as $user) {
        //     if (!($user->isAdmin()) && !($user->isUnverified())) {
        //         $user->attachRole($userRole);
        //     }
        // }

    }
}
