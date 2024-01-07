<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoleUser>
 */
class RoleUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // Busca a primeira função criada (Administrador)
        $role = new Role();
        $roleAdmin = $role->first();

        // Busca o primeira usuário criado (Administrador)
        $user = new User();
        $userAdmin = $user->first();

        return [
            'uuid' => Uuid::uuid4()->toString(),
            'role_uuid' => $roleAdmin['uuid'],
            'user_uuid' => $userAdmin['uuid']
        ];
    }
}
