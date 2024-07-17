<?php 
    namespace App\Util;

    final class Msg {
        CONST  DNI_NO_ENCONTRADO = "Numero de DNI no encontrado";
        CONST  SERVICIO_CAIDO    = "No se logra la conexion al servicio, ingresar manual sus datos";
        CONST  REG_ACTUALIZADO   = "Registro Actualizado con exito";
        CONST  REG_SIN_CAMBIO    = "Sin cambios en la base de datos";
    }

    final class Fecha {
        public static function getNombreMes($numero){
            $mes='';
            switch ($numero) {
                case 1: $mes='ENERO'; break;
                case 2:$mes='FEBRERO';break;
                case 3:$mes='MARZO';break;
                case 4:$mes='ABRIL';break;
                case 5:$mes='MAYO';break;
                case 6:$mes='JUNIO';break;
                case 7:$mes='JULIO';break;
                case 8:$mes='AGOSTO';break;
                case 9:$mes='SEPTIEMBRE';break;
                case 10:$mes='OCTUBRE';break;
                case 11:$mes='NOVIEMBRE';break;
                case 12:$mes='DICIEMBRE';break;
            }

            return $mes;

        }
    }