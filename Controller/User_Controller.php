<?php
require_once '../Core/Base_Controller.php';

class UserController extends BaseController
{
    /**
     * @url GET /user/login
     */
    function login(){
        require '../Model/ModelUser.php' ;

        $user_name = $this->getValue('name') ;
        $user_pass = $this->getValue('pass') ;
        $user = new ModelUser($user_name,$user_pass) ;
        $result = $user->checkIsset() ;
        return $this->outPutData(200,null,mysqli_num_rows($result)) ;
    }
}