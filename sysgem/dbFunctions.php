<?php
function connect(){ //connect database
    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if(mysqli_connect_errno())
        die("Connection failed.");
    else
        return $db;
}
function execute($q){ //execute queries into database
    $db =connect();
    $result = mysqli_query($db, $q);
    foreach($result as $data){
        echo "ID is " . $data["id"] . " and Name is " . $data["name"] . ".<br>";
    }
}
function debugger($data){
    echo "<pre>" . print_r($data, true) . "</pre>";
}
function retrieveData($qry){ //retrieving single data
    //$qry = "SELECT * FROM users WHERE id = $id"; 
    $db = connect();
    $result = mysqli_query($db, $qry);
    if(mysqli_num_rows($result) > 0){
        foreach($result as $data){
            echo "ID is " . $data["id"] . "<br>";
            echo "Name is " . $data["name"] . "<br>";
            echo "Email is " . $data["email"] . "<br>";
            echo "Password is " . $data["password"] . "<br>";
        }
    }
}
function insert($qry){ //insert new datas
    $db = connect();
    $result = mysqli_query($db, $qry);
    echo $result > 0 ? "Data inserted successfully." : "Data insertion failed.";
}
function insertUniqueData($name, $email, $pass){ //insert data that are  unique
    $qry = "SELECT * FROM member WHERE email ='$email'";
    $db = connect();
    $curTime = getTimeNow(); 
    $r = mysqli_query($db, $qry);
    if(mysqli_num_rows($r) > 0){
        return "Email already in used.";
    }else{
        $qry = "INSERT INTO member (name, email, password, created_at, updated_at) 
        VALUES ('$name', '$email', '$pass', '$curTime', '$curTime')";
        $result = mysqli_query($db, $qry);
        if ($result == 1){
            return "Registration successful.";
        }else{
            return "Registration failed.";
        }
    }
        
}
function insertMultiData($qry){ //insert multiple datas at once
    $db = connect();
    $r = mysqli_multi_query($db, $qry); 
    echo $r > 0 ? "Data inserted successfully." : "Data insertion failed.";

}
function userLogin($email, $pass){
    $db = connect();
    $q = "SELECT name FROM member WHERE email = '$email' AND password = '$pass'";
    $result = mysqli_query($db, $q);
    
    if($result){
        $username = "";
        foreach($result as $str){
            $username = $str["name"];
        }
        setSession('username', $username);
        setSession('email', $email);
        return "Login success.";
    }else{
        return "Login failed.";
    }
}
function delete($id){ //delete datas
    $qry = "DELETE FROM member WHERE id = $id";
    $db = connect();
    $r = mysqli_multi_query($db, $qry); 
    echo $r > 0 ? "Data deleted successfully." : "Data deletion failed.";
}
function update($type , $new, $id){ //update datas
    $qry = "UPDATE member SET $type = '$new' where id = '$id'";
    $db = connect();
    $r = mysqli_multi_query($db, $qry); 
    echo $r > 0 ? "Data updated successfully." : "Data updating failed.";
}
function getTimeNow(){
    return date("y-m-d h:m:s",time());
}
?>