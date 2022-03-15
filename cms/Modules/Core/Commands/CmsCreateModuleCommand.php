<?php

namespace Cms\Modules\Core\Commands;

use Illuminate\Console\Command;

class CmsCreateModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:create {module} {--service=} {--repository=} {--controller=} {--model=} {--middleware=} {--request=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CMS Create Module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->argument('module')) {
            $module = ucfirst($this->argument('module'));
            $moduleDir = 'cms/Modules/' . $module;
            $moduleProviderFile = $moduleDir . '/' . $module . 'ServiceProvider.php';
            $modulePHPUnitFile = $moduleDir . '/' . 'phpunit.xml';
            $serviceDir = $moduleDir . '/Services';
            $serviceContractDir = $serviceDir . '/Contracts';
            $repositoryDir = $moduleDir . '/Repositories';
            $repositoryContractDir = $repositoryDir . '/Contracts';
            $controllerDir = $moduleDir . '/Controllers';
            $middlewareDir = $moduleDir . '/Middlewares';
            $requestDir = $moduleDir . '/Requests';
            $testDir = $moduleDir . '/Tests';
            $unitTestDir = $testDir . '/Unit';
            $featureTestDir = $testDir . '/Feature';
            $moduleTestCaseFile = $testDir . '/' . $module . 'TestCase.php';
            $makingFolders = array();
            $folders = [
                $moduleDir,
                $serviceContractDir,
                $repositoryContractDir,
                $controllerDir,
                $middlewareDir,
                $requestDir,
                $testDir,
                $unitTestDir,
                $featureTestDir,
            ];

            foreach ($folders as $folder) {
                if (!is_dir($folder)) $makingFolders[] = $folder;
            }

            if (count($makingFolders) > 0) {
                $this->makeMultiFolder($makingFolders);

                $this->info($module . ' directory has been created');
            }

            // Create service provider if not exists
            if (!file_exists($moduleProviderFile)) {
                $serviceProviderFile = fopen($moduleProviderFile, "w") or die("Unable to open file!");
                fwrite($serviceProviderFile, $this->templateServiceProvider($module));
                fclose($serviceProviderFile);
            }

            // Create php unit if not exists
            if (!file_exists($modulePHPUnitFile)) {
                $phpUnitFile = fopen($modulePHPUnitFile, "w") or die("Unable to open file!");
                fwrite($phpUnitFile, $this->templatePHPUnit());
                fclose($phpUnitFile);
            }

            // Create model if not exists
            if ($this->option('model')) {
                $model = ucfirst($this->option('model'));
                $modelFileName = 'cms/Modules/Core/Models/' . $model . '.php';

                if (!file_exists($modelFileName)) {
                    $modelFile = fopen($modelFileName, "w") or die("Unable to open file!");
                    fwrite($modelFile, $this->templateModel($model));
                    fclose($modelFile);

                    $this->info($model . 'Model has been created');
                } else
                    $this->error('Model already exists');
            }

            // Create controller if not exists
            if ($this->option('controller')) {
                $controller = ucfirst($this->option('controller'));
                $controllerFileName = $controllerDir . '/' . $controller . 'Controller.php';

                if (!file_exists($controllerFileName)) {
                    $controllerFile = fopen($controllerFileName, "w") or die("Unable to open file!");
                    fwrite($controllerFile, $this->templateController($module, $controller));
                    fclose($controllerFile);

                    $this->info($controller . 'Controller has been created');
                } else
                    $this->error('Controller already exists');
            }

            // Create middleware if not exists
            if ($this->option('middleware')) {
                $middleware = ucfirst($this->option('middleware'));
                $middlewareFileName = $middlewareDir . '/' . $middleware . 'Middleware.php';

                if (!file_exists($middlewareFileName)) {
                    $middlewareFile = fopen($middlewareFileName, "w") or die("Unable to open file!");
                    fwrite($middlewareFile, $this->templateMiddleware($module, $middleware));
                    fclose($middlewareFile);

                    $this->info($middleware . 'Middleware has been created');
                } else
                    $this->error('Middleware already exists');
            }

