<?php
    // data input
    $rut = $_POST['rut'];
    $nombre_completo = $_POST['nombre_completo'];
    $alias = $_POST['alias'];
    $email = $_POST['email'];
    $region = $_POST['region'];
    $comuna = $_POST['comuna'];
    $candidato = $_POST['candidato'];
    $conocido = $_POST['conocido'];

    // data validation
    if (empty($rut) || empty($nombre_completo) || empty($email) || empty($region) || empty($comuna) || empty($candidato) || empty($conocido)) {
        echo "Por favor, rellene todos los campos obligatorios.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico proporcionado no es valido.";
        exit();
    }

    if (strlen($nombre_completo) > 100) {
       echo "El nombre debe tener menos de 50 caracteres.";
        exit();
    }
    
    if (strlen($alias) > 50) {
        echo "El alias no debe tener mas de 50 caracteres.";
        exit();
    }

    
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'votesys';
    $connection = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Error de conexion en MySql:" . mysqli_connect_error();
        exit();
    }

    // cheking if the user already voted
    $stmt = $connection->prepare("SELECT * FROM votante WHERE rut = ?");
    $stmt->bind_param("s", $rut);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "Este usuario ya ha votado";
    } else {
        // uploading the elements to the server
        $stmt = $connection->prepare("INSERT INTO votante (rut, nombre_completo, alias, email, id_region, id_comuna, rut_candidato, conocido_por) VALUES (?, ?, ?, ?, ?, (SELECT id_comuna FROM comuna WHERE nombre_comuna = ?), (SELECT rut FROM candidato WHERE nombre_completo = ?), ?)");
        $stmt->bind_param("ssssisss", $rut, $nombre_completo, $alias, $email, $region, $comuna, $candidato, $conocido);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            echo "Votante registrado exitosamente.";
        } else {
            echo "Error al registrar el votante: " . $stmt->error;
        }
    }
    // Close connection
    mysqli_close($connection);
?>
