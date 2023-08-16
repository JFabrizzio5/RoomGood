<?php
$host = "localhost";
$user = "root";
$password = "n0m3l0";
$dbname = "salas_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] === "addSala") {
            // Crear un nuevo registro en la base de datos
            $nombresala = $_POST["nombresala"];
            $capacidad = $_POST["capacidad"];
            $descripcionsala = $_POST["descripcionsala"];
            $ubicacion = $_POST["ubicacion"];

            $sql = "INSERT INTO salas (nombresala, capacidad, descripcionsala, ubicacion) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siss", $nombresala, $capacidad, $descripcionsala, $ubicacion);

            if ($stmt->execute()) {
                $response = array("status" => "success", "message" => "Sala agregada exitosamente.");
                echo json_encode($response);
            } else {
                $response = array("status" => "error", "message" => "Error al agregar la sala: " . $conn->error);
                echo json_encode($response);
            }

            $stmt->close();
            exit;
        } elseif ($_POST["action"] === "deleteSala") {
            // Eliminar un registro de la base de datos
            $salaId = $_POST["salaId"];

            $sql = "DELETE FROM salas WHERE id_sala = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $salaId);

            if ($stmt->execute()) {
                $response = array("status" => "success", "message" => "Sala eliminada exitosamente.");
                echo json_encode($response);
            } else {
                $response = array("status" => "error", "message" => "Error al eliminar la sala: " . $conn->error);
                echo json_encode($response);
            }

            $stmt->close();
            exit;
        }
    }
} else {
    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] === "getSalas") {
        // Leer registros de la base de datos
        $sql = "SELECT * FROM salas";
        $result = $conn->query($sql);

        $salas = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $salas[] = $row;
            }
        }

        echo json_encode($salas);
        exit;
    }

    // Cargar registros de salas al cargar la página
    $sql = "SELECT * FROM salas";
    $result = $conn->query($sql);

    $salas = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $salas[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD con AJAX y PHP</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            cargarRegistros();

            $("#formulario").submit(function(event) {
                event.preventDefault();

                var nombresala = $("#nombresala").val();
                var capacidad = $("#capacidad").val();
                var descripcionsala = $("#descripcionsala").val();
                var ubicacion = $("#ubicacion").val();

                $.ajax({
                    url: "",
                    method: "POST",
                    data: {
                        action: "addSala",
                        nombresala: nombresala,
                        capacidad: capacidad,
                        descripcionsala: descripcionsala,
                        ubicacion: ubicacion
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            alert(response.message);
                            cargarRegistros();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            setInterval(cargarRegistros, 5000); // Actualizar cada 5 segundos
        });

        function cargarRegistros() {
            $.ajax({
                url: "index.php?action=getSalas",
                method: "GET",
                dataType: "json",
                success: function(response) {
                    $("#tabla-salas tbody").empty();

                    for (var i = 0; i < response.length; i++) {
                        var sala = response[i];
                        var fila = "<tr>";
                        fila += "<td>" + sala.id_sala + "</td>";
                        fila += "<td>" + sala.nombresala + "</td>";
                        fila += "<td>" + sala.capacidad + "</td>";
                        fila += "<td>" + sala.descripcionsala + "</td>";
                        fila += "<td>" + sala.ubicacion + "</td>";
                        fila += "<td><button class='eliminar-btn' data-sala-id='" + sala.id_sala + "'>Eliminar registro</button></td>";
                        fila += "</tr>";

                        $("#tabla-salas tbody").append(fila);
                    }

                    // Agregar evento click a los botones de eliminar
                    $(".eliminar-btn").click(function() {
                        var salaId = $(this).data("sala-id");
                        eliminarRegistro(salaId);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function eliminarRegistro(salaId) {
            $.ajax({
                url: "",
                method: "POST",
                data: {
                    action: "deleteSala",
                    salaId: salaId
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        alert(response.message);
                        cargarRegistros();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
</head>
<body>
    <h1>CRUD con AJAX y PHP</h1>

    <h2>Agregar nueva sala:</h2>
    <form id="formulario" method="post">
        <label for="nombresala">Nombre de la sala:</label>
        <input type="text" id="nombresala" required>
        <br>

        <label for="capacidad">Capacidad:</label>
        <input type="number" id="capacidad" required>
        <br>

       <label for="descripcionsala">Descripción de la sala:</label>
        <input type="text" id="descripcionsala" required>
        <br>

        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" required>
        <br>

        <button type="submit">Agregar</button>
    </form>

    <h2>Lista de salas:</h2>
    <table id="tabla-salas">
        <thead>
            <tr>
                <th>ID Sala</th>
                <th>Nombre de la Sala</th>
                <th>Capacidad</th>
                <th>Descripción de la Sala</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($salas as $sala) {
                echo "<tr>";
                echo "<td>" . $sala['id_sala'] . "</td>";
                echo "<td>" . $sala['nombresala'] . "</td>";
                echo "<td>" . $sala['capacidad'] . "</td>";
                echo "<td>" . $sala['descripcionsala'] . "</td>";
                echo "<td>" . $sala['ubicacion'] . "</td>";
                echo "<td><button class='eliminar-btn' data-sala-id='" . $sala['id_sala'] . "'>Eliminar registro</button></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
