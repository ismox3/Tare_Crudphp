<?php   

include 'db.php';

if(isset($_POST['save'])){

    $code = $_POST['code'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "INSERT INTO repuestos (codigo, descripcion, precio) VALUES ('$code', '$description', '$price')";
    $result= mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }
    
    $_SESSION['message'] = 'guardado exitosamente';
    $_SESSION['message_type'] = 'success';

    header('Location: index.php');


}


?>