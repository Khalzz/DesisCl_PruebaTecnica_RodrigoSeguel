<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'votesys';
    $connection = mysqli_connect($host, $user, $password, $database);

    // Check connection
    if (mysqli_connect_errno()) {
    echo "Coneccion fallida: " . mysqli_connect_error();
    exit();
    }
    // query to fetch data from the database
    $sql = "SELECT * FROM candidato";
    $result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option>".$row["nombre_completo"]."</option>";
    }

    // close database connection
    mysqli_close($connection);
?>