            // Create request if not exists
            if ($this->option('request')) {
                $request = ucfirst($this->option('request'));
                $requestFileName = $requestDir . '/' . $request . 'Request.php';

                if (!file_exists($requestFileName)) {
                    $requestFile = fopen($requestFileName, "w") or die("Unable to open file!");
                    fwrite($requestFile, $this->templateRequest($module, $request));
                    fclose($requestFile);

                    $this->info($request . 'Request has been created');
                } else
                    $this->error('Request already exists');
            }

            // Create service folders and files
            if ($this->option('service')) {
                $service = ucfirst($this->option('service'));
                $fileServiceContractName = $serviceContractDir . '/' . $module . $service . 'ServiceContract.php';
                $fileServiceName = $serviceDir . '/' . $module . $service . 'Service.php';
                $coreFileServiceContractName = 'cms/Modules/Core/Services/Contracts/Core' . $service . 'ServiceContract.php';
                $coreFileServiceName = 'cms/Modules/Core/Services/Core' . $service . 'Service.php';

                // Create service and service contract files
                if (!file_exists($fileServiceContractName) && !file_exists($fileServiceName)) {
                    // Create service contract file
                    $serviceContractFile = fopen($fileServiceContractName, "w") or die("Unable to open file!");
                    fwrite($serviceContractFile, $this->templateServiceContract($service, $module));
                    fclose($serviceContractFile);

                    // Create service file
                    $serviceFile = fopen($fileServiceName, "w") or die("Unable to open file!");
                    fwrite($serviceFile, $this->templateService($service, $module));
                    fclose($serviceFile);

                    $this->info($service . 'Service and ' . $service . 'ServiceContract have been created');
                } else {
                    $this->error('File service or service contract already exists');
                }

                // Create Core service file if not exist

                if (!file_exists($coreFileServiceContractName) && !file_exists($coreFileServiceName)) {

                    // Create core service contract file
                    $coreServiceContractFile = fopen($coreFileServiceContractName, "w") or die("Unable to open file!");
                    fwrite($coreServiceContractFile, $this->templateCoreServiceContract($service));
                    fclose($coreServiceContractFile);

                    // Create core service file
                    $coreServiceFile = fopen($coreFileServiceName, "w") or die("Unable to open file!");
                    fwrite($coreServiceFile, $this->templateCoreService($service));
                    fclose($coreServiceFile);

                    $this->info('Core' . $service . 'Service and Core' . $service . 'ServiceContract have been created');
                }
            }

            // Create test case if not exist
            if (!file_exists($moduleTestCaseFile)) {
                $testCaseFile = fopen($moduleTestCaseFile, "w") or die("Unable to open file!");
                fwrite($testCaseFile, $this->templateTestCase($module));
                fclose($testCaseFile);
            }

