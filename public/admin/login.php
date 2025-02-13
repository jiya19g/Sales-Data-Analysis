<?php

require_once 'login_config.php';

global $dbc;
 
$stmt = $dbc->prepare("SELECT username,password,user_id from admin WHERE 
username='" . $_POST['username'] . "' && password='" . $_POST['password'] . "'");
//echo md5('admin');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
//print_r($result); 
 $username = $result['username'];
 $user_id = $result['user_id'];
$row = $stmt->rowCount();


if ($row > 0) {
   
   
    //IJADST_usrname
    $data = array(
        'status' => 'correct',
        'username' => $username ,
        'message' => "Login Success",
        'user_id' => $user_id
    );
    echo json_encode($data);
    //echo 'correct';
} else {
    $data['status']= 'wrong';
    echo json_encode($data);
    //echo 'wrong';
}
?>