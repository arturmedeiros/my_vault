<?php

namespace App\Services;

class RoleService
{
    public function rolesFormatted($UserRoles): array
    {
        $rolesFormatted = [];
        foreach ($UserRoles as $role) {
            $role['permissions'] = json_decode($role['permissions']);
            $rolesFormatted[] = $role;
        }

        return $rolesFormatted;
    }
}