            // Create repository folders and files
            if ($this->option('repository')) {
                $repository = ucfirst($this->option('repository'));
                $fileRepositoryContractName = $repositoryContractDir . '/' . $module . $repository . 'RepositoryContract.php';
                $fileRepositoryName = $repositoryDir . '/' . $module . $repository . 'Repository.php';
                $coreFileRepositoryContractName = 'cms/Modules/Core/Repositories/Contracts/Core' . $repository . 'RepositoryContract.php';
                $coreFileRepositoryName = 'cms/Modules/Core/Repositories/Core' . $repository . 'Repository.php';

                // Create repository and repository contract files
                if (file_exists($fileRepositoryContractName) || file_exists($fileRepositoryName)) {
                    $this->error('File service or service contract already exists');
                } else {
                    // Create service contract file
                    $repositoryContractFile = fopen($fileRepositoryContractName, "w") or die("Unable to open file!");
                    fwrite($repositoryContractFile, $this->templateRepositoryContract($repository, $module));
                    fclose($repositoryContractFile);

                    // Create service file
                    $repositoryFile = fopen($fileRepositoryName, "w") or die("Unable to open file!");
                    fwrite($repositoryFile, $this->templateRepository($repository, $module));
                    fclose($repositoryFile);

                    $this->info($repository . 'Repository and ' . $repository . 'RepositoryContract have been created');
                }

                // Create Core repository file if not exist
                if (!file_exists($coreFileRepositoryContractName) && !file_exists($coreFileRepositoryName)) {

                    // Create core service contract file
                    $coreRepositoryContractFile = fopen($coreFileRepositoryContractName, "w") or die("Unable to open file!");
                    fwrite($coreRepositoryContractFile, $this->templateCoreRepositoryContract($repository));
                    fclose($coreRepositoryContractFile);

                    // Create core service file
                    $coreRepositoryFile = fopen($coreFileRepositoryName, "w") or die("Unable to open file!");
                    fwrite($coreRepositoryFile, $this->templateCoreRepository($repository));
                    fclose($coreRepositoryFile);

                    $this->info('Core' . $repository . 'Repository and Core' . $repository . 'RepositoryContract have been created');
                }
            }
        }
    }

    public function makeMultiFolder(array $directories, $mode = null, $recursive = null): bool
    {
        foreach ($directories as $directory) {
            mkdir($directory, $mode == null ? 0777 : $mode, $recursive == null ? true : $mode);
        }

        return true;
    }

    public function templateServiceProvider($module): string
    {
        return '<?php

namespace Cms\Modules\\' . $module . ';

use Cms\CmsServiceProvider;
use Illuminate\Routing\Router;

class ' . $module . 'ServiceProvider extends CmsServiceProvider
{
    public function boot(Router $router)
    {
        parent::boot($router);
    }

	public function register()
	{
	    // Register services and repositories here...
	}
}

';
    }

    public function templateServiceContract($service, $module): string
    {
        return '<?php

namespace Cms\Modules\\' . $module . '\Services\Contracts;

use Cms\Modules\Core\Services\Contracts\Core' . $service . 'ServiceContract;

interface ' . $module . $service . 'ServiceContract extends Core' . $service . 'ServiceContract
{

}';
    }

    public function templateCoreServiceContract($module): string
    {
        return '<?php

namespace Cms\Modules\Core\Services\Contracts;

interface Core' . $module . 'ServiceContract
{

}

';
    }

    public function templateService($service, $module): string
    {
        return '<?php

namespace Cms\Modules\\' . $module . '\Services;

use Cms\Modules\\' . $module . '\Services\Contracts\\' . $module . $service . 'ServiceContract;
use Cms\Modules\Core\Services\Core' . $service . 'Service;
use Cms\Modules\\' . $module . '\Repositories\Contracts\\' . $module . $service . 'RepositoryContract;

class ' . $module . $service . 'Service extends Core' . $service . 'Service implements ' . $module . $service . 'ServiceContract
{
	protected $repository;

	function __construct(' . $module . $service . 'RepositoryContract $repository)
	{
	    parent::__construct($repository);

	    $this->repository = $repository;
	}
}

';
    }

    public function templateCoreService($service): string
    {
        return '<?php

namespace Cms\Modules\Core\Services;

use Cms\Modules\Core\Services\Contracts\Core' . $service . 'ServiceContract;
use Cms\Modules\Core\Repositories\Contracts\Core' . $service . 'RepositoryContract;

class Core' . $service . 'Service implements Core' . $service . 'ServiceContract
{
	protected $repository;

	function __construct(Core' . $service . 'RepositoryContract $repository)
	{
	    $this->repository = $repository;
	}
}

';
    }

    public function templateRepositoryContract($repository, $module): string
    {
        return '<?php

namespace Cms\Modules\\' . $module . '\Repositories\Contracts;

use Cms\Modules\Core\Repositories\Contracts\Core' . $repository . 'RepositoryContract;


interface ' . $module . $repository . 'RepositoryContract extends Core' . $repository . 'RepositoryContract
{

}';
    }

    public function templateCoreRepositoryContract($repository): string
    {
        return '<?php

namespace Cms\Modules\Core\Repositories\Contracts;


interface Core' . $repository . 'RepositoryContract
{

}

';
    }

    public function templateRepository($repository, $module): string
    {
        return '<?php

namespace Cms\Modules\\' . $module . '\Repositories;

use Cms\Modules\\' . $module . '\Repositories\Contracts\\' . $module . $repository . 'RepositoryContract;
use Cms\Modules\Core\Repositories\Core' . $repository . 'Repository;

class ' . $module . $repository . 'Repository extends Core' . $repository . 'Repository implements ' . $module . $repository . 'RepositoryContract
{

}

';
    }

    public function templateCoreRepository($repository): string
    {
        return '<?php

namespace Cms\Modules\Core\Repositories;

use Cms\Modules\Core\Repositories\Contracts\Core' . $repository . 'RepositoryContract;
use Cms\Modules\Core\Models\\' . $repository . ';

class Core' . $repository . 'Repository implements Core' . $repository . 'RepositoryContract
{
    protected $model;

    public function __construct(' . $repository . ' $model) {
        $this->model = $model;
    }
}

';
    }

    public function templateController($module, $controller): string
    {
        return '<?php

namespace Cms\Modules\\' . $module . '\Controllers;

use App\Http\Controllers\Controller;

class ' . $controller . 'Controller extends Controller
{
    protected $service;

    public function __construct()
    {
        // register services here...
    }
}

';
    }

    public function templateModel($model): string
    {
        return '<?php

namespace Cms\Modules\Core\Models;
use Illuminate\Database\Eloquent\Model;

class ' . $model . ' extends Model
{
    protected $table = "";

    protected $fillable = [];

    protected $hidden = [];
}

';
    }

    public function templateMiddleware($module, $middleware): string
    {
        return '<?php

namespace Cms\Modules\\' . $module . '\Middlewares;

use Closure;

class ' . $middleware . 'Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // do something here...
    }
}

