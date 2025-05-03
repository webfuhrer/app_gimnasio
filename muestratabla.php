
<!DOCTYPE html>
<html lang="en">
<head>
<script>
   var combo_ejercicios="";//Se pone como global para que se pueda usar en la función tratarJSON, haciendo la petición solo una vez
var lista_observaciones=[];//Lista de observaciones que se van a ir añadiendo al combo de ejercicios
   function crearCampoObservaciones(id_ejercicio, combo)
{
    //Se trata de poner "obsX" al input hermano del select, donde X es el id del ejercicio
    var input = combo.parentNode.nextElementSibling.querySelector("input");
    input.name = "obs" + id_ejercicio;
    input.value= lista_observaciones[id_ejercicio];//Se le pone el valor de la observación que ya tiene
    
}
function insertarComboEnTabla()
{
    //alert("Pidiendo...");
    if(combo_ejercicios!=""){
//Creo el combo como hijo de la fila
        var td_combo = document.createElement("td");
        td_combo.innerHTML=combo_ejercicios;
        var td_input=document.createElement("td");
        td_input.innerHTML="<input type='text' name='obs'>";//Se le pondrá name cuando se seleccione un ejercicio
        var tr = document.createElement("tr");
        tr.appendChild(td_combo);
        tr.appendChild(td_input);
        document.getElementsByTagName("table")[0].appendChild(tr);
    }
}
   function pedirEjercicios()
 
 {
   if (combo_ejercicios!="")
    {
	insertarComboEnTabla();
    }
    else
    {

            //Esta función es para añadir ejercicios
            var xhr = new XMLHttpRequest();
            
            // Definir la URL y el parámetro GET
            var url = "./index.php?accion=nuevo_ejercicio";
            
            // Abrir la petición GET
            xhr.open("GET", url, true);
            
            // Establecer la función que se ejecutará cuando la petición sea completada
            xhr.onload = function() {
                console.log(xhr.readyState+" "+xhr.status);
                if (xhr.status === 200) {
                    // Si la respuesta es exitosa (código 200), muestra la respuesta en consola
                    txt = xhr.responseText.trim();
                 //   alert(txt);
                    var response = JSON.parse(txt);
                    tratarJSON(response);
                } else {
                    // Si ocurre un error, muestra el error
                    console.error("Error en la petición: " + xhr.status);
                }
            };
            xhr.send();
    }
}

function tratarJSON(obj_json)
{
	 try {
                // Parsear la respuesta JSON
            console.log("Parseando");   
                
                // Verificar si la respuesta contiene un array
                combo_ejercicios= "<select name='ejercicio' onchange='crearCampoObservaciones(this.value, this);' >";
                combo_ejercicios+= "<option value='X'>Selecciona un ejercicio</option>";
                if (Array.isArray(obj_json)) {
                    // Recorrer el array y mostrar cada objeto
                    obj_json.forEach(function(item) {
                        /*console.log("ID: " + item.id);
                        console.log("Nombre: " + item.nombre);
                        console.log("Parte: " + item.parte);
                        */
                   
                            combo_ejercicios+= "<option value='" +item.id+ "'>" +item.nombre+ "(" +item.parte+ ")</option>";
                            lista_observaciones[item.id]=item.observaciones;
                       
                       
                    });
                    combo_ejercicios+= "</select>";
                } else {
                    console.error("La respuesta no es un array.");
                }
            } catch (e) {
                // Si hay un error al parsear el JSON
                console.error("Error al parsear JSON: ", e);
            }
            insertarComboEnTabla();
}
function grabarEntreno()
{
    //alert("Grabar entreno");
    var form = document.querySelector("form");
    if (confirm("¿Estás seguro de que quieres grabar el entrenamiento?")) {
        // Si el usuario confirma, se envía el formulario
        form.submit();
    } else {
        // Si el usuario cancela, no se hace nada
        return;
    }
    
    
}
</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Muestra Tabla</title>
    <style>
        /* Basic styling for the body */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Container for the page content */
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Make the table scrollable on smaller screens */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Styling for mobile screens */
        @media (max-width: 600px) {
            table th, table td {
                padding: 6px 8px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        
        <!-- Table responsive wrapper -->
        <div class="table-responsive">
		
           
<?php
 echo "<h3>ID del entrenamiento: " . $id_entreno . "</h3>";

 // Iniciar la tabla HTML dentro de un formulario

 echo "<form method='POST' action='index.php?accion=registrar_entreno_hecho&id_entreno=$id_entreno'>";
 echo "<table border='1'>";

// Verificar si se obtuvieron resultados
if ($resultado!=null && $resultado->num_rows > 0) {
    // Mostrar el ID del entrenamiento antes de la tabla
    $row = $resultado->fetch_assoc(); // Obtener el primer resultado
    $id_entreno = $row['id_entreno']; //  'id_entreno' es el ID del entrenamiento

   
    echo "<tr><th>Nombre </th><th>Observaciones</th></tr>";
	
    // Mostrar los resultados en la tabla (ahora continuamos con los ejercicios)
    do {
		
        echo "<tr>";
        echo "<td>" . $row["id_ejercicio"]." -".$row['nombre'] . "</td>";
       // echo "<td>" . $row['parte'] . "</td>";
        echo "<td><input type='text' name='obs".$row['id_ejercicio']."' value='".$row['observaciones']."'></td>";
        echo "</tr>";
		
    } while ($row = $resultado->fetch_assoc()); // Continuar obteniendo las siguientes filas
	//En esta fila meto para añadir
	echo "<tr>";
        echo "<td colspan=2>";
       
        echo"<p onclick='pedirEjercicios();'>Nuevo ejercicio</p></td>";
       // echo "<td>" . $row['parte'] . "</td>";
       // echo "<td><input type='text' name='obs".$row['id_ejercicio']."' value='".$row['observaciones']."'></td>";
        echo "</tr>";
    
} else {

     echo"<p onclick='pedirEjercicios();'>Nuevo ejercicio</p></td>";
}



// Cerrar la tabla HTML y agregar un botón de envío
echo "</table>";
	
echo "<input type=button onclick='grabarEntreno()' value='Grabar'>";
echo "</form>";
echo "<a href='index.php?accion=mostrar&id_entreno=".($id_entreno-1)."'>Anterior</a>";
echo "<a href='index.php?accion=mostrar&id_entreno=".($id_entreno+1)."'>Siguiente</a>";


?>
		   
        </div>
        <a href="index.html">Volver a la página principal</a>
    </div>

</body>
</html>
