<?php

namespace Cms\Modules\Core\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $guard_name = 'web';
}
