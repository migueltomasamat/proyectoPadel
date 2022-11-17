<?php

namespace Vista\Plantilla;
use DateTime;

class Plantilla
{
    private string $encabezado;

    /**
     * @return string
     */
    public function getEncabezado(): string
    {
        return $this->encabezado;
    }

    /**
     * @param string $encabezado
     */
    public function setEncabezado(string $encabezado): void
    {
        $this->encabezado = $encabezado;
    }

    /**
     * @return string
     */
    public function getNav(): string
    {
        return $this->nav;
    }

    /**
     * @param string $nav
     */
    public function setNav(string $nav): void
    {
        $this->nav = $nav;
    }

    /**
     * @return string
     */
    public function getBloquePresentacion(): string
    {
        return $this->bloquePresentacion;
    }

    /**
     * @param string $bloquePresentacion
     */
    public function setBloquePresentacion(string $bloquePresentacion): void
    {
        $this->bloquePresentacion = $bloquePresentacion;
    }

    /**
     * @return string
     */
    public function getBloqueDosColumnas(): string
    {
        return $this->bloqueDosColumnas;
    }

    /**
     * @param string $bloqueDosColumnas
     */
    public function setBloqueDosColumnas(string $bloqueDosColumnas): void
    {
        $this->bloqueDosColumnas = $bloqueDosColumnas;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getFooter(): string
    {
        return $this->footer;
    }

    /**
     * @param string $footer
     */
    public function setFooter(string $footer): void
    {
        $this->footer = $footer;
    }
    private string $nav;
    private string $bloquePresentacion;
    private string $bloqueDosColumnas;
    private string $body;
    private string $footer;


    public function __construct(string $titulo="Sin titulo",string $dirLogotipo='/Vista/Plantilla/assets/img/logo.png' ,array $menu=['Inicio'=>'#','Log-in'=>'#','Registro'=>'#'], $encabezadoPrincipal="Sin encabezado",$descripcionPrincipal="Sin descripción"){
        $this->generarEncabezadoHTML($titulo);
        $this->generarBarraNavegacionHTML($dirLogotipo,$menu);
        $this->generarPresentacionWeb($encabezadoPrincipal,$descripcionPrincipal);
        $this->generarFooter();
    }


    public function generarEncabezadoHTML($titulo): void
    {
        $this->setEncabezado("
                <!DOCTYPE html>
                <html xmlns='http://www.w3.org/1999/xhtml' lang='es'>
                <head>
                    <meta charset='utf-8' />
                    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1' />
                    <meta name='description' content='' />
                    <meta name='author' content='' />
                    <title>$titulo</title>
                    <!-- BOOTSTRAP CORE STYLE CSS -->
                    <link href='/Vista/Plantilla/assets/css/bootstrap.css' rel='stylesheet' />
                    <!-- FONT AWESOME CSS -->
                    <link href='/Vista/Plantilla/assets/css/font-awesome.min.css' rel='stylesheet' />
                     <!-- STYLE SWITCHER  CSS -->
                    <link href='/Vista/Plantilla/assets/css/styleSwitcher.css' rel='stylesheet' />
                    <!-- CUSTOM STYLE CSS -->
                    <link href='/Vista/Plantilla/assets/css/style.css' rel='stylesheet' />  
                     <!--GREEN STYLE VERSION IS BY DEFAULT, USE ANY ONE STYLESHEET FROM TWO STYLESHEETS (green or red) HERE-->
                     <link href='/Vista/Plantilla/assets/css/themes/green.css' id='mainCSS' rel='stylesheet' />   
                  <!-- Google	Fonts -->
                    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
                </head>
                <body>
    ");
    }
    public function generarBarraNavegacionHTML(string $dirLogotipo,array $opcionesMenu):void{
        $this->nav="
            <div class='navbar navbar-inverse navbar-fixed-top move-me' id='menu'>
            <div class='container'>
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                    </button>
                    <a class='navbar-brand' href='/'><img class='logo-custom' src='$dirLogotipo' alt='logotipo empresa'  /></a>
                </div>
                <div class='navbar-collapse collapse'>
                    <ul class='nav navbar-nav navbar-right'>";

        foreach ($opcionesMenu as $texto => $enlace){
            $this->nav.= "<li><a href='$enlace'>$texto</a></li>";
        }

        $this->nav.="  <li><a href='mailto:info@cobrapadel.es?Subject=Contacto' target='_top'> <i class='fa fa-envelope-o'></i><span class='home-mail'>e-mail: info@cobrapadel.es</span></a></li>
                    </ul>
                </div>
            </div>
        </div>";
    }

    public function generarPresentacionWeb(string $tituloPrincipal, string $descripcion):void{
        $this->bloquePresentacion="
            <section class='header-sec' id='home' >
               <div class='overlay'>
                <div class='container'>
               <div class='row text-center' >
               
                   <div class='col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1'>
                   
                    <h2 data-scroll-reveal='enter from the bottom after 0.1s'>
                        <strong>";
                             $this->bloquePresentacion.=$tituloPrincipal;
                             $this->bloquePresentacion.="               
                            </strong>
                            </h2>
                                       
                       <p data-scroll-reveal='enter from the bottom after 0.8s'>";
                             $this->bloquePresentacion.= $descripcion;
                            $this->bloquePresentacion.="</p>       
                      <br />
                </div>
                   </div>
                    </div>
               </div>
           </section>";
    }

    public function generarDosColumnasConFondoBlanco (string $tituloSeccion,string $celdaIzquierda,string $celdaDerecha):void{

        $this->bloqueDosColumnas="
            <section class='contact' id='contact' >
                <div class='container'>
                   <div class='row text-center ' >
                      <div class='col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1'>
                        <h3 data-scroll-reveal='enter from the bottom after 0.1s'>
                        <strong>";
        $this->bloqueDosColumnas.= $tituloSeccion;
        $this->bloqueDosColumnas.="</strong>
                  </h3>
                 </div>
                 </div>
                <div class='row'>
                     <div class='col-lg-6 col-md-6 col-sm-6' data-scroll-reveal='enter from the right after 0.2s'>";
        $this->bloqueDosColumnas.=$celdaIzquierda;
        $this->bloqueDosColumnas.="
                    </div>
                    <div class='col-lg-6 col-md-6 col-sm-6' data-scroll-reveal='enter from the left after 0.4s'>";
        $this->bloqueDosColumnas.=$celdaDerecha;
        $this->bloqueDosColumnas.="</div>
                </div>
                </div>
              </section>
        ";
    }

    public function generarFooter():void{
        $anyo= new DateTime();
        $this->footer="<div class='myfooter' >
                     &copy; ".$anyo->format('Y')." cobrapadel.com | Theme by: <a href='https://binarytheme.com' style='color:#fff;' target='_blank'  >www.binarytheme.com</a>

        </div>
        
            <!--  Jquery Core Script -->
            <script src='/Vista/Plantilla/assets/js/jquery-1.10.2.js'></script>
            <!--  Core Bootstrap Script -->
            <script src='/Vista/Plantilla/assets/js/bootstrap.js'></script>
             <!--  Scrolling Reveal Script -->
            <script src='/Vista/Plantilla/assets/js/scrollReveal.js'></script>
            <!--  Scroll Scripts --> 
            <script src='/Vista/Plantilla/assets/js/jquery.easing.min.js'></script>
             <!--  Style Switcher Scripts -->
            <script src='/Vista/Plantilla/assets/js/styleSwitcher.js'></script>
                <!--  Custom Scripts -->    
            <script src='/Vista/Plantilla/assets/js/custom.js'></script>
            </body>
            </html>";

    }
    public function generarWebCompleta():string{


        $vista = $this->getEncabezado();
        $vista .= $this->getNav();
        $vista .= $this->getBloquePresentacion();
        if (isset($this->body)){
            $vista .= $this->getBody();
        }
        if (isset($this->bloqueDosColumnas)){
            $vista.= $this->getBloqueDosColumnas();
        }
        $vista .= $this->getFooter();

        return $vista;
    }


}