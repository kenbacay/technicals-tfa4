<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * --------------------------------------------------------------------------
     * Database Files Path
     * --------------------------------------------------------------------------
     *
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * --------------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------------
     *
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * --------------------------------------------------------------------------
     * Default Database Connection
     * --------------------------------------------------------------------------
     *
     * Default values are used locally.
     * Render values are loaded inside the constructor.
     *
     * @var array<string, mixed>
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => '',
        'password'     => '',
        'database'     => '',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
        'foundRows'    => false,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    /**
     * --------------------------------------------------------------------------
     * Test Database Connection
     * --------------------------------------------------------------------------
     *
     * This connection is used when running PHPUnit database tests.
     *
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => true,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'synchronous' => null,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    /**
     * --------------------------------------------------------------------------
     * Constructor
     * --------------------------------------------------------------------------
     *
     * Loads database settings from environment variables.
     *
     * Local variables can remain as the default values above.
     * Render uses the following variables:
     *
     * DB_HOST
     * DB_PORT
     * DB_NAME
     * DB_USER
     * DB_PASSWORD
     * DB_DRIVER
     * DB_ENCRYPT
     */
    public function __construct()
    {
        parent::__construct();

        /*
         * Database server hostname.
         */
        $this->default['hostname'] =
            getenv('DB_HOST') ?: 'localhost';

        /*
         * Database server port.
         */
        $this->default['port'] =
            (int) (getenv('DB_PORT') ?: 3306);

        /*
         * Database name.
         */
        $this->default['database'] =
            getenv('DB_NAME') ?: '';

        /*
         * Database username.
         */
        $this->default['username'] =
            getenv('DB_USER') ?: '';

        /*
         * Database password.
         */
        $this->default['password'] =
            getenv('DB_PASSWORD') ?: '';

        /*
         * Database driver.
         */
        $this->default['DBDriver'] =
            getenv('DB_DRIVER') ?: 'MySQLi';

        /*
         * Aiven requires an encrypted connection.
         */
        $this->default['encrypt'] =
            filter_var(
                getenv('DB_ENCRYPT') ?: 'false',
                FILTER_VALIDATE_BOOLEAN
            );

        /*
         * Show detailed errors only outside production.
         */
        $this->default['DBDebug'] =
            ENVIRONMENT !== 'production';

        /*
         * Use the test database during automated testing.
         */
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}