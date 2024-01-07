<?php

namespace App\Observers;

use App\Models\VaultType;
use Ramsey\Uuid\Uuid;

class VaultTypeUuidObserver
{
    public function creating(VaultType $type): void
    {
        $type->uuid = Uuid::uuid4()->toString();
    }
}
