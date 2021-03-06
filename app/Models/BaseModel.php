<?php

namespace App\Models;

use App\Models\Traits\Initializable;
use App\Models\Traits\Uuidable;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use Uuidable;
    use Initializable;
}
