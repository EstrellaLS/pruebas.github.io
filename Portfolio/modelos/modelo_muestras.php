<?php
    class modelo_muestra{
        private $bd;
        private $muestra;

        public function __construct(){
            $this->bd=conectar::conexion();
        }
        
        public function sacar_id(){
            $consulta="SELECT AUTO_INCREMENT 
                        FROM information_schema.tables 
                        WHERE table_schema='portfolio' AND table_name='muestras'";
            $sentencia=$this->bd->query($consulta);

            while($filas=$sentencia->fetch_assoc()){
                $this->proyecto[]=$filas;
            }
            $sentencia->close(); 
            return $this->proyecto;
        }

        public function insertar_muestra($proyecto,$campo,$fecha){
            $consulta="INSERT INTO muestras VALUES(?,?,?)";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("iis",$proyecto,$campo,$fecha);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function modificar_muestra($proyecto,$campo,$fecha){
            $consulta="UPDATE muestras SET fecha=? WHERE proyecto=? AND campo=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("sii",$fecha,$proyecto,$campo);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function borrar_muestra($proyecto,$campo){
            $consulta="DELETE FROM muestras WHERE proyecto=? AND campo=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("ii",$proyecto,$campo);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function buscar_muestra($idproyecto,$idcampo){
            $consulta="SELECT fecha FROM muestras WHERE proyecto=? AND campo=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("ii",$idproyecto,$idcampo);
            $sentencia->bind_result($fechaBD);
            $sentencia->execute();
            $sentencia->store_result();
            if($sentencia->num_rows==0){              
                return false;
            }else{
                return true;
            }
            $sentencia->close();
        }

        public function buscar_muestra_x_proyecto($idproyecto){
            $consulta="SELECT nombre,fecha FROM campos,muestras WHERE campo=id AND proyecto=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("i",$idproyecto);
            $sentencia->bind_result($campo,$fecha);
            $sentencia->execute();
            $sentencia->store_result();

            $i=0;
            while($fila=$sentencia->fetch()){
                $this->muestra[$i]["campo"]=$campo;
                $this->muestra[$i]["fecha"]=$fecha;
                $i++;
            }
            $sentencia->close(); 
            return $this->muestra;
        }

        public function buscar_muestra_x_camp($idcamp){
            $consulta="SELECT campos.nombre,proyectos.id,proyectos.nombre,foto,fecha 
                        FROM proyectos,muestras,campos 
                        WHERE proyecto=proyectos.id 
                        AND campo=campos.id
                        AND campo=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("i",$idcamp);
            $sentencia->bind_result($campo,$idproyecto,$proyecto,$foto,$fecha);
            $sentencia->execute();
            $sentencia->store_result();

            $i=0;
            while($fila=$sentencia->fetch()){
                $this->muestra[$i]["campo"]=$campo;
                $this->muestra[$i]["idproyecto"]=$idproyecto;
                $this->muestra[$i]["proyecto"]=$proyecto;
                $this->muestra[$i]["foto"]=$foto;
                $this->muestra[$i]["fecha"]=$fecha;
                $i++;
            }
            $sentencia->close(); 
            return $this->muestra;
        }

        public function ultims_muestras($idcamp){
            $consulta="SELECT proyectos.nombre,fecha,foto
                        FROM campos,proyectos,muestras 
                        WHERE campo=campos.id 
                        AND proyecto=proyectos.id 
                        AND campo=? 
                        ORDER BY fecha ASC LIMIT 4";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("i",$idcamp);
            $sentencia->bind_result($proyecto,$fecha,$foto);
            $sentencia->execute();
            $sentencia->store_result();

            $i=0;
            while($fila=$sentencia->fetch()){
                $this->muestra[$i]["proyecto"]=$proyecto;
                $this->muestra[$i]["fecha"]=$fecha;
                $this->muestra[$i]["foto"]=$foto;
                $i++;
            }
            $sentencia->close(); 
            return $this->muestra;
        }

        public function ver_proyectos_x_camp($idcamp){
            $consulta="SELECT id,nombre,foto,fecha FROM proyectos,muestras WHERE proyecto=id AND campo=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("i",$idcamp);
            $sentencia->bind_result($idproyecto,$proyecto,$foto,$fecha);
            $sentencia->execute();
            $sentencia->store_result();

            $i=0;
            while($fila=$sentencia->fetch()){
                $this->muestra[$i]["idproyecto"]=$idproyecto;
                $this->muestra[$i]["proyecto"]=$proyecto;
                $this->muestra[$i]["foto"]=$foto;
                $this->muestra[$i]["fecha"]=$fecha;
                $i++;
            }
            $sentencia->close(); 
            return $this->muestra;
        }

        public function ver_muestras(){
            $consulta="SELECT campos.nombre campo, logotipo, proyectos.nombre proyecto, foto, descripcion, fecha 
            FROM campos,proyectos,muestras 
            WHERE campo=campos.id 
            AND proyecto=proyectos.id
            ORDER BY fecha DESC";
            $sentencia=$this->bd->query($consulta);
            while($filas=$sentencia->fetch_assoc()){
                $this->muestra[]=$filas;
            }
            $sentencia->close(); 
            return $this->muestra;
        }

        public function __destruct(){
            $this->bd->close();
        }
    }
?>