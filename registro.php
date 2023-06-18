<!DOCTYPE html>
<html>
<head>
  <title>Registrar sesión</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="container1">
    <div class="login1-container">
      <h4 class="center-text">Registrate</h4>
      <form action="" method="post">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="correo" placeholder="Correo" required>
        <input type="text" name="username" placeholder="Nombre de usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
      </form>
      <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $nombre = $_POST['nombre'];
          $correo = $_POST['correo'];
          $username = $_POST['username'];
          $password_form = $_POST['password'];

          // Validar el formato del correo electrónico
          if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $error = "El correo electrónico es inválido.";
            echo "<p class='error-message'>$error</p>";
            echo "<script>showNotification('$error', 'error');</script>";
          } else {
            // Verificar si el usuario ya existe en la base de datos
            $servidor = "127.0.0.1";
            $usuario = "root";
            $password = "";
            $basededatos = "login";
            $conector = new mysqli($servidor, $usuario, $password, $basededatos);
            
            if ($conector->connect_error) {
              echo "No se conectó a la base de datos";
            } else {
              $sql_check = "SELECT COUNT(*) AS count FROM usuarios WHERE username = '$username'";
              $query_check = $conector->query($sql_check);
              $result_check = $query_check->fetch_assoc();

              if ($result_check['count'] > 0) {
                // Usuario existente, mostrar notificación de error
                $error = "El usuario ya existe en la base de datos.";
                echo "<p class='error-message'>$error</p>";
                echo "<script>showNotification('$error', 'error');</script>";
              } else {
                // Verificar si el correo electrónico ya existe en la base de datos
                $sql_check_email = "SELECT COUNT(*) AS count FROM usuarios WHERE correo = '$correo'";
                $query_check_email = $conector->query($sql_check_email);
                $result_check_email = $query_check_email->fetch_assoc();

                if ($result_check_email['count'] > 0) {
                  // Correo electrónico existente, mostrar notificación de error
                  $error = "El correo electrónico ya está registrado.";
                  echo "<p class='error-message'>$error</p>";
                  echo "<script>showNotification('$error', 'error');</script>";
                } else {
                  // Insertar el nuevo usuario
                  $sql_insert = "INSERT INTO usuarios (nombre, correo, username, pass) VALUES ('$nombre', '$correo', '$username', '$password_form')";
                  $query_insert = $conector->query($sql_insert);

                  if ($query_insert) {
                    $success = "El usuario ha sido registrado correctamente.";
                    echo "<p class='error-message'>$success</p>";
                    echo "<script>showNotification('$success', 'success');</script>";
                  }
                }
              }
              $conector->close();
            }
          }
        }
        ?>

    </div>
    <div class="register1-container">
      <h3 class="center-text">¿Ya tienes una cuenta?</h3>
      <p class="center-text">
        Inicia sesión para entrar en la página.
      </p><br>
      <a href="index.php"><button type="button">Iniciar Sesión</button></a>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>
