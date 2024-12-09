<?php  
    function ordenarFecha($fechaIn){
        $marca=strtotime($fechaIn);
        $fechaOut=date("d-m-Y",$marca);
        return $fechaOut;
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
        $enc=md5(md5(md5(md5(md5($psswrd)))));
        return $enc;
    }

    function pintar_menu_index($id){
        if($id==0){//Admin
            echo"<header class='mb-5'>
                <nav class='navbar navbar-expand-lg bg-body-tertiary'>
                    <div class='container-fluid'>
                        <div class='icono col-1 navbar-brand d-flex justify-content-center'>
                            <a href='./index.php' class='nOver'>
                                <img src='./assets/logor.png' alt='Icono de personal'>
                            </a>
                        </div>
                        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                            <span class='navbar-toggler-icon'></span>
                        </button>
                        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                            <ul class='navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-around'>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_proyectos.php'>Proyectos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_campos.php'>Campos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_socios.php'>Socios</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_muestras.php'>Muestras</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_comentarios.php'>Comentarios</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_cerrar_sesion.php'>Salir</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
            <div id='subir'>		
                <a href='#' class='ea'><i class='fa-solid fa-angle-up fs-2'></i></a>	
            </div>";
        }elseif($id>0){//Es socio
            echo"<header class='mb-5'>
                <nav class='navbar navbar-expand-lg bg-body-tertiary'>
                    <div class='container-fluid'>
                        <div class='icono col-1 navbar-brand d-flex justify-content-center'>
                            <a href='./index.php' class='nOver'>
                                <img src='./assets/logor.png' alt='Icono de personal'>
                            </a>
                        </div>
                        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                            <span class='navbar-toggler-icon'></span>
                        </button>
                        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                            <ul class='navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-around'>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_proyectos.php'>Proyectos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_campos.php'>Campos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_cerrar_sesion.php'>Salir</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
            <div id='subir'>		
                <a href='#' class='ea'><i class='fa-solid fa-angle-up fs-2'></i></a>	
            </div>";
        }elseif($id==(-1)){//No está logueado
            echo"<header class='mb-5'>
                <nav class='navbar navbar-expand-lg bg-body-tertiary'>
                    <div class='container-fluid'>
                        <div class='icono col-1 navbar-brand d-flex justify-content-center'>
                            <a href='./index.php' class='nOver'>
                                <img src='./assets/logor.png' alt='Icono de personal'>
                            </a>
                        </div>
                        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                            <span class='navbar-toggler-icon'></span>
                        </button>
                        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                            <ul class='navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-around'>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./index.php'>Inicio</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_proyectos.php'>Proyectos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./controladores/controlador_campos.php'>Campos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='./vistas/acceso.php'>Acceder</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
            <div id='subir'>		
                <a href='#' class='ea'><i class='fa-solid fa-angle-up fs-2'></i></a>	
            </div>";
        }
    }

    function pintar_menu($id){
        if($id==0){//Admin
            echo"<header class='mb-5'>
                <nav class='navbar navbar-expand-lg bg-body-tertiary'>
                    <div class='container-fluid'>
                        <div class='icono col-1 navbar-brand d-flex justify-content-center'>
                            <a href='../index.php' class='nOver'>
                                <img src='../assets/logor.png' alt='Icono de personal'>
                            </a>
                        </div>
                        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                            <span class='navbar-toggler-icon'></span>
                        </button>
                        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                            <ul class='navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-around'>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_proyectos.php'>Proyectos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_campos.php'>Campos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_socios.php'>Socios</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_muestras.php'>Muestras</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_comentarios.php'>Comentarios</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_cerrar_sesion.php'>Salir</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
            <div id='subir'>		
                <a href='#' class='ea'><i class='fa-solid fa-angle-up fs-2'></i></a>	
            </div>";
        }elseif($id>0){//Es socio
            echo"<header class='mb-5'>
                <nav class='navbar navbar-expand-lg bg-body-tertiary'>
                    <div class='container-fluid'>
                        <div class='icono col-1 navbar-brand d-flex justify-content-center'>
                            <a href='../index.php' class='nOver'>
                                <img src='../assets/logor.png' alt='Icono de personal'>
                            </a>
                        </div>
                        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                            <span class='navbar-toggler-icon'></span>
                        </button>
                        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                            <ul class='navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-around'>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_proyectos.php'>Proyectos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_campos.php'>Campos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_cerrar_sesion.php'>Salir</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
            <div id='subir'>		
                <a href='#' class='ea'><i class='fa-solid fa-angle-up fs-2'></i></a>	
            </div>";
        }elseif($id==(-1)){//No está logueado
            echo"<header class='mb-5'>
                <nav class='navbar navbar-expand-lg bg-body-tertiary'>
                    <div class='container-fluid'>
                        <div class='icono col-1 navbar-brand d-flex justify-content-center'>
                            <a href='../index.php' class='nOver'>
                                <img src='../assets/logor.png' alt='Icono de personal'>
                            </a>
                        </div>
                        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                            <span class='navbar-toggler-icon'></span>
                        </button>
                        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                            <ul class='navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-around'>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../index.php'>Inicio</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_proyectos.php'>Proyectos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../controladores/controlador_campos.php'>Campos</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' aria-current='page' href='../vistas/acceso.php'>Acceder</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
            <div id='subir'>		
                <a href='#' class='ea'><i class='fa-solid fa-angle-up fs-2'></i></a>	
            </div>";
        }
    }

    function pintar_footer(){
        echo"</main>
        <footer class='d-flex flex-column align-items-center p-3'>
            <div class='row w-75 py-3'>
                <div class='col-12 d-flex justify-content-around'>
                    <span>proyectoFILOS</span>
                    <span>NUESTRAS campoS</span>
                    <span>proyectoS VARIAS</span>
                    <span>PARA TODA LA FAMILIA</span>
                    <span>ESTRENOS EXCLUSIVOS</span>  
                </div>          
            </div>
            <div class='row w-50 pb-3'>
                <div>
                    <div class='col-12 d-flex justify-content-around pb-3'>
                        <span>Política de cookies</span>
                        <span>Condiciones de uso</span>
                        <span>Atención al cliente</span>
                        <span>Política de privacidad</span>
                    </div>
                    <div class='col-12 d-flex justify-content-around'>                    
                        <span>@2024proyectofilos</span> 
                    </div>
                </div>           
            </div>
        </footer>
        <script src='https://kit.fontawesome.com/f1a9439f03.js' crossorigin='anonymous'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL' crossorigin='anonymous'></script>
    </body>
    </html>";
    }

    // function carrousel_comentarios($datos){
    //     //Copiar del index y llamar
    //     echo"<section class='container carrusel rounded my-5'>
    //     <div id='carouselExampleCaptions' class='carousel carousel-dark slide'>
    //             <div class='carousel-indicators'>
    //                 <button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='0' class='active' aria-current='true'></button>
    //                 <button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='1' class='active' aria-current='true'></button>
    //                 <button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='2' class='active' aria-current='true'></button>
    //                 <button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='3' class='active' aria-current='true'></button>
    //                 <button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='4' class='active' aria-current='true'></button>
    //             </div>
    //             <div class='carousel-inner'>
    //                 <div class='carousel-item active  justify-content-around'>";
    //                     $nomFoto=$datos[0]["foto"];
    //                     echo "<img src='./assets/proyectos/$nomFoto' class='d-block'>
    //                     <div class='carousel-caption d-none d-md-block m-auto w-25'>
    //                         <h5><b>";
    //                             echo $datos[0]["socio"];
    //                             echo"</b>-";
    //                             echo $datos[0]["proyecto"];
    //                             echo"</h5><p>";
    //                             echo $datos[0]["texto"];
    //                             echo"</p>
    //                         <span class='text-secondary'>";
    //                             echo ordenarFecha($datos[0]["fecha"]);
    //                             echo"</span>
    //                     </div>";
    //                     echo "<img src='./assets/proyectos/$nomFoto' class='d-block carrFoto'>
    //                 </div>
    //                 <div class='carousel-item'>";
    //                     $nomFoto=$datos[1]["foto"];
    //                     echo "<img src='./assets/proyectos/$nomFoto' class='d-block'>
    //                     <div class='carousel-caption d-none d-md-block m-auto w-25'>
    //                         <h5><b>";
    //                             echo $datos[1]["socio"];
    //                             echo"</b>-";
    //                             echo $datos[1]["proyecto"];
    //                             echo"</h5><p>";
    //                             echo $datos[1]["texto"];
    //                             echo"</p>
    //                         <span class='text-secondary'>";
    //                             echo ordenarFecha($datos[1]["fecha"]);
    //                             echo"</span>
    //                     </div>";
    //                     echo "<img src='./assets/proyectos/$nomFoto' class='d-block carrFoto'>
    //                 </div>
    //                 <div class='carousel-item'>";
    //                     $nomFoto=$datos[2]["foto"];
    //                     echo "<img src='./assets/proyectos/$nomFoto' class='d-block'>
    //                     <div class='carousel-caption d-none d-md-block m-auto w-25'>
    //                         <h5><b>";
    //                             echo $datos[2]["socio"];
    //                             echo"</b>-";
    //                             echo $datos[2]["proyecto"];
    //                             echo"</h5><p>";
    //                             echo $datos[2]["texto"];
    //                             echo"</p>
    //                         <span class='text-secondary'>";
    //                             echo ordenarFecha($datos[2]["fecha"]);
    //                             echo"</span>
    //                     </div>";
    //                     echo "<img src='./assets/proyectos/$nomFoto' class='d-block carrFoto'>
    //                 </div>
    //                 <div class='carousel-item'>";
    //                     $nomFoto=$datos[3]["foto"];
    //                     echo "<img src='./assets/proyectos/$nomFoto' class='d-block'>
    //                     <div class='carousel-caption d-none d-md-block m-auto w-25'>
    //                         <h5><b>";
    //                             echo $datos[3]["socio"];
    //                             echo"</b>-";
    //                             echo $datos[3]["proyecto"];
    //                             echo"</h5><p>";
    //                             echo $datos[3]["texto"];
    //                             echo"</p>
    //                         <span class='text-secondary'>";
    //                             echo ordenarFecha($datos[3]["fecha"]);
    //                             echo"</span>
    //                     </div>";
    //                     echo "<img src='./assets/proyectos/$nomFoto' class='d-block carrFoto'>
    //                 </div>
    //                 <div class='carousel-item'>";
    //                     $nomFoto=$datos[4]["foto"];
    //                     echo "<img src='./assets/proyectos/$nomFoto' class='d-block'>
    //                     <div class='carousel-caption d-none d-md-block m-auto w-25'>
    //                         <h5><b>";
    //                             echo $datos[4]["socio"];
    //                             echo"</b>-";
    //                             echo $datos[4]["proyecto"];
    //                             echo"</h5><p>";
    //                             echo $datos[4]["texto"];
    //                             echo"</p>
    //                         <span class='text-secondary'>";
    //                             echo ordenarFecha($datos[4]["fecha"]);
    //                             echo"</span>
    //                     </div>";
    //                     echo "<img src='./assets/proyectos/$nomFoto' class='d-block carrFoto'>
    //                 </div>
    //             </div>
    //             <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide='prev'>
    //                 <span class='carousel-control-prev-icon' aria-hidden='true'></span>
    //                 <span class='visually-hidden'>Previous</span>
    //             </button>
    //             <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide='next'>
    //                 <span class='carousel-control-next-icon' aria-hidden='true'></span>
    //                 <span class='visually-hidden'>Next</span>
    //             </button>
    //         </div>
    //     </section>";
    // }
?>