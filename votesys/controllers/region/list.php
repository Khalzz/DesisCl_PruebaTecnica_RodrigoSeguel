<?php
    // this code brings the regions for the user select
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'votesys';
    $connection = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Coneccion fallida: " . mysqli_connect_error();
        exit();
    }

        $sql = "SELECT * FROM region";
        $result = mysqli_query($connection, $sql);


    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option>".$row['id_region']."-".$row["nombre_region"]."</option>";
    }

    mysqli_close($connection);
?>