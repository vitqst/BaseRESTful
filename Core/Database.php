<?php
/**
 * User: File
 * Date: 5/19/2016
 * Time: 6:25 AM
 */
class Database
{
    private $_connection;
    private static $_instance; //The single instance
    private $_host = config::Host;
    private $_username = config::Username;
    private $_password = config::Password;
    private $_database = config::Database;
    /*
	Get an instance of the Database
	@return Instance
	*/
    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // Constructor
    private function __construct() {
        $this->_connection = new mysqli($this->_host, $this->_username,
            $this->_password, $this->_database);
        mysqli_query($this->_connection, "SET NAMES 'utf8mb4'"); // importance !
        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(),
                E_USER_ERROR);
        }
    }
    public function __destruct() {
        $this->_connection->close();
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
    // Get mysqli connection
    public function getConnection() {
        return $this->_connection;
    }
    public function executeQuery($query){
        $result =  mysqli_query($this->_connection,$query);
        return $result ;

    }
    public function realString($string){
        if(is_string($string)){
            $string = trim($string,' ') ;
            return mysqli_escape_string($this->_connection,$string);
        }else{
            return $string ;
        }
    }
    public function getLastInsert(){
        return $this->_connection->insert_id;
    }
    public function getError(){
        return $this->_connection->error;
    }
}