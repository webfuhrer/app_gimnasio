<?php	
	$host = 'localhost';  // Dirección del servidor de la base de datos
    $usuario = 'root';    // Usuario de la base de datos
    $contrasena = '1234';     // Contraseña del usuario de la base de datos PWD root para el móvil
    $base_de_datos = 'gimnasio'; // Nombre de la base de datos

function mostrarHistorico()
{
    $sql="SELECT o.fecha, e.nombre AS nombre_ejercicio, GROUP_CONCAT(o.observaciones SEPARATOR '; ') AS observacion FROM t_observaciones_ejercicios o JOIN t_ejercicios e ON o.id_ejercicio = e.id GROUP BY o.fecha, e.nombre ORDER BY o.fecha DESC; ";
//De aquí quiero sacar un array asociativo con cada fehca, y dentro, con nombre y observacion
 $conexion=crearConexion();
	 // Consulta SQL para obtener los datos de la tabla t_ejercicios

$result = $conexion->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Crear un array para almacenar los resultados
   // $ejercicios = array();

    // Recorrer todos los resultados y agregar a la lista
    while($row = $result->fetch_assoc()) {
       if(isset($ejercicios[$row["fecha"]]))
       {
      //  echo 'Fecha:'.$row["fecha"] ;
        $obj=new stdClass();
         $obj->nombre=$row["nombre_ejercicio"];
         $obj->observacion=$row["observacion"];

       

        //Si existe ya ese array de esa fecha, le añado
        array_push( $ejercicios[$row["fecha"]], $obj);

       } 
       else
       {
        //Si no existe lo creo
        $ejercicios[$row["fecha"]]=array();
        $obj=new stdClass();
        $obj->nombre=$row["nombre_ejercicio"];
        $obj->observacion=$row["observacion"];

      

       //Si existe ya ese array de esa fecha, le añado
       array_push( $ejercicios[$row["fecha"]], $obj);
       }
    }

    print_r(json_encode($ejercicios));
} 
}
    function crearBDTablas()
{
	global 	$host,
    $usuario ,
    $contrasena ,
    $base_de_datos;
	 // Configuración de la conexión a la base de datos
   

    // Crear una nueva conexión MySQL
	try{
		
    $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);
	}
	catch  (mysqli_sql_exception $e){
    
		//Hay que crear la BD
		$sql = file_get_contents('CreaTabla.sql');
		$conn = new mysqli($host, $usuario, $contrasena);
		$conn->begin_transaction();
		// Ejecutar las consultas del archivo SQL
		if ($conn->multi_query($sql)) {
			echo "Las consultas se ejecutaron con éxito.";
			$conn->close();
		} else {
			echo "Error ejecutando las consultas: " . $conn->error;
		}
	
    }

}
function obtenerEjercicios()
{
	//Este devuelve un array de objetos ejercicio

	 $conexion=crearConexion();
	 // Consulta SQL para obtener los datos de la tabla t_ejercicios
$sql = "SELECT e.id, e.parte, e.nombre, o.observaciones FROM t_ejercicios e LEFT JOIN ( SELECT id_ejercicio, observaciones, fecha FROM t_observaciones_ejercicios o1 WHERE o1.fecha = ( SELECT MAX(o2.fecha) FROM t_observaciones_ejercicios o2 WHERE o2.id_ejercicio = o1.id_ejercicio ) ) AS o ON e.id = o.id_ejercicio; ";
$result = $conexion->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Crear un array para almacenar los resultados
    $ejercicios = array();

    // Recorrer todos los resultados y agregar a la lista
    while($row = $result->fetch_assoc()) {
        $ejercicios[] = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"],
            "parte" => $row["parte"],
            "observaciones" => $row["observaciones"]
        );
    }

    // Enviar los resultados como JSON
    header('Content-Type: application/json');  // Asegura que el tipo de contenido sea JSON
    echo trim(json_encode($ejercicios), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
} else {
    // Si no se encuentran resultados, devolver un arreglo vacío
    echo json_encode([]);
}

