<?php

namespace App\Observers;

use App\Models\Password;
use Ramsey\Uuid\Uuid;

class PasswordUuidObserver
{
    public function creating(Password $password): void
    {
        $password->uuid = Uuid::uuid4()->toString();
    }
}
