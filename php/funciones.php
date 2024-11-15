<?php
    function conectar(){
        $conexion=new mysqli("localhost","root","","inmobiliaria");
        $conexion->set_charset("utf8");	
        return $conexion;
    }

    function comprobar_usuario(){
        session_start();
        if (isset($_SESSION["sesiUser"])){
            return $_SESSION["sesiUser"];

        }elseif (isset($_COOKIE["cookiUser"])){
            $galleta = $_COOKIE["cookiUser"];            
            session_decode($galleta);
            return $_SESSION["sesiUser"];

        }else{
            return (-1);
        }
    }

    function encriptar($psswrd){
        $enc=md5(md5($psswrd));
        return $enc;
    }

    function ordenarFecha($fechaIn){
        $marca=strtotime($fechaIn);
        $fechaOut=date("d-m-Y",$marca);
        return $fechaOut;
    }

    function sacar_nombre($idUser){
        $conexion=conectar();
        $consulta="SELECT nombre_usuario FROM clientes WHERE id=$idUser";
        $sentencia=conectar()->query($consulta);
        $nombre=$sentencia->fetch_array();
        return $nombre;
    }

    function pintarHeader($usuario){   
        $nom=sacar_nombre($usuario);    

        if($usuario==0){//Es Admin
            echo"<header id='cabecera'>
                <div>
                    <a href='../index.php'>
                        <img src='../assets/icono.png' alt='Icono de la inmobiliaria.'>
                    </a>
                    <nav>
                        <ul class='enlaces'>
                            <li><a href='../index.php'>Inicio</a></li>
                            <li><a href='./noticias.php'>Noticias</a></li>
                            <li><a href='./clientes.php'>Clientes</a></li>
                            <li><a href='./inmuebles.php'>Inmuebles</a></li>
                            <li><a href='./citas.php'>Citas</a></li>
                            <li><a href='./contacto.php'>Contacto</a></li>
                            <li><a href='./cerrar_sesion.php'>Cerrar sesión de $nom[0]</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <main>";

        }elseif($usuario==-1){//No está logueado
            echo"<header id='cabecera'>
                <div>
                    <a href='../index.php'>
                        <img src='../assets/icono.png' alt='Icono de la inmobiliaria.'>
                    </a>
                    <nav>
                        <ul class='enlaces'>
                            <li><a href='../index.php'>Inicio</a></li>
                            <li><a href='./inmuebles.php'>Inmuebles</a></li>
                            <li><a href='./contacto.php'>Contacto</a></li>
                            <li><a href='./inicioS.php'>Acceder</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <main>";

        }if($usuario>0){//Es cliente
            $nom=sacar_nombre($usuario);   

            echo"<header id='cabecera'>
                <div>
                    <a href='../index.php'>
                        <img src='../assets/icono.png' alt='Icono de la inmobiliaria.'>
                    </a>
                    <nav>
                        <ul class='enlaces'>
                            <li><a href='../index.php'>Inicio</a></li>
                            <li><a href='./mis_inmuebles.php'>Mis inmuebles</a></li>
                            <li><a href='./clientes.php'>Mis datos personales</a></li>
                            <li><a href='./citas.php'>Mis citas</a></li>
                            <li><a href='./inmuebles.php'>Inmuebles disponibles</a></li>
                            <li><a href='./contacto.php'>Contacto</a></li>
                            <li><a href='./cerrar_sesion.php'>Cerrar sesión de $nom[0]</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <main>";
        }
    }

    function pintarHeader_index($usuario){  
        $nom=sacar_nombre($usuario);        

        if($usuario==0){//Es Admin
            echo"<header id='cabecera'>
                <div>
                    <a href='./index.php'>
                        <img src='./assets/icono.png' alt='Icono de la inmobiliaria.'>
                    </a>
                    <nav>
                        <ul class='enlaces'>
                            <li><a href='./index.php'>Inicio</a></li>
                            <li><a href='./php/noticias.php'>Noticias</a></li>
                            <li><a href='./php/clientes.php'>Clientes</a></li>
                            <li><a href='./php/inmuebles.php'>Inmuebles</a></li>
                            <li><a href='./php/citas.php'>Citas</a></li>
                            <li><a href='./php/contacto.php'>Contacto</a></li>
                            <li><a href='./php/cerrar_sesion.php'>Cerrar sesión de $nom[0]</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <main>";

        }elseif($usuario==-1){//No está logueado
            echo"<header id='cabecera'>
                <div>
                    <a href='./index.php'>
                        <img src='./assets/icono.png' alt='Icono de la inmobiliaria.'>
                    </a>
                    <nav>
                        <ul class='enlaces'>
                            <li><a href='./index.php'>Inicio</a></li>
                            <li><a href='./php/inmuebles.php'>Inmuebles</a></li>
                            <li><a href='./php/contacto.php'>Contacto</a></li>
                            <li><a class='user' href='./php/inicioS.php'>Acceder</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <main>";

        }if($usuario>0){//Es cliente
            echo"<header id='cabecera'>
                <div>
                    <a href='./index.php'>
                        <img src='./assets/icono.png' alt='Icono de la inmobiliaria.'>
                    </a>
                    <nav>
                        <ul class='enlaces'>
                            <li><a href='./index.php'>Inicio</a></li>
                            <li><a href='./php/mis_inmuebles.php'>Mis inmuebles</a></li>
                            <li><a href='./php/clientes.php'>Mis datos personales</a></li>
                            <li><a href='./php/citas.php'>Mis citas</a></li>
                            <li><a href='./php/inmuebles.php'>Inmuebles disponibles</a></li>
                            <li><a href='./php/contacto.php'>Contacto</a></li>
                            <li><a href='./php/cerrar_sesion.php'>Cerrar sesión de $nom[0]</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <main>";
        }
    }

    function pintarFooter(){
        echo"
        </main>
        <footer>
            <div id='loc'>
                <div>
                    <ul class='contacto'>             
                        <li>
                            <ul>
                                <li>Horarios</li>
                                <li>Lunes-Sábados de 09:30 a 14:00 y de 18:00 a 22:00</li>
                                <li>Domingos y festivos de 12:30 a 18:30</li>
                            </ul>
                        </li>
                        <li><span class='fa-solid fa-phone'></span> +32 654.123.123</li>
                        <li>
                            <a href='https://www.google.com/intl/es/gmail/about/' target='_blank'><span class='fa-regular fa-envelope'></span></a>
                            info@inmobiliariadeconfianza.com
                        </li>                           
                    </ul>
                    <ul  class='enlaces'>
                        <li><span class='fa-brands fa-paypal'></span></li>
                        <li><span class='fa-brands fa-cc-visa'></span></li>
                        <li><span class='fa-brands fa-cc-mastercard'></span></li>
                        <li><span class='fa-solid fa-money-bill-transfer'></span></li>
                    </ul>
                </div>
                <div>
                    <iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12713.885193126749!2d-3.5942356702392577!3d37.18903373020561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd71fccb73317c71%3A0xe7182c419edae537!2sMirador%20de%20San%20Miguel%20Alto!5e0!3m2!1ses!2ses!4v1699875335656!5m2!1ses!2ses' width='500' height='210' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>
                </div>
            </div>
            <div id='redes'>
                <ul class='enlaces'>
                    <li><a href='https://web.telegram.org/k/' target='_blank'><span class='fa-brands fa-telegram'></span></a></li>
                    <li><a href='https://www.facebook.com/' target='_blank'><span class='fa-brands fa-facebook'></span></a></li>
                    <li><a href='https://www.youtube.com/' target='_blank'><span class='fa-brands fa-youtube'></span></a></li>
                    <li><a href='https://www.tiktok.com/es/' target='_blank'><span class='fa-brands fa-tiktok'></span></a></li>
                    <li><a href='https://www.reddit.com/?rdt=32970' target='_blank'><span class='fa-brands fa-reddit-alien'></span></a></li>
                    <li><a href='https://twitter.com/?lang=es' target='_blank'><span class='fa-brands fa-x-twitter'></span></a></li>
                    <li><a href='https://web.whatsapp.com/' target='_blank'><span class='fa-brands fa-whatsapp'></span></a></li>
                    <li><a href='https://www.instagram.com/' target='_blank'><span class='fa-brands fa-instagram'></span></a></li>
                    <li><a href='https://snapchat.com/es' target='_blank'><span class='fa-brands fa-snapchat'></span></a></li>
                </ul>
            </div>
        </footer>";
    }
?>