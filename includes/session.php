<?php 
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if (isset($_SESSION['admin'])){
    header('location: admin/');
}
else if (isset($_SESSION['manager'])){
    header('location: manager/');
}
else if (isset($_SESSION['employee'])){
    header('location: employ/');
}
else if (isset($_SESSION['customer'])){
    header('location: customer/');
}
