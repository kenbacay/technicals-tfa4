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
     * The default database connection.
     *
     * The actual Render/Aiven values are loaded in the constructor below.
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
     * This database connection is used when running PHPUnit database tests.
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
     * Load database settings from environment variables.
     */
    public function __construct()
    {
        parent::__construct();

        /*
         * These values come from Render environment variables:
         *
         * database.default.hostname
         * database.default.port
         * database.default.database
         * database.default.username
         * database.default.password
         * database.default.DBDriver
         * database.default.encrypt
         */

        $this->default['hostname'] = env(
            'database.default.hostname',
            $this->default['hostname']
        );

        $this->default['username'] = env(
            'database.default.username',
            $this->default['username']
        );

        $this->default['password'] = env(
            'database.default.password',
            $this->default['password']
        );

        $this->default['database'] = env(
            'database.default.database',
            $this->default['database']
        );

        $this->default['DBDriver'] = env(
            'database.default.DBDriver',
            $this->default['DBDriver']
        );

        $this->default['port'] = (int) env(
            'database.default.port',
            $this->default['port']
        );

        $this->default['encrypt'] = env(
            'database.default.encrypt',
            $this->default['encrypt']
        );

        /*
         * Show detailed database errors only in development.
         * Production hides sensitive error details.
         */
        $this->default['DBDebug'] = ENVIRONMENT !== 'production';

        /*
         * Use the test database when running automated tests.
         */
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}