// Cerrar la conexión
$conexion->close();

}
// Función para obtener el array asociativo con todos los id_parte por cada parte
function obtenerIdParteAsociativo() {
    // Parámetros de conexión a la base de datos
global 	$host,
    $usuario ,
    $contrasena ,
    $base_de_datos;

    // Crear la conexión
    $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    // Verificar si hay un error en la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Consulta SQL
    $sql = "SELECT id, id_parte, parte FROM t_ejercicios";
    
    // Ejecutar la consulta
    $resultado = $conexion->query($sql);

    // Array para almacenar los resultados
    $arrayAsociativo = array();

    // Verificar si la consulta ha devuelto resultados
    if ($resultado->num_rows > 0) {
        // Iterar sobre los resultados y llenar el array asociativo
        while ($fila = $resultado->fetch_assoc()) {
            // Si la parte ya existe en el array, agregar el id_parte al array correspondiente
            if (isset($arrayAsociativo[$fila['parte']])) {
                $arrayAsociativo[$fila['parte']][] = $fila['id'];
            } else {
                // Si la parte no existe, crear un nuevo array con el id_parte
                $arrayAsociativo[$fila['parte']] = array($fila['id']);
            }
        }
    }

    // Cerrar la conexión
    $conexion->close();

    // Retornar el array asociativo
	//Resultado tiene un array asociativo con E, H, PT, ...
    return $arrayAsociativo;
}

// Llamar a la función y mostrar el resultado

function combinarArrays($pt, $e, $h, $n_pt, $n_e, $n_h, $n_ent) {
	//Se le pasa n_ent ,el numero de ejercicios totales es
	//la suma de  $n_pt, $n_e, $n_h
	//Así que el array debe medir  n_ent*($n_pt+ $n_e+ $n_h)
	$l= $n_ent*($n_pt+ $n_e+ $n_h);
    // Crear el array vacío donde vamos a almacenar los resultados
    $resultado = [];
    //Para que no salgan entrenos iguales(con las mismas combinaciones de e, pt y h..., desordeno los arrays de entrada)
	shuffle($pt);
	shuffle($e);
	shuffle($h);
	
    // Indices de los arrays para hacer el ciclo
    $index_pt = 0;
    $index_e = 0;
    $index_h = 0;
	//$l es la longitud total
    // Llenar el array hasta alcanzar la longitud l
	$l_aux=0;
    for ($i = 0; $l_aux < $l; $i++) {
        //Cojo n_e del array e. 
		$array_aux_e=array_slice($e,0, $n_e);
		//Quito los n_e del array $e y los pongo al final
		$e=reordenarArray($e, $n_e);
		 //Cojo n_h del array h. 
		$array_aux_h=array_slice($h,0, $n_h);
		//Quito los n_h del array $h y los pongo al final
		$h=reordenarArray($h, $n_h);
		 //Cojo n_p del array p. 
		$array_aux_pt=array_slice($pt,0, $n_pt);
		//Quito los n_pt del array $pt y los pongo al final
		$pt=reordenarArray($pt, $n_pt);
		
		$resultado=array_merge($resultado, $array_aux_e, $array_aux_h, $array_aux_pt);
		$l_aux=count($resultado);//Esto es lo que llevo
    }

    // Si hemos excedido la longitud l, cortamos el array
   
print_r($resultado);
    return $resultado;
}

function reordenarArray($e, $n_e) {
    // Cortamos los primeros n_e elementos y los almacenamos en un array
    $primeros = array_splice($e, 0, $n_e);
    
    // Añadimos los primeros n_e elementos al final del array original
    $e = array_merge($e, $primeros);
    
    return $e;
}


// Función para insertar los datos(el array) en la tabla t_entrenos_plantilla

