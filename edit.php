<?php

include 'db.php';

if(isset($_GET['id'])) {

    $id = $_GET['id'];
    $query = "SELECT * FROM repuestos WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $code = $row['codigo'];
        $description = $row['descripcion'];
        $price = $row['precio'];
    }
}

if(isset($_POST['update'])) {
    $id = $_GET['id'];
    $code = $_POST['code'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "UPDATE repuestos set codigo = '$code', descripcion = '$description', precio = '$price' WHERE id = $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Actualizado exitosamente';
    $_SESSION['message_type'] = 'warning';

    header('Location: index.php');
}


?>

<?php include 'includes/header.php'; ?>

<div class="datos">
    <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">

        <label for="code">Code:</label>
        <input type="text" name="code" id="code" value="<?php echo $code; ?>" required><br>

        <label for="description">Description:</label>
        <textarea type="text" name="description" id="description" required> <?php echo $description; ?> </textarea> <br>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" value="<?php echo $price; ?>" required><br>

        <input type="submit"  name="update"   value="Update">
    </form>

</div>

<?php include 'includes/footer.php'; ?>
