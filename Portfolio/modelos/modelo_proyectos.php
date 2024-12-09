<?php
    class modelo_proyectos{
        private $bd;
        private $proyecto;

        public function __construct(){
            $this->bd=conectar::conexion();
        }

        public function sacar_id(){
            $consulta="SELECT AUTO_INCREMENT 
                        FROM information_schema.tables 
                        WHERE table_schema='portfolio' AND table_name='proyectos'";
            $sentencia=$this->bd->query($consulta);

            while($filas=$sentencia->fetch_assoc()){
                $this->proyecto[]=$filas;
            }
            $sentencia->close(); 
            return $this->proyecto;
        }

        public function insertar_proyectos($nombre,$descrip,$foto,$activo){
            $consulta="INSERT INTO proyectos VALUES(null,?,?,?,?)";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("ssss",$nombre,$descrip,$foto,$activo);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function modificar_proyecto($id,$nombre,$descrip,$foto){
            $consulta="UPDATE proyectos SET nombre=?,descripcion=?,foto=? WHERE id=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("sssi",$nombre,$descrip,$foto,$id);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function desactivar_proyecto($id){
            $consulta="UPDATE proyectos SET activo='0' WHERE id=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("i",$id);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function buscar_proyecto_nom($nombre){
            $consulta="SELECT nombre,descripcion,foto FROM proyectos WHERE nombre LIKE ?";
            $sentencia=$this->bd->prepare($consulta);
            $busqueda="%$nombre%";
            $sentencia->bind_param("s",$busqueda);
            $sentencia->bind_result($nom,$desc,$img);
            $sentencia->execute();
            $sentencia->store_result();

            $i=0;
            while($fila=$sentencia->fetch()){
                $this->proyecto[$i]["nom"]=$nom;
                $this->proyecto[$i]["desc"]=$desc;
                $this->proyecto[$i]["img"]=$img;
                $i++;
            }
            $sentencia->close(); 
            return $this->proyecto;
        }

        public function buscar_proyecto_id($id){
            $consulta="SELECT nombre,descripcion,foto FROM proyectos WHERE id=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("s",$id);
            $sentencia->bind_result($nom,$desc,$img);
            $sentencia->execute();
            $sentencia->store_result();

            $i=0;
            while($fila=$sentencia->fetch()){
                $this->proyecto[$i]["nom"]=$nom;
                $this->proyecto[$i]["desc"]=$desc;
                $this->proyecto[$i]["img"]=$img;
                $i++;
            }
            $sentencia->close(); 
            return $this->proyecto;
        }

        public function ver_proyectos(){
            $consulta="SELECT id,nombre,descripcion,foto FROM proyectos WHERE activo='1'";
            $sentencia=$this->bd->query($consulta);

            while($filas=$sentencia->fetch_assoc()){
                $this->proyecto[]=$filas;
            }
            $sentencia->close(); 
            return $this->proyecto;
        }

        public function ver_proyectos_admin(){
            $consulta="SELECT id,nombre,descripcion,foto,activo FROM proyectos";
            $sentencia=$this->bd->query($consulta);

            while($filas=$sentencia->fetch_assoc()){
                $this->proyecto[]=$filas;
            }
            $sentencia->close(); 
            return $this->proyecto;
        }

        public function __destruct(){
            $this->bd->close();
        }
    }
?>