<?php
    include "connection.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE from `employee` where id=$id";
        $conn->query($sql);
    }
    header('location:/php-CRUD/index.php');
    exit;
?>