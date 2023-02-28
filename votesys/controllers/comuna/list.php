<?php
    // this code brings the comunas for the user select
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'votesys';
    $connection = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
    echo "Coneccion fallida: " . mysqli_connect_error();
    exit();
    }
    
    if (isset($_GET['region_id']) && !empty($_GET['region_id'])) {
        $region_id = $_GET['region_id'];
        $sql = "SELECT * FROM comuna WHERE id_region = $region_id";
        $result = mysqli_query($connection, $sql);
    } else {
        $sql = "SELECT * FROM comuna";
        $result = mysqli_query($connection, $sql);
    }

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option>".$row["nombre_comuna"]."</option>";
    }

    // close database connection
    mysqli_close($connection);
?>