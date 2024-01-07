<?php

namespace Database\Seeders;

use App\Helpers\HelperClass;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Cria Função de Administrador
         \App\Models\Role::factory(1)->create([
             'name' => 'Administrador',
             'description' => 'Garante acesso a todas as permissões do sistema.',
             'uuid' => Uuid::uuid4()->toString(),
             'permissions' => (new HelperClass())->setRolePermissions(true, true, true, true),
         ]);

         // Cria Super Usuário
         \App\Models\User::factory(1)->create();

         // Cria Premissões de Super Usuário
         \App\Models\RoleUser::factory(1)->create();

         // Cria Função de Usuário Padrão
         \App\Models\Role::factory(1)->create([
            'name' => 'Usuário',
            'description' => 'Garante apenas permissão de leitura das senhas.',
            'uuid' => Uuid::uuid4()->toString(),
            'permissions' => (new HelperClass())->setRolePermissions(true, false, false, false),
         ]);

         // Cria tipos de Cofres
         \App\Models\VaultType::factory(1)->create([
             'name' => 'Social Network',
             'description' => 'Social network accounts.',
             'uuid' => Uuid::uuid4()->toString(),
             'preferences' => [
                 'icon' => (new HelperClass())->setIcon('dataset_linked')
             ]
         ]);
         \App\Models\VaultType::factory(1)->create([
             'name' => 'E-mail',
             'description' => 'E-mails accounts.',
             'uuid' => Uuid::uuid4()->toString(),
             'preferences' => [
                 'icon' => (new HelperClass())->setIcon('email')
             ]
         ]);
         \App\Models\VaultType::factory(1)->create([
             'name' => 'Applications',
             'description' => 'My applications.',
             'uuid' => Uuid::uuid4()->toString(),
             'preferences' => [
                 'icon' => (new HelperClass())->setIcon('touch_app')
             ]
         ]);
         \App\Models\VaultType::factory(1)->create([
             'name' => 'Reserves',
             'description' => 'Booking apps.',
             'uuid' => Uuid::uuid4()->toString(),
             'preferences' => [
                 'icon' => (new HelperClass())->setIcon('room_service')
             ]
         ]);
         \App\Models\VaultType::factory(1)->create([
             'name' => 'Banking',
             'description' => 'Banking apps.',
             'uuid' => Uuid::uuid4()->toString(),
             'preferences' => [
                 'icon' => (new HelperClass())->setIcon('account_balance')
             ]
         ]);
         \App\Models\VaultType::factory(1)->create([
             'name' => 'General',
             'description' => 'General passwords.',
             'uuid' => Uuid::uuid4()->toString(),
             'preferences' => [
                 'icon' => (new HelperClass())->setIcon('lock')
             ]
         ]);

    }
}
