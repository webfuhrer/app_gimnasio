<?php require("funciones.php"); $accion=$_GET["accion"];
switch ($accion) {
    case "entreno_abierto":
        //Esto vale para entrenos de pierna, por ejemplo. O trotes o tal
        mostrarEntreno(0);//0 significa que se va a crear de forma manual
        break;
    case "historico":
 
        mostrarHistorico();
        break;
    case 'crear':
		crearBDTablas();//Aquí se verifica si existe BD y si no. lo crea
        crearEntreno();
        break;
    case 'registrar_entreno_hecho':
       $id_entreno=$_GET["id_entreno"];  //Hace falta para poder sacar el anterior       
       registrarEntrenoHecho($_POST, $id_entreno);
	   header("Location: index.html");//Para que no se quede en blanco la pantalla
        break;
    case 'nuevo_ejercicio':
	   obtenerEjercicios();
        break;
    case 'mostrar':
        //Si me dicen cuál, lo muestro, y si no, saco el siguiente  que toca
		crearBDTablas();//Aquí se verifica si existe BD y si no. lo crea
        $id_entreno=-1; //Valor por defecto. Se pone -1 porque el 0 es para el abierto. Ñapa por no planificar bien el código
        if (isset($_GET["id_entreno"])) {
            $id_entreno=$_GET["id_entreno"];
        } 
        mostrarEntreno($id_entreno);
        break;
    default:
        echo "Acción no válida.";
        break;
}
?>
   
