<?php

class Bootstrap
{
    /** @var null|Bootstrap */
    public static $instance = null;

    /** @var object */
    public $configuration;

    /**
     * @return Bootstrap
     */
    public static function singleton()
    {
        if (! self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->loadConfiguration();
        $this->registerAutoloaders();
        $this->registerSupportLibraries();
    }

    public function registerSupportLibraries()
    {
        include_once(SUPPORT_DIRECTORY . '/parsedown/Parsedown.php');

        include_once(SUPPORT_DIRECTORY . '/php-activerecord/ActiveRecord.php');
        ActiveRecord\Config::initialize(function($cfg) {
            /** @var ActiveRecord\Config $cfg */
            $cfg->set_model_directory(APPLICATION_DIRECTORY . '/models/');
            $cfg->set_connections(
                array
                (
                    'development' => sprintf('mysql://%s:%s@%s/%s',
                        $this->configuration->database->username,
                        $this->configuration->database->password,
                        $this->configuration->database->host,
                        $this->configuration->database->databaseName
                    ),
                )
            );
        });
    }

    public function registerAutoloaders()
    {
        spl_autoload_register(function($className) {
            $filename = APPLICATION_DIRECTORY . '/' . str_replace('_', '/', $className) . '.class.php';
            if (file_exists($filename)) {
                include_once($filename);
            }
        });

        spl_autoload_register(function($className) {
            $filename = APPLICATION_DIRECTORY . '/models/' . str_replace('_', '/', $className) . '.php';
            if (file_exists($filename)) {
                include_once($filename);
            }
        });
    }

    public function loadConfiguration($configFile = null)
    {
        if ($configFile === null) {
            $configFile = realpath(dirname(__FILE__) . '/configuration/config.json');
        }

        if (file_exists($configFile)) {
            $configuration = json_decode(file_get_contents($configFile));
            $this->configuration = $configuration;
        } else {
            throw new Exception('Configuration file not found.');
        }

        define('ROOT_DIRECTORY', realpath(dirname(__FILE__) . '/../'));
        define('APPLICATION_DIRECTORY', ROOT_DIRECTORY . '/application');
        define('SUPPORT_DIRECTORY', ROOT_DIRECTORY . '/support');
        define('VIEW_DIRECTORY', realpath(dirname(__FILE__) . '/../media/templates/' . $this->configuration->theme->name));

        define('ROOT_URI', dirname($_SERVER['PHP_SELF']));
    }

    public function handle()
    {
        $view = new View('layout.tpl.php');
        $view->render();
    }

    public function renderMainContent()
    {
        $requestUri = ltrim(str_replace(ROOT_URI, '', $_SERVER['REDIRECT_URL']), '/');

        $controller = Controller::factory($requestUri);
        $controller->handle($requestUri);
    }

    public function url()
    {
        $args = func_get_args();

        $uri = implode('/', $args);

        $uri = rtrim(ROOT_URI, '/') . '/' . ltrim($uri, '/');

        return $uri;
    }

    public function encryptString($string)
    {
        $methods = openssl_get_cipher_methods();
        // Use the first cipher method
        $method = array_shift($methods);

        $result = openssl_encrypt($string, $method, $this->configuration->encryptionKey);

        return $result;
    }

    public function decryptString($string)
    {
        $methods = openssl_get_cipher_methods();
        // Use the first cipher method
        $method = array_shift($methods);

        $result = openssl_decrypt($string, $method, $this->configuration->encryptionKey);

        return $result;
    }

    public function secondsToHms($seconds, $formatDays = true)
    {
        $minutes = (int)($seconds / 60);
        $seconds -= $minutes * 60;

        $hours = (int)($minutes / 60);
        $minutes -= $hours * 60;

        $days = (int)($hours / 24);
        $hours -= $days * 24;

        if ($days > 0 && $formatDays == true) {
            $hms = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
            $hms = $days . ' day' . ($days != 1 ? 's' : '') . ', ' . $hms;
        } else {
            if ($days > 0) {
                $hours += $days * 24;
            }

            $hms = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }

        return $hms;
    }
}

function ap($var, $method = 'print_r')
{
    echo '<pre>';
    $method($var);
    echo '</pre>';
}