// Función para insertar los datos en la tabla t_entrenos_plantilla
function insertarEntrenos($arrayEjercicios, $n_entrenos) {
   
global 	$host,
    $usuario ,
    $contrasena ,
    $base_de_datos;
    // Crear la conexión
    $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    // Verificar si hay un error en la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Obtener el último id_entreno registrado en la base de datos
    $sql = "SELECT MAX(id_entreno) AS ultimo_entreno FROM t_entrenos_plantilla";
    $resultado = $conexion->query($sql);

    if ($resultado === false) {
        die("Error al obtener el último id_entreno: " . $conexion->error);
    }

    $row = $resultado->fetch_assoc();
    $ultimo_id_entreno = $row['ultimo_entreno']; // El último id_entreno

    // Si no existen entrenos previos, empezamos con el id_entreno 1
    if ($ultimo_id_entreno === null) {
        $id_entreno = 1;
    } else {
        // Si ya existen entrenos, incrementamos el último id_entreno
        $id_entreno = $ultimo_id_entreno + 1;
    }

    // Calcular cuántos ejercicios por entreno
    $totalEjercicios = count($arrayEjercicios);
    $ejerciciosPorEntreno = ceil($totalEjercicios / $n_entrenos); // Redondear hacia arriba

    // Preparar la consulta SQL para insertar
    $sql = "INSERT INTO t_entrenos_plantilla (id_ejercicio, id_entreno, fecha_creacion) VALUES (?, ?, NOW())";

    // Preparar la sentencia
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("ii", $id_ejercicio, $id_entreno);

    // Dividir los ejercicios y asignarles un id_entreno
    $ejercicioIndex = 0;

    // Iterar sobre los entrenos
    for ($entreno = 1; $entreno <= $n_entrenos; $entreno++) {
        // Obtener los ejercicios para este entreno
        $ejerciciosDelEntreno = array_slice($arrayEjercicios, $ejercicioIndex, $ejerciciosPorEntreno);
        
        // Insertar los ejercicios en la base de datos para este id_entreno
        foreach ($ejerciciosDelEntreno as $id_ejercicio) {
            $stmt->execute();
        }
        
        // Actualizar el índice para el siguiente entreno
        $ejercicioIndex += $ejerciciosPorEntreno;

        // Incrementar el id_entreno para el siguiente grupo de ejercicios
        $id_entreno++;
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conexion->close();

    echo "Datos insertados correctamente.";
}
//Ejemplo real:
function crearEntreno()
{
$ne=2;
$npt=1;
$nh=1;
$n_ent=3;
$n_ej_dia=4;
//1-Obtengo el array asociativo (E, PT, H...)
$ejercicios=obtenerIdParteAsociativo();
//2-Obtengo el array de TODOS los ejercicios necesarios
//combinarArrays($pt, $e, $h, $n_pt, $n_e, $n_h, $l)
$arrayEjercicios=combinarArrays($ejercicios['PT'], $ejercicios['E'],$ejercicios['H'], $npt, $ne, $nh, $n_ent);
echo("El array de ejercicios tiene ".count($arrayEjercicios)." elementos");

//3-lOS METO EN t_entrenos_plantilla
 insertarEntrenos($arrayEjercicios,$n_ent) ;
}
function mostrarEntreno($id_entreno)
{
    if($id_entreno==0)
    {
        $resultado=null;
      //  require("muestratabla.php");
    }
global 	$host,
    $usuario ,
    $contrasena ,
    $base_de_datos;

// Crear la conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar si hay un error en la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
if ($id_entreno === -1)
{
    $id_entreno=devolverSiguienteEntreno();
    echo "Devuelto el siguiente entreno: ".$id_entreno;
}

		
$sql=consultarObservaciones($id_entreno);//Aquí van los ejercicios, las observaciones, el id_entreno...el nombre es poco afortunado

// Ejecutar la consulta
$resultado = $conexion->query($sql);

require("muestratabla.php");

// Cerrar la conexión
$conexion->close();
}

function insertarEntrenoHecho($id_entreno) {
    // Configuración de la conexión a la base de datos
global 	$host,
    $usuario ,
    $contrasena ,
    $base_de_datos;
    // Crear una nueva conexión MySQL
    $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    // Comprobar si hubo un error en la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar los datos en t_entrenos_hechos
    $stmt = $conn->prepare("INSERT INTO t_entrenos_hechos (id_ent, fecha) VALUES (?, NOW())");

    // Comprobar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Enlazar los parámetros de la consulta
    // 'i' es para enteros (id_entreno, id_ejercicio), 's' es para una cadena (observacion)
    $stmt->bind_param("i", $id_entreno);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Entreno hecho insertado correctamente.";
    } else {
        echo "Error al insertar el entreno hecho: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
function registrarEntrenoHecho($datos_post, $id_entreno)
{

    insertarEntrenoHecho($id_entreno);
	// Verificar si se enviaron datos desde el formulario

    // Recorrer el arreglo $_POST para obtener todas las observaciones
    foreach ($datos_post as $key => $value) {
        // Filtrar las claves que empiezan con 'obs'
        if (strpos($key, 'obs') === 0) {
            $id = substr($key, 3);  // Obtener el número que sigue a 'obs' (por ejemplo, 1 de 'obs1')
            $observacion = $value;  // Obtener la observación del campo
            
            // Aquí puedes hacer lo que necesites con el id y la observación
            //echo "Observación para el ejercicio con ID $id: $observacion <br>";
			insertarObservacion($id, $observacion );
        }
    }
}
function devolverSiguienteEntreno()
{  global 	$host,
    $usuario ,
    $contrasena ,
    $base_de_datos;
    $sql="WITH ultimo_entreno AS ( SELECT id_ent AS id_ultimo_entreno FROM t_entrenos_hechos ORDER BY fecha DESC LIMIT 1 ), siguiente_entreno AS ( SELECT id_entreno FROM t_entrenos_plantilla WHERE id_entreno > (SELECT id_ultimo_entreno FROM ultimo_entreno) ORDER BY id ASC LIMIT 1 ) SELECT CASE WHEN (SELECT id_entreno FROM siguiente_entreno) IS NOT NULL THEN (SELECT id_entreno FROM siguiente_entreno) ELSE (SELECT MIN(id_entreno) FROM t_entrenos_plantilla) END AS proximo_entreno;";
    $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);
    

    // Comprobar si hubo un error en la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    $resultado = $conn->query($sql);
    $proximo_entreno=1;
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        //echo $fila;
        $proximo_entreno= $fila["proximo_entreno"]; 
        }
   
        $conn->close();
        return $proximo_entreno;

}
    
