<?php
require 'Database.php' ;
class BaseModel
{
    protected $db ;
    function __construct()
    {
        $this->db = Database::getInstance() ;
    }
    protected function handleResult($rs){
        if($rs){
            return $rs ;
        }else {
            return array('error' => $this->db->getError()) ;
        }
    }
}