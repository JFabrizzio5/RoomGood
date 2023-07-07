<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Eliminar Sala</title>
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
    <h3>Eliminar Sala</h3>
    <p>¿Estás seguro de que deseas eliminar esta sala?</p>
    <form method="POST" action="procesar_eliminar_sala.php">
      <button type="submit" class="btn btn-danger">Eliminar</button>
      <a href="lista_salas.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
