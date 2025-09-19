<?php
require("classes/conn.class.php");
require("classes/validaciones.inc.php");

class estudiante
{
    public $idestudiante;
    public $fechanacimiento;
    public $estadoregistroestudiante;
    public $idgenero;
    public $conexion;
    public $validacion;

    public function __construct()
    {
        $this->conexion = new DB();
        $this->validacion = new validaciones();
    }
    //SETTER DE LA VARIABLE IdEstudiante
    public function setIdEstudiante($idestudiante)
    {
        $this->idestudiante = $idestudiante;
    }
     //GETTER DE LA VARIABLE IdEstudiante
    public function getIdEstudiante()
    {
        return $this->idestudiante;
    }
     //SETTER DE LA VARIABLE FechaNacimiento
      public function setFechaNacimiento($FechaNacimiento)
    {
        $this->FechaNacimiento = $FechaNacimiento;
    }
    //GETTER DE LA VARIABLE FechaNacimiento
    public function getFechaNacimiento()
    {
        return $this->FechaNacimiento;
    }
     //SETTER DE LA VARIABLE EstadoRegistroEstudiante
      public function setEstadoRegistroEstudiante($EstadoRegistroEstudiante)
    {
        $this->EstadoRegistroEstudiante = $EstadoRegistroEstudiante;
    }
    //GETTER DE LA VARIABLE EstadoRegistroEstudiante
    public function getEstadoRegistroEstudiante()
    {
        return $this->EstadoRegistroEstudiante;
    }
     //SETTER DE LA VARIABLE IdGenero
    public function setIdGenero($IdGenero)
    {
        $this->IdGenero = $IdGenero;
    }
    //GETTER DE LA VARIABLE IdGenero
    public function getIdGenero()
    {
        return $this->IdGenero;
    }

    //METODO PARA OBTENER TODOS LOS ESTUDIANTES
    public function obtenerEstudiantes()
    {
        $resultado = $this->conexion->run('SELECT * FROM estudiante;');
        $array = array("mensaje"=>"Registro encontrado","data"=>$resultado->fetchAll());
        return $array;
    }

    //METODO PARA OBTENER UN ESTUDIANTE
    public function obtenerEstudiante(int $idestudiante)
    {
        if($idestudiante > 0)
        {
            $resultado = $this->conexion->run('SELECT * FROM estudiante WHERE id_estudiante=' .$idestudiante);
            $array = array("mensaje"=>"Registros encontrado","data"=>$resultado->fetch());
            return $array;
        }
        else
        {
            $array = array("mensaje"=>"Registros NO  encontrado, identificador incorrecto","data"=>"");
            return $array;
        }
    }

    public function nuevoEstudiante($fechanacimiento,$idgenero)
    {
        if(!empty($idgenero) && !empty($fechanacimiento))
        {
            //VARIABLE DE TIPOS ARRAY PARA ENVIAR PARAMETROS A LA BASE DE DATOS
            $parametros = array
            (
                "fecha_nac" => $fechanacimiento,
                "id_genero" => $idgenero
            );

            $resultado = $this->conexion->run('INSERT INTO estudiante(fecha_nacimiento_estudiante, id_Genero)VALUES(:fecha_nac,:id_genero):', $parametros);
            if($this->conexion->n > 0 and $this->conexion->id > 0)
            {
                $resultado = $this-> obtenerEstudiante($this->conexion->id);
                $array = array("mensaje"=>"Registros encontrado","data"=>$resultado["data"]);
                return $array;
            }
            else
            {
                $array = array("mensaje"=>"Hubo un problema al registrar el estudiante","data"=>"");
                return $array;
            }
        }
        else
        {
            $array = array("mensaje"=>"Parametros enviados vacios","data"=>"");
            return $array;
        }
    }

}

?>