function insertarObservacion($id_ejercicio, $observacion) {
    echo "Insertando observación para el ejercicio con ID $id_ejercicio: $observacion <br>";
    // Configuración de la conexión a la base de datos
   global 	$host,
    $usuario ,
    $contrasena ,
    $base_de_datos;
    // Crear una nueva conexión MySQL
    $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    // Comprobar si hubo un error en la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    

    // Preparar la consulta SQL para insertar la observación
    $stmt = $conn->prepare("INSERT INTO t_observaciones_ejercicios (id_ejercicio, observaciones) VALUES (?, ?)");

    // Comprobar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Enlazar los parámetros de la consulta
    // 'i' es para un entero (id_ejercicio), 's' es para una cadena (observacion)
    $stmt->bind_param("is", $id_ejercicio, $observacion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Observación insertada correctamente.";
    } else {
        echo "Error al insertar la observación: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
function consultarObservaciones($id_entreno) {
	//Si me pasan un $id_entreno que se pasa, lo cambio a 1.
	$id_entreno=comprobarIdEntrenoExiste($id_entreno);//Devuelve el id_entreno pedid, si existe, o 1 si no
    $sql="SELECT tp.id_entreno ,ej.parte, ej.nombre,ej.id as id_ejercicio,  obs.observaciones, obs.fecha FROM t_entrenos_plantilla tp JOIN t_ejercicios ej ON tp.id_ejercicio = ej.id LEFT JOIN ( SELECT id_ejercicio, MAX(fecha) AS ultima_fecha FROM t_observaciones_ejercicios GROUP BY id_ejercicio ) ult_obs ON tp.id_ejercicio = ult_obs.id_ejercicio LEFT JOIN t_observaciones_ejercicios obs ON ult_obs.id_ejercicio = obs.id_ejercicio AND ult_obs.ultima_fecha = obs.fecha WHERE tp.id_entreno = ".$id_entreno; 
return $sql;
}
function comprobarIdEntrenoExiste($id_entreno)
{global 	$host,
    $usuario ,
    $contrasena ,
    $base_de_datos;
	$conexion=crearConexion();
	$sql="SELECT MAX(id_entreno) as max_id FROM t_entrenos_plantilla";
	$resultado =$conexion->query($sql);
	if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        //echo $fila;
        $maximo= $fila["max_id"]; // Imprime cada fila obtenida
		if($id_entreno>$maximo)
		{
			return 1;
        }
		else
		{
			return $id_entreno;
		}
	}
	
}
function crearConexion()
{
	 
global 	$host,
    $usuario ,
    $contrasena ,
    $base_de_datos;
    // Crear una nueva conexión MySQL
    $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    // Comprobar si hubo un error en la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
	return $conn;
}
//SELECT MAX(id_entreno) FROM `t_entrenos_plantilla`
?>