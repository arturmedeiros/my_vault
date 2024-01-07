<?php

namespace App\Observers;

use App\Models\RoleUser;
use Ramsey\Uuid\Uuid;

class RoleUsersUuidObserver
{
    public function creating(RoleUser $role_user): void
    {
        $role_user->uuid = Uuid::uuid4()->toString();
    }
}
