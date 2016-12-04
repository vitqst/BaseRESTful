<?php
require_once '../Core/Base_Controller.php';
class DemoController extends BaseController
{
    /**
     * @url POST /demo/post
     */
    function demoPostRequest(){
        return $this->outPutData(200,'This is POST request') ;
    }
    /**
     * @url GET /demo/get
     */
    function demoGetRequest(){
        return $this->outPutData(200,'This is GET request');
    }
}