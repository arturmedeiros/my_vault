<?php

namespace App\Observers;

use App\Models\Role;
use Ramsey\Uuid\Uuid;

class RoleUuidObserver
{
    public function creating(Role $role): void
    {
        $role->uuid = Uuid::uuid4()->toString();
    }
}
