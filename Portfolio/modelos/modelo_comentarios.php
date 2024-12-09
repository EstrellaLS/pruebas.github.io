<?php
    class modelo_comentario{
        private $bd;
        private $comentario;

        public function __construct(){
            $this->bd=conectar::conexion();
        }

        public function insertar_comentario($socio,$proyecto,$fecha,$texto){
            $consulta="INSERT INTO comentario VALUES(?,?,?,?)";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("iiss",$socio,$proyecto,$fecha,$texto);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function borrar_comentario($idSocio,$idproyecto,$fechaCom){
            $consulta="DELETE FROM comentario WHERE socio=? AND proyecto=? AND fecha=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("iis",$idSocio,$idproyecto,$fechaCom);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function buscar_comentario_x_proyecto($idproyecto){
            $consulta="SELECT socios.id,socios.nombre,proyectos.nombre,fecha,texto 
                        FROM comentario,proyectos,socios 
                        WHERE proyecto=proyectos.id 
                        AND socio=socios.id 
                        AND proyecto=?
                        ORDER BY fecha DESC";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("i",$idproyecto);
            $sentencia->bind_result($idSoc,$socio,$proyecto,$fecha,$texto);
            $sentencia->execute();
            $sentencia->store_result();

            $i=0;
            while($fila=$sentencia->fetch()){
                $this->comentario[$i]["idSoc"]=$idSoc;
                $this->comentario[$i]["socio"]=$socio;
                $this->comentario[$i]["proyecto"]=$proyecto;
                $this->comentario[$i]["fecha"]=$fecha;
                $this->comentario[$i]["texto"]=$texto;
                $i++;
            }
            $sentencia->close(); 
            return $this->comentario;
        }

        public function ultims_comentarios(){
            $consulta="SELECT socios.nombre socio,proyectos.nombre proyecto,proyectos.foto foto,fecha,texto 
            FROM comentario,proyectos,socios 
            WHERE proyecto=proyectos.id 
            AND socio=socios.id  
            ORDER BY fecha DESC LIMIT 5";
            $sentencia=$this->bd->query($consulta);
            
            while($filas=$sentencia->fetch_assoc()){
                $this->comentario[]=$filas;
            }
            $sentencia->close(); 
            return $this->comentario;
        }

        public function ver_comentarios(){
            $consulta="SELECT socios.id idSoc, socios.nombre socio,proyectos.id idPro, proyectos.nombre proyecto,fecha,texto 
                    FROM comentario,proyectos,socios 
                    WHERE proyecto=proyectos.id 
                    AND socio=socios.id 
                    ORDER BY fecha DESC";
            $sentencia=$this->bd->query($consulta);
            while($filas=$sentencia->fetch_assoc()){
                $this->comentario[]=$filas;
            }
            $sentencia->close(); 
            return $this->comentario;            
        }

        public function comprobar_comentario($idSocio,$idproyecto){
            $consulta="SELECT socios.nombre,proyectos.nombre,fecha,texto 
                    FROM comentario,proyectos,socios 
                    WHERE proyecto=proyectos.id 
                    AND socio=socios.id 
                    AND socio=? 
                    AND proyecto=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("ii",$idSocio,$idproyecto);
            $sentencia->bind_result($socio,$proyecto,$fecha,$texto);
            $sentencia->execute();
            $sentencia->store_result();
            if($sentencia->affected_rows==0){              
                $this->respuesta=false; 
            }else{
                $this->respuesta=true;
            }
            $sentencia->close();
            return $this->respuesta;
        }

        public function __destruct(){
            $this->bd->close();
        }
    }
?>