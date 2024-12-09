<?php
    class modelo_socios{
        private $bd;
        private $socio;

        public function __construct(){
            $this->bd=conectar::conexion();
        }

        public function insertar_socios($nombre,$nick,$pass){
            $consulta="INSERT INTO socios VALUES(null,?,?,?,'1')";
            $sentencia=$this->bd->prepare($consulta);     
            $pss=encriptar($pass);
            $sentencia->bind_param("sss",$nombre,$nick,$pss);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function modificar_socio($id,$nombreN,$nickN,$pass1,$pass2){     
            $consulta="SELECT pass FROM socios WHERE id=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("i",$id);
            $sentencia->bind_result($pssBD);
            $sentencia->execute();
            $sentencia->fetch();
            
            //Para que el admin pueda modificar sin tocar la pssw
            if($pass1==="" || $pass1===null || $pass1!=$pass2){
                $contrasenia=$pssBD;
            }else{
                $ModCodificada=encriptar($pass1);
                if($ModCodificada===$pssBD){
                    $contrasenia=$pssBD;
                }else{                   
                    $contrasenia=$ModCodificada;
                }
            }
            $sentencia->close();
            
            $consulta="UPDATE socios SET nombre=?,nick=?,pass=? WHERE id=? AND activo='1'";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("sssi",$nombreN,$nickN,$contrasenia,$id);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function desactivar_socio($id){
            //Evitar la posibilidad de desactivar al administrador
            $consulta="UPDATE socios SET activo='0' WHERE id=? AND id!=0";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("i",$id);
            $sentencia->execute();
            $sentencia->close(); 
        }

        public function buscar_socio_nom($nombre){
            $consulta="SELECT id,nombre,nick,pass FROM socios WHERE nombre LIKE ? AND activo='1'";
            $sentencia=$this->bd->prepare($consulta);
            $busqueda="%$nombre%";
            $sentencia->bind_param("s",$busqueda);
            $sentencia->bind_result($id,$nom,$nick,$pass);
            $sentencia->execute();
            $sentencia->store_result();

            $i=0;
            while($fila=$sentencia->fetch()){
                $this->socio[$i]["id"]=$id;
                $this->socio[$i]["nom"]=$nom;
                $this->socio[$i]["nick"]=$nick;
                $this->socio[$i]["pass"]=$pass;
                $i++;
            }
            $sentencia->close(); 
            return $this->socio;
        }

        public function login_socio($nick,$pass){
            $passCod=encriptar($pass);
            $consulta="SELECT id FROM socios WHERE nick=? AND pass=?";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("ss",$nick,$passCod);
            $sentencia->bind_result($idRec);
            $sentencia->execute();
            $sentencia->store_result();
            
            if($sentencia->num_rows==1){
                while($filas=$sentencia->fetch()){
                    $id=$idRec;
                }
                return $id;
            }else{
                return (-1);
            }
            $sentencia->close();
        }

        public function ver_socios(){            
            $consulta="SELECT id,nombre,nick,pass FROM socios WHERE activo='1'";
            $sentencia=$this->bd->query($consulta);

            while($filas=$sentencia->fetch_assoc()){
                $this->proyecto[]=$filas;
            }
            $sentencia->close(); 
            $activos=$this->proyecto;
            $this->proyecto=[];

            $consulta="SELECT id,nombre,nick,pass FROM socios WHERE activo='0'";
            $sentencia=$this->bd->query($consulta);

            while($filas=$sentencia->fetch_assoc()){
                $this->proyecto[]=$filas;
            }
            $sentencia->close(); 
            $noActivos=$this->proyecto;

            $titulares=["activos","desactivados"];
            $todos=[$activos,$noActivos,$titulares];
            return $todos;
        }        

        public function ver_socio($id){
            $consulta="SELECT nombre,nick,pass FROM socios WHERE id=? AND activo='1'";
            $sentencia=$this->bd->prepare($consulta);
            $sentencia->bind_param("i",$id);
            $sentencia->bind_result($nom,$nick,$pss);
            $sentencia->execute();
            $sentencia->store_result();

            $i=0;
            while($fila=$sentencia->fetch()){
                $this->socio[$i]["nom"]=$nom;
                $this->socio[$i]["nick"]=$nick;
                $this->socio[$i]["pss"]=$pss;
                $i++;
            }
            $sentencia->close(); 
            return $this->socio;
        }

        public function __destruct(){
            $this->bd->close();
        }
    }
?>