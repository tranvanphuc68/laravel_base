<?php

namespace Cms\Modules\Auth\Services;

use Cms\Modules\Auth\Services\Contracts\AuthUserServiceContract;
use Cms\Modules\Auth\Repositories\Contracts\AuthUserRepositoryContract;
use Cms\Modules\Core\Services\CoreUserService;

class AuthUserService extends CoreUserService implements AuthUserServiceContract
{
	protected $repository;

	function __construct(AuthUserRepositoryContract $repository)
	{
	    parent::__construct($repository);

	    $this->repository = $repository;
	}
}
