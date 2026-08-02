<?php
include_once('./database/connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM `pegawai` WHERE id = $id";
    mysqli_query($connection, $query);

    header("Location: admin.php?status=deleted");
    exit;
}else{
    header("Location: admin.php");
    exit;
}