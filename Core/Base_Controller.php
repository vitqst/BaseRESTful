<?php

class BaseController
{
    /**
     * @param $rs
     * @return array
     */
    function castMysqlResult($rs) {
        $fields = mysqli_fetch_fields($rs);
        $data = array();
        $types = array();
        foreach($fields as $field) {
            switch($field->type) {
                case MYSQLI_TYPE_NULL:
                    $types[$field->name] = 'null';
                    break;
                case MYSQLI_TYPE_BIT:
                    $types[$field->name] = 'boolean';
                    break;
                case MYSQLI_TYPE_TINY:
                case MYSQLI_TYPE_SHORT:
                case MYSQLI_TYPE_LONG:
                case MYSQLI_TYPE_INT24:
                case MYSQLI_TYPE_LONGLONG:
                    $types[$field->name] = 'int';
                    break;
                case MYSQLI_TYPE_FLOAT:
                case MYSQLI_TYPE_DOUBLE:
                    $types[$field->name] = 'float';
                    break;
                default:
                    $types[$field->name] = 'string';
                    break;
            }
        }
        while($row=mysqli_fetch_assoc($rs)) array_push($data,$row);
        return $data;
    }

    public function outPutData($code, $message=null, $data=null){
        $this->http_response_code($code) ;
        $return_data = array() ;
        if($message == null || ($message == "")){
            $return_data = array("status"=>$code,"data"=>$data,"message"=>$this->CodeMsg($code),"num_rows"=>count($data));
        }else{
            $return_data = array("status"=>$code,"data"=>$data,"message"=>$message,"num_rows"=>count($data));
        }
        return $return_data ;
    }
    function http_response_code($code = NULL) {
        if ($code !== NULL) {
            $text = $this->CodeMsg($code);
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . $code . ' ' . $text);
            header('Access-Control-Allow-Origin: http://the360lifechange.com');
            $GLOBALS['http_response_code'] = $code;
        } else {
            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
        }
        return $code;
    }
    function CodeMsg($code){
        switch ($code) {
            case 100: $text = 'Continue'; break;
            case 101: $text = 'Switching Protocols'; break;
            case 200: $text = 'OK'; break;
            case 201: $text = 'Created'; break;
            case 202: $text = 'Accepted'; break;
            case 203: $text = 'Non-Authoritative Information'; break;
            case 204: $text = 'No Content'; break;
            case 205: $text = 'Reset Content'; break;
            case 206: $text = 'Partial Content'; break;
            case 300: $text = 'Multiple Choices'; break;
            case 301: $text = 'Moved Permanently'; break;
            case 302: $text = 'Moved Temporarily'; break;
            case 303: $text = 'See Other'; break;
            case 304: $text = 'Not Modified'; break;
            case 305: $text = 'Use Proxy'; break;
            case 400: $text = 'Bad Request'; break;
            case 401: $text = 'Unauthorized'; break;
            case 402: $text = 'Payment Required'; break;
            case 403: $text = 'Forbidden'; break;
            case 404: $text = 'Not Found'; break;
            case 405: $text = 'Method Not Allowed'; break;
            case 406: $text = 'Not Acceptable'; break;
            case 407: $text = 'Proxy Authentication Required'; break;
            case 408: $text = 'Request Time-out'; break;
            case 409: $text = 'Conflict'; break;
            case 410: $text = 'Gone'; break;
            case 411: $text = 'Length Required'; break;
            case 412: $text = 'Precondition Failed'; break;
            case 413: $text = 'Request Entity Too Large'; break;
            case 414: $text = 'Request-URI Too Large'; break;
            case 415: $text = 'Unsupported Media Type'; break;
            case 500: $text = 'Internal Server Error'; break;
            case 501: $text = 'Not Implemented'; break;
            case 502: $text = 'Bad Gateway'; break;
            case 503: $text = 'Service Unavailable'; break;
            case 504: $text = 'Gateway Time-out'; break;
            case 505: $text = 'HTTP Version not supported'; break;
            default:
                exit('Unknown http status code "' . htmlentities($code) . '"');
                break;
        }
        return $text ;
    }
    function getValue($key,$method = null,$default_value = null){
        $_HEADER = getallheaders() ;
        if($method == 'post'){
            return (isset($_POST[$key]) ? $_POST[$key] : $default_value) ;
        }elseif($method == 'header'){
            return (isset($_HEADER[$key]) ? $_HEADER[$key] : $default_value) ;
        }else{
            return (isset($_GET[$key]) ? $_GET[$key] : $default_value) ;
        }
    }
}