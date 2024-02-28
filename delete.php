<?php
include 'db.php';

if(isset($_GET['id'])) {

    $id = $_GET['id'];
    $query = "DELETE FROM repuestos WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }

    $_SESSION['message'] = 'Eliminado exitosamente';
    $_SESSION['message_type'] = 'danger';

    header('Location: index.php');


}


?>