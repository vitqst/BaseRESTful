<?php

/**
 * Created by PhpStorm.
 * User: anonymous
 * Date: 12/4/16
 * Time: 2:46 PM
 */
require_once '../Core/Base_Model.php' ;
class ModelUser extends BaseModel
{
    public $userObject = array(
        'user_name' => '',
        'user_pass' => ''
    ) ;

    function __construct($user_name,$user_pass)
    {
        parent::__construct();
        $this->userObject = array(
            'user_name' => $user_name,
            'user_pass' => $user_pass
        ) ;
    }

    function checkIsset(){
        $name = $this->userObject['user_name'];
        $pass = $this->userObject['user_pass'];
        $query = "select * from user where username = '$name' and password = '$pass'" ;
        $result = $this->db->executeQuery($query) ;
        return $this->handleResult($result) ;
    }
}