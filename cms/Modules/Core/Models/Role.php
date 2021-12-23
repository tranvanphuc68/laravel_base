<?php

namespace Cms\Modules\Core\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $guard_name = 'web';

    protected $table = 'roles';

    protected $fillable = ['name', 'guard_name', 'created_at', 'updated_at'];

    protected $hidden = [];
}
