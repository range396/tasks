<?php
include_once('conn.php');

$data = json_decode(file_get_contents('php://input'), true);

$parsed = json_encode($data);

function is_in_array($array, $key, $key_value) {
      $within_array = false;
      foreach( $array as $k=>$v ) {
        if( is_array($v) ) {
            $within_array = is_in_array($v, $key, $key_value);
            if( $within_array == true ){
                break;
            }
        } else {
                if( $v == $key_value && $k == $key ){
                        $within_array = true;
                        break;
                }
        }
      }
      return $within_array;
}

if(isset($data["userData"]) && count($data["userData"])) {  
    // setcookie('userData', $parsed, time()+300, '/');
    $sql = $conn->prepare("SELECT * FROM visitors ORDER BY id DESC");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    if(!is_in_array($result, "ip", $data["userData"]['ip'])) {
        
        $sql = $conn->prepare("INSERT INTO `visitors`
         (ip, city, visit_time, device) 
        VALUES (:ip, :city, :visit_time, :device);", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        $sql->execute([
            'ip' => $data["userData"]['ip'],
            'city' => $data["userData"]['city'],
            'visit_time' => $data["userData"]['visitorTime'],
            'device' => $data["userData"]['device']
        ]);

        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        print(json_encode($res));
    } else {
        print(json_encode($result));
    }
    // print(json_encode($result));
    // if($result) {
    //     print(json_encode($result));
    // }
}







