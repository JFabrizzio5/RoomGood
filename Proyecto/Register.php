<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Formulario de Registro</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f2f2f2;
    }
    
    .container {
      background-color: #ffffff;
      padding: 40px;
      margin-top: 100px;
      border-radius: 5px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }
    
    .form-control {
      border-color: #bcbcbc;
    }
    
    .form-control:focus {
      border-color: #7d5cff;
      box-shadow: none;
    }
    
    .btn {
      background-color: #7d5cff;
      border-color: #7d5cff;
    }
    
    .btn:hover {
      background-color: #6c49e8;
      border-color: #6c49e8;
    }
  </style>
</head>
<body>
  <div class="container">
    <h3>Registro de Usuario</h3>
    <form method="POST" action="procesar_registro.php">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="confirmar_password">Confirmar Contraseña:</label>
        <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" required>
      </div>
      <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
