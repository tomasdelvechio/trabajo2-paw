<?php

namespace App\model;

use App\model\Appointment;
use App\model\Appointment_List;

class Serialize {

    public function __construct()
    {
    }

    public function serializar($appointment) {
        $dir = __DIR__ . "\\appointmets.json";

        //CREO UNA LISTA DE TURNOS Y AGREGO EL CREADO
        $list = new Appointment_List();
        $list -> addAp($appointment);

        //OBTENGO LA LISTA DE TURNOS ALMACENADA EN EL ARCHIVO
        if (file_exists($dir)) {
            $file = file_get_contents($dir);

            if (!empty($file)){
                $json = json_decode($file, true);
                foreach ($json as $ap){
                    foreach($ap as $ap){
                        $newAp = new Appointment();
                        $newAp->setId($ap['id']);
                        $newAp->setNombre($ap['nombre']);
                        $newAp->setEmail($ap['email']);
                        $newAp->setTelefono($ap['telefono']);
                        $newAp->setEdad($ap['edad']);
                        $newAp->setTallaCalzado($ap['talla_calzado']);
                        $newAp->setAltura($ap['altura']);
                        $newAp->setFechaNacimiento($ap['fecha_nacimiento']);
                        $newAp->setColorPelo($ap['color_pelo']);
                        $newAp->setFechaTurno($ap['fecha_turno']);
                        $newAp->setHorarioTurno($ap['horario_turno']);
                        $newAp->setDiagnostico($ap['diagnostico']);
                        //AGREGO LOS TURNOS RECUPERADOS A LA LISTA
                        $list->addAp($newAp);
                    }
                }
            }
        }
        else {
            //crear archivo si no existe
        }

        $json_string = json_encode($list);
        var_dump($list);
        $arch = fopen ($dir, "w+");
        fwrite($arch, $json_string);
        fclose($arch);
    }

    public function getList() {
        $dir = __DIR__ . "\\appointmets.json";

        if (file_exists($dir)) {
            $file = file_get_contents($dir);
            $json = json_decode($file, true);
            return $json;
        }
        else {
            return null;
        }
        //return $file;
    }

}