';
    }

    public function templateRequest($module, $request): string
    {
        return '<?php

namespace Cms\Modules\\' . $module . '\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ' . $request . 'Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}

';
    }

    public function templateTestCase($module): string
    {

        return '<?php

namespace Cms\Modules\\'. $module .'\Tests;

use Cms\Modules\\' . $module . '\\' . $module . 'ServiceProvider;
use Cms\Modules\Core\Tests\CoreTestCase;

abstract class ' . $module . 'TestCase extends CoreTestCase
{

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    protected function getPackageProviders($app): array
    {
        return [
            ' . $module . 'ServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}

';
    }

    public function templatePHPUnit(): string
    {

        return '<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="../../../vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
>
    <testsuites>
        <testsuite name="Unit">
            <directory suffix="Test.php">./Tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory suffix="Test.php">./Tests/Feature</directory>
        </testsuite>
    </testsuites>
    <coverage processUncoveredFiles="true">
        <include>
            <directory suffix=".php">./</directory>
        </include>
    </coverage>
    <php>
        <server name="APP_ENV" value="testing"/>
        <server name="BCRYPT_ROUNDS" value="4"/>
        <server name="CACHE_DRIVER" value="array"/>
        <!-- <server name="DB_CONNECTION" value="sqlite"/> -->
        <!-- <server name="DB_DATABASE" value=":memory:"/> -->
        <server name="MAIL_MAILER" value="array"/>
        <server name="QUEUE_CONNECTION" value="sync"/>
        <server name="SESSION_DRIVER" value="array"/>
        <server name="TELESCOPE_ENABLED" value="false"/>
    </php>
</phpunit>

';
    }

}
