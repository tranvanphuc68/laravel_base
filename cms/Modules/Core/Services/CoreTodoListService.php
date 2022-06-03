<?php

namespace Cms\Modules\Core\Services;

use Cms\Modules\Core\Services\Contracts\CoreTodoListServiceContract;
use Cms\Modules\Core\Repositories\Contracts\CoreTodoListRepositoryContract;

class CoreTodoListService implements CoreTodoListServiceContract
{
	protected $repository;

	function __construct(CoreTodoListRepositoryContract $repository)
	{
	    $this->repository = $repository;
	}
}

