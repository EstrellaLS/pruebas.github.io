<?php
    class modelo_campos{
        private $bd;
        private $campo;

        public function __construct(){
            $this->bd=conectar::conexion();
        }

        public function sacar_id(){
            $consulta="SELECT AUTO_INCREMENT 
                        FROM information_schema.tables 
                        WHERE table_schema='portfolio' AND table_name='campos'";
            $sentencia=$this->bd->query($consulta);

            while($filas=$sentencia->fetch_assoc()){
                $this->proyecto[]=$filas;
            }
            $sentencia->close(); 
            return $this->proyecto;
        }

        public function insertar_campos($nombre,$activo,$logo){
            $consulta="INSERT INTO campos VALUES(null,?,?,?)";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("sss",$nombre,$activo,$logo);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function modificar_campo($id,$nombre,$activo,$logo){
            $consulta="UPDATE campos SET nombre=?,activo=?,logotipo=? WHERE id=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("sssi",$nombre,$activo,$logo,$id);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function buscar_campo($nombre){
            $consulta="SELECT nombre FROM campos WHERE nombre LIKE ?";
            $sentencia=$this->bd->prepare($consulta);
            $busqueda="%$nombre%";
            $sentencia->bind_param("s",$busqueda);
            $sentencia->bind_result($nom);
            $sentencia->execute();
            $sentencia->store_result();

            $i=0;
            while($fila=$sentencia->fetch()){
                $this->campo[$i]["nom"]=$nom;
                $i++;
            }
            $sentencia->close(); 
            return $this->campo;
        }

        public function ver_campos(){
            $consulta="SELECT id,nombre,logotipo FROM campos";
            $sentencia=$this->bd->query($consulta);
            while($filas=$sentencia->fetch_assoc()){
                $this->campo[]=$filas;
            }
            $sentencia->close(); 
            return $this->campo;   
        }

        public function __destruct(){
            $this->bd->close();
        }
    }
?>