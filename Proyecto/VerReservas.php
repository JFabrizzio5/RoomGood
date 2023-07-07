<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ver Reservas</title>
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
    
    .table {
      margin-top: 20px;
    }
    
    .table th,
    .table td {
      vertical-align: middle;
    }
    
    .btn {
      background-color: #7d5cff;
      border-color: #7d5cff;
    }
    
    .btn:hover {
      background-color: #6c49e8;
      border-color: #6c49e8;
    }
    
    .alert-container {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h3>Reservas</h3>
    <div class="alert-container"></div>
    <table class="table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Fecha de Inicio</th>
          <th>Hora de Inicio</th>
          <th>Hora de Fin</th>
          <th>Fecha de Fin</th>
          <th>Sala</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>John Doe</td>
          <td>2023-07-07</td>
          <td>14:00</td>
          <td>16:00</td>
          <td>2023-07-07</td>
          <td>Sala A</td>
          <td>
            <button class="btn btn-primary">Editar</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete">Eliminar Reserva</button>
          </td>
        </tr>
        <tr>
          <td>Jane Smith</td>
          <td>2023-07-08</td>
          <td>10:30</td>
          <td>12:00</td>
          <td>2023-07-08</td>
          <td>Sala B</td>
          <td>
            <button class="btn btn-primary">Editar</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete">Eliminar Reserva</button>
          </td>
        </tr>
        <!-- Agrega más filas según tus necesidades -->
      </tbody>
    </table>
    <a href="agregar_reserva.php" class="btn btn-primary">Agregar Reserva</a>
  </div>

  <!-- Cuadro de diálogo de confirmación de eliminación -->
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Confirmar Eliminación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Estás seguro de que quieres eliminar esta reserva?</p>
          <form id="delete-form">
            <div class="form-group">
              <label for="delete-confirmation">Escribe "Eliminar" para confirmar:</label>
              <input type="text" class="form-control" id="delete-confirmation" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="confirm-delete-btn">Sí</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
    // Obtener el formulario de eliminación y el botón de confirmación
    var deleteForm = document.getElementById('delete-form');
    var confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    var alertContainer = document.querySelector('.alert-container');

    // Escuchar el evento click en el botón de confirmación
    confirmDeleteBtn.addEventListener('click', function() {
      var confirmationInput = document.getElementById('delete-confirmation').value;
      if (confirmationInput === 'Eliminar') {
        // Enviar la solicitud de eliminación al servidor (aquí se puede implementar la lógica para eliminar la reserva en la base de datos)
        // Por simplicidad, mostramos un mensaje de alerta
        showAlert('Reserva eliminada correctamente', 'success');
        // Cerrar el cuadro de diálogo de confirmación
        $('#confirm-delete').modal('hide');
        // Recargar la página después de 3 segundos
        setTimeout(function() {
          location.reload();
        }, 2300);
      } else {
        showAlert('Por favor, escribe "Eliminar" para confirmar la acción', 'danger');
      }
    });

    // Función para mostrar una alerta en la parte superior del contenedor
    function showAlert(message, type) {
      var alertHTML = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                      message +
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">' +
                      '<span aria-hidden="true">&times;</span>' +
                      '</button>' +
                      '</div>';
      alertContainer.innerHTML = alertHTML;
    }
  </script>
</body>
</html>
