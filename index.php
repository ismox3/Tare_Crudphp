<?php include 'db.php'; ?>

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


<div class="datos">
    <form action="save.php" method="POST">

        <label for="code">Code:</label>
        <input type="text" name="code" id="code" required><br>

        <label for="description">Description:</label>
        <textarea type="text" name="description" id="description" required> </textarea> <br>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required><br>

        <input type="submit" name="save" value="Add">
    </form>
</div>

<div class="tabla">
    <form action="" method="GET">
        <input type="text" name="search" placeholder="Search...">
        <input type="submit" value="Search">
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
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

                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['codigo'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . $row['precio'] . "</td>";

                echo "<td>" . "<a href='edit.php?id=" . $row['id'] . "'>Edit</a>" . "</td>";
                echo "<td>" . "<a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este elemento?\")'>Delete</a>" . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>





<?php include 'includes/footer.php'; ?>