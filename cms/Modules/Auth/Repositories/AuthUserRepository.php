<?php

namespace Cms\Modules\Auth\Repositories;

use Cms\Modules\Auth\Repositories\Contracts\AuthUserRepositoryContract;
use Cms\Modules\Core\Repositories\CoreUserRepository;

class AuthUserRepository extends CoreUserRepository implements AuthUserRepositoryContract
{

}
