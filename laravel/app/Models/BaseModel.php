<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;

class BaseModel extends Model
{
    use GeneratesUuid;

    protected $casts = ['uuid' => 'uuid'];
    protected $uuidVersion = 'ordered';
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
