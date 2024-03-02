<?php include 'db.php'; ?>

<style>
    *,
    *:before,
    *:after {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #080710;
    }

    .background {
        width: 430px;
        height: 520px;
        position: absolute;
        transform: translate(-50%, -50%);
        left: 50%;
        top: 50%;
    }

    .background .shape {
        height: 200px;
        width: 200px;
        position: absolute;
        border-radius: 50%;
    }

    .miregistro {
        width: 40vw;

        position: relative;
        padding: 6% 0 30px 0;
    }

    .mitablita {
        background-color: #080710;
        position: relative;


        margin-right: 15vh;



    }

    .registro {
        height: 700px;
        width: 400px;
        background-color: rgba(255, 255, 255, 0.13);
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
        padding: 50px 35px;
    }

    form * {
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
        letter-spacing: 0.5px;
        outline: none;
        border: none;
    }

    form h3 {
        font-size: 32px;
        font-weight: 500;
        line-height: 42px;
        text-align: center;
    }

    label {
        display: block;
        margin-top: 30px;
        font-size: 16px;
        font-weight: 500;
    }


    input {
        display: block;
        height: 50px;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.07);
        border-radius: 3px;
        padding: 0 10px;
        margin-top: 8px;
        font-size: 14px;
        font-weight: 300;
    }

    ::placeholder {
        color: #ffffff;
    }

    .boton {
        margin-top: 10px;
        width: 100%;
        background-color: #ffffff;
        color: #080710;
        padding: 15px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .social div:hover {
        background-color: rgba(255, 255, 255, 0.47);
    }

    .social .fb {
        margin-left: 25px;
    }

    .social i {
        margin-right: 4px;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }



    .form {
        max-width: 400px;
        /* Ancho máximo del formulario */
        margin: 0 auto;
        /* Centrar en la pantalla */
    }

    .form-group {
        margin-bottom: 15px;
        /* Espaciado entre grupos */
    }

    label {
        margin-bottom: 5px;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .rectangle {
        width: 400px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form {
        max-width: 400px;
        /* Ancho máximo del formulario */
        margin: 0 auto;
        /* Centrar en la pantalla */
    }

    .form-group {
        margin-bottom: 15px;
        /* Espaciado entre grupos */
    }

    label {
        margin-bottom: 5px;
    }


    input {
        margin-bottom: 15px;
        padding: 8px;
    }


    table {
        margin-top: 20px;
        height: 60%;

        border-collapse: collapse;
        overflow-y: auto;
        overflow-x: hidden;
        display: block;
    }

    th {
        padding: 10px;
        background-color: white;
        color: black;
        border: 1px solid black;

    }

    a {
        text-decoration: none;
        color: black;
    }
</style>

<?php include 'includes/header.php'; ?>



<?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-warnig alert-dismissible fade show" role="alert">
        <?= $_SESSION['message'] ?>
        <button type="button" class="close" clo data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php session_unset();
} ?>


<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>


<div class="container">

    <div class="miregistro">
        <form action="save.php" method="POST" class="registro">

            <h3>Tabla de Registro</h3>
            <div class="form">

                <div class="form-group">
                    <label for="code">Code:</label>
                    <input type="text" name="code" id="code" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" required> </input>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price" required>
                </div>


                <input id="addIten" class="boton" type="submit" name="save" value="Add">
            </div>
        </form>

    </div>

    <div class="mitablita">
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Search...">
            <input type="submit" value="Search">
        </form>

        <div class="tabla">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th colspan="2">Actions</th>
                    </tr>


                </thead>


                <tbody id="itemList">

                    <?php

                    // Fetch data from the database and populate the table
                    $query = "SELECT * FROM repuestos";

                    // Check if search query is provided
                    if (isset($_GET['search'])) {
                        $search = $_GET['search'];
                        $query .= " WHERE codigo LIKE '%$search%' OR descripcion LIKE '%$search%'";
                    }

                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {


                        ?>

                        <tr>
                            <th>
                                <?php echo $row['id']; ?>
                            </th>
                            <th>
                                <?php echo $row['codigo']; ?>
                            </th>
                            <th>
                                <?php echo $row['descripcion']; ?>
                            </th>
                            <th>
                                <?php echo $row['precio']; ?>
                            </th>
                            <?php
                            echo "<th>" . "<a href='edit.php?id=" . $row['id'] . "'>Edit</a>" . "</td>";
                            echo "<th>" . "<a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este elemento?\")'>Delete</a>" . "</td>";
                            echo "</tr>";
                            ?>
                        <?php } ?>

                    </tr>
                </tbody>
            </table>

        </div>

    </div>


</div>



</div>








<?php include 'includes/footer.php'; ?>