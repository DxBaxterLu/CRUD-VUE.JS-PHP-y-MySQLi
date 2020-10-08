<?php
    $conn = new mysqli("localhost","root","","crud_vue");
    if($conn->connect_error){
        die("Connection failed!".$conn->connect_error);
    }
    
    $result = array('error'=>false);
    $action = '';

    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    if($action == 'read'){
        $sql = $conn->query("SELECT * FROM users");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users, $row);
        }
        $result['users'] = $users;
    }

    if($action == 'create'){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = $conn->query("INSERT INTO users (username, email, password) VALUES('$username','$email','$password')");
        
        if($sql){
            $result['message'] = "User added successfully";
        }else{
            $result['error'] = true;
            $result['message'] = "Failed to add user";
        }
    }

    if($action == 'update'){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = $conn->query("UPDATE users SET username='$username',email='$email',password='$password' WHERE id='$id'");
        
        if($sql){
            $result['message'] = "User updated successfully";
        }else{
            $result['error'] = true;
            $result['message'] = "Failed to update user";
        }
    }

    if($action == 'delete'){
        $id = $_POST['id'];

        $sql = $conn->query("DELETE FROM users WHERE id='$id'");
        
        if($sql){
            $result['message'] = "User deleted successfully";
        }else{
            $result['error'] = true;
            $result['message'] = "Failed to delete user";
        }
    }

    $conn -> close();
    echo json_encode($result);
?>