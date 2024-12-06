<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
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
        'charset'      => 'utf8',
        'DBCollat'     => 'utf8_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];
 
    /**
     * The caracterizacion database connection.
     */
    public array $bd_caracterizacion = [
        'DSN'          => '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=30.0.1.63)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=RNI)))',
        'hostname'     => '',
        'username'     => 'caracterizacion',
        'password'     => 'car321',
        'database'     => '',
        'DBDriver'     => 'OCI8'
    ];
    /**
     * The RUV database connection.
     */
    public array $bd_ruv = [
        'DSN'          => '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=30.0.1.60)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=ruv)))',
        'hostname'     => '',
        'username'     => 'ruv',
        'password'     => 'Karm3l1a',
        'database'     => '',
        'DBDriver'     => 'OCI8'
    ]; 


    /**
     * The SIPOD database connection.
     */
    public array $bd_sipod = [
        'DSN'          => '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=30.0.1.62)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=VICTIUNO)))',
        'hostname'     => '',
        'username'     => 'Consulta',
        'password'     => 'Bog654',
        'database'     => '',
        'DBDriver'     => 'OCI8'
    ];

    /**
     * The SIRAV database connection.
     */
    public array $bd_sirav = [
        'DSN'      => '',
        'hostname' => '30.0.1.66', // Nombre o dirección IP del servidor SQL Server
        'username' => 'juan.huertas',
        'password' => 'siRR4p',
        'database' => '', // No es necesario proporcionar el nombre de la base de datos
        'DBDriver' => 'SQLSRV', // Usar el controlador SQL Server
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'cacheOn'  => false,
        'cacheDir' => '',
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false, // Puedes establecer esto a true si deseas cifrar la conexión
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 1433, // Puerto por defecto de SQL Server
    ];

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => 'utf8_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

   

    public $bd_reg_poblacional = [
        'DSN'      => '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=30.0.1.70)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=PRUEBASRN)))',
        'hostname' => '30.0.1.70',
        'username' => 'DAE_PRUEBAS',
        'password' => 'sWd43.D2',
        'database' => '',
        'DBDriver' => 'oci8',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'cacheOn'  => false,
        'cacheDir' => '',
        'charset'  => '',
        'DBCollat' => '',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 1521, // puerto por defecto de Oracle
    ];

    

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
