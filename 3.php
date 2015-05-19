<?php

ini_set('error_reporting', E_ALL);
include('../adodb5/adodb.inc.php');

class DatabaseClient {

    private static $instance;
    private $connection;
    private $driver = 'mysql';

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function connectByArray($array) {
        if (
                !array_key_exists('host', $array) ||
                !array_key_exists('user', $array) ||
                !array_key_exists('password', $array) ||
                !array_key_exists('database', $array)
        ) return false;
        $this->connection = NewADOConnection($this->driver);
        $this->connection->Connect($array['host'], $array['user'], $array['password'], $array['database']);
        return ($this->connection) ? $this->connection : false;
    }

    public function connectByDSNString($dsnString) {
        $this->connection = NewADOConnection($dsnString);
        return ($this->connection) ? $this->connection : false;
    }

    public function connectByXMLFile($xmlFile) {
        $xml = simplexml_load_file($xmlFile);
        if (
                !$xml ||
                !isset($xml->host) ||
                !isset($xml->user) ||
                !isset($xml->password) ||
                !isset($xml->database)
        ) return false;
        $this->connection = NewADOConnection($this->driver);
        $this->connection->Connect($xml->host, $xml->user, $xml->password, $xml->database);
        return ($this->connection) ? $this->connection : false;
    }

}

//Connection by array
$connectionArray = array(
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'root',
    'database' => '3'
);
$connection = DatabaseClient::getInstance()->connectByArray($connectionArray);
$rowsCount = $connection->execute('SELECT * FROM Main')->rowCount();
$connection->Close();
echo 'Connection array: ';
var_dump($connectionArray);
echo 'Rows count: ' . $rowsCount . '<br/><br/>';

//Connection by DSN string
$dsnString = "mysql://root:root@localhost/3";
$connection = DatabaseClient::getInstance()->connectByDSNString($dsnString);
$rowsCount = $connection->execute('SELECT * FROM Main')->rowCount();
$connection->Close();
echo 'DSN string: ' . $dsnString . '<br/>';
echo 'Rows count: ' . $rowsCount . '<br/><br/>';

//Connection by XML file
$pathToXMLFile = "3.xml";
$connection = DatabaseClient::getInstance()->connectByXMLFile($pathToXMLFile);
$rowsCount = $connection->execute('SELECT * FROM Main')->rowCount();
$connection->Close();
echo 'XML file: ' . htmlspecialchars(file_get_contents($pathToXMLFile)) . '<br/>';
echo 'Rows count: ' . $rowsCount . '<br/><br/>';
