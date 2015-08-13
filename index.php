<?php
session_start();

// nonce contact form
$_form_id = uniqid('', true);
$_SESSION['form_id'] = $_form_id;

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="description" content="Atención psicológica para niños, adolescentes y adultos. Psicoterapia y psicología laboral.">
    <meta name="keywords" content="consulta psicologica, terapia, psicoterapia, psicologia laboral, sicoteraia, orientacion, padres, niños, adultos, consulta sicologica, seleccion de personal, autismo, discapacidad intelectual, montevideo, uruguay">
    <meta name="author" content="info@barbaracardozo.com">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="shortcut icon" href="/favicon.ico">-->
    <link rel="icon" type="image/png"  href="/favicon.png" />
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Psicologia</title>

    <link href='http://fonts.googleapis.com/css?family=Cardo:400,400italic,700|Gentium+Book+Basic:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
    $(document).ready(function() {

      window.setTimeout(function() {
      
        $("body").fadeIn("slow"); //.slideDown("slow");
       
      }, 300);
      
      $.each ( $('a'), function (i, a) {
        console.log(a.hash);
        if (a.hash.indexOf('#') === 0) // <a href="#section">...
        {
          var elem = $('a[name='+ a.hash.substr(1) +']'); // .substr(1) saca el #
          if (elem.length > 0)
          {
            $(a).on("click", function () {
              $('html,body').animate({scrollTop:elem.offset().top}, 500);
            });
          }
        }
      });
      
      // Alert click fadeout
      $('#alert_container').on('click', function() {
        $('#alert_container').fadeOut('slow');
      });
      
      // Form submit
      $("#contact_form").submit(function() {

         console.log(this.action);
         var url = this.action;

         $.ajax({
           type: "POST",
           url: url,
           data: $(this).serialize(),
           success: function(json)
           {
             if (json.status == "ok")
             {
                $('#alert').addClass('alert-success');
             }
             else
             {
                $('#alert').addClass('alert-danger');
             }
             
             $('#alert').text(json.msg);
             $('#alert_container').fadeIn('slow');
             
             window.setTimeout(function() { $('#alert_container').fadeOut('slow'); }, 5000);
           },
           fail: function(res, status, error)
           {
             //alert(res +' '+ error);
             $('#alert').addClass('alert-danger');
             $('#alert').text(error);
             $('#alert_container').fadeIn('slow');
             
             window.setTimeout(function() { $('#alert_container').fadeOut('slow'); }, 5000);
           }
         });

         return false;
      });
      
    });
    </script>
    
    <style>
      * {
        margin: 0;
      }
      p {
        margin: 0 0 1em; /* overwrites Bootstrap rule 0 0 10px */
      }
      html, body {
        height: 100%;
      }
      body {
        font-family: 'Cardo', serif;
        padding-bottom: 4em;
        font-size: 1.8em;
        display: none;
      }
      h2, .h2 {
        font-size: 28px;
      }
      #home h1 {
        font-family: 'Gentium Book Basic', serif;
        font-weight: 400;
        font-size: 4em;
        margin-bottom: 0;
      }
      #home h2 {
        font-family: 'Gentium Book Basic', serif;
        font-weight: 400;
        font-size: 2.5em;
        margin-top: 0.3em;
      }
      .main_message{
        
      }
      .main_message > p.message
      {
        padding: 1em;
        font-size: 1.8em;
        font-style: italic;
      }
      .main_message > p.author
      {
        text-align: right;
        font-size: 1.3em;
      }
      

      /* each section is 100% of the screen height and aligned middle */
      section {
        min-height: 96%;  /* Fallback for browsers do NOT support vh unit */
        min-height: 96vh; /* These two lines are counted as one :-)       */
        display: flex;
        align-items: center;
        width: 100%;
        margin-bottom: 4em; /* footer height */
        padding-top: 1em;
        padding-bottom: 1em;
        position: relative;
      }
      section p {
        padding: 1em 0 0 0;
      }
      section h1 { 
        margin-top: 0;
      }
      
      .navbar {
         margin-bottom: 0;
      }
      
      #home {
        min-height: 92%;  /* Fallback for browsers do NOT support vh unit */
        min-height: 92vh; /* These two lines are counted as one :-)       */
        padding-top: 0;
      }
      #home h2, #services h2 {
        margin-bottom: 1em;
      }
      #services h2 {
        margin-top: 1.5em;
      }
      #home p {
        padding: 0;
      }
      #services, #contact {
        background-color: #eee;
      }
      #profile h1 {
        margin-bottom: 1em;
      }
      #contact h1 {
        margin-bottom: 2em;
      }
      
      .goup {
        position: absolute;
        top: 1em;
        right: 1em;
      }
      
      footer {
        background-color: #ddd;
        position: fixed;
        bottom: 0px;
        width: 100%;
        height: 4em;
        padding: 1.5em 0 1.5em 0;
      }
     
      /*
      Extra small devices Phones (<768px)
      Small devices Tablets (=768px)
      Medium devices Desktops (=992px)
      Large devices Desktops (=1200px)
      */
      @media screen and (max-width: 768px) { /*  Extra small devices Phones (<768px) */
        #home h1 {
          font-size: 3em;
        }
        #home h2 {
          font-size: 1.8em;
        }
        .main_message > p.message
         {
           padding: 1em;
           font-size: 1.6em;
           font-style: italic;
         }
         .main_message > p.author
         {
           text-align: right;
           font-size: 1.2em;
         }
         section h1 {
           font-size: 1.6em;
         }
         section h2 {
           font-size: 1.4em;
         }
         section p, section ul li {
           font-size: 0.9em;
         }
      }
      @media screen and (max-width: 640px) {
        #home h1 {
          font-size: 2.4em;
        }
        #home h2 {
          font-size: 1.6em;
        }
        .main_message > p.message
         {
           padding: 1em;
           font-size: 1.4em;
           font-style: italic;
         }
         .main_message > p.author
         {
           text-align: right;
           font-size: 1.1em;
         }
      }
      @media screen and (max-width: 400px) {
        #home h1 {
          font-size: 2.0em;
        }
        #home h2 {
          font-size: 1.4em;
        }
        .main_message > p.message
         {
           padding: 1em;
           font-size: 1.2em;
           font-style: italic;
         }
         .main_message > p.author
         {
           text-align: right;
           font-size: 1.0em;
         }
         footer {
           height: 3em;
           padding: 1.0em 0 1.2em 0;
           font-size: 0.8em;
         }
         section {
           margin-bottom: 2.4em; /* footer height, but since em is relative to the elements font-size, is a little less because the font-size on section is bigger than the footer */
         }
      }
      
      #alert_container {
        position: fixed;
        top: 1.5rem;
        display: none;
        z-index: 999;
        margin: 0 auto;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <a name="home"></a>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#services">Áreas de Atención</a></li>
              <li><a href="#profile">Perfil Profesional</a></li>
              <li><a href="#contact">Contacto</a></li>
            </ul>
          </div>
        </div>
    </nav>

    
    <section id="home">
      <div class="container">
        <h1 align="center">Bárbara Cardozo Cabanelas</h1>
        <h2 align="center">LICENCIADA EN PSICOLOGÍA</h2> 
        <div class="main_message">
          <p align="center" class="message">
            "La ciencia moderna aún no ha producido un medicamento tranquilizador tan eficaz como lo son unas pocas palabras"
          </p>
          <p class="author">S. Freud</p>
        </div>
      </div>
    </section>
   
   <a name="services"></a>
   <section id="services">
      <div class="container">
      <h1 align="center">Áreas de Atención</h1>
      <p align="justify">
      El espacio terapéutico es aquel donde el sujeto elabora y re-construye su historia mediante un pensar juntos, desenredando nudos mediante la palabra.
      A la hora de consultar con un psicólogo, por lo general se piensa que es a causa de problemáticas o conflictos emocionales específicos, sin embargo
      entendemos que el espacio de consulta es también indicado para aquellos que deseen comenzar un camino de mayor conocimiento de sí mismos.
      </p>
      
      <div class="row">
        <div class="col-sm-12 col-md-3">
          <h2>Área Clínica</h2>
          <ul>
             <li>Atención psicológica a niños, adolescentes y adultos</li>
             <li>Psicoterapia individual</li>
             <li>Orientación a padres</li>
           </ul>
        </div>
        <div class="col-sm-12 col-md-3">
           <h2>Área Diagnóstica</h2>
           <ul>
             <li>Psicoadiagnóstico</li>
             <li>Baterías para certificados de discapacidad</li>
           </ul>
        </div>
        <div class="col-sm-12 col-md-3">
          <h2>Área Educacional</h2>
           <ul>
             <li>Intervenciones y acompañamientos en Instituciones educativas</li>
             <li>Talleres para padres y profesionales de la educación</li>
           </ul>
        </div>
        <div class="col-sm-12 col-md-3">
          <h2>Área Laboral</h2>
           <ul>
             <li>Evaluaciones psicolaborales</li>
             <li>Búsqueda y selección de personal</li>
           </ul>
        </div>
      </p>
     </div>
    
     <div class="goup">
      <a href="#home"><span class="glyphicon glyphicon-menu-up"></span></a>
     </div>
    </section>
   
   <a name="profile"></a>
   <section id="profile">
      <div class="container">
       <h1 align="center">Perfil profesional</h1>
       <p align="justify">
       Licenciada en Psicología egresada de la Universidad de la República, con sólida 
       formación en infancia y adolescencia, especializada en la atención psicoterapéutica. 
       Cuenta con experiencia en instituciones educativas, abordando diversas problemáticas, 
       trabajando en equipos multidisciplinarios con abordajes integrales. Ha trabajado en
       el área de discapacidad en contextos heterogéneos.
       </p>
       <p align="justify">
       Asimismo, posee formación y experiencia específica en Capital Humano. Ha realizado
       diferentes cursos a nivel de Gestión de Recursos Humanos, así como específicos en
       Selección de Personal y Evaluación Psicolaboral. 
         <!--
         <img src="LinkedIn.png" class="img-responsive" />
         -->
       </p>
     </div>
     
     <div class="goup">
       <a href="#home"><span class="glyphicon glyphicon-menu-up"></span></a>
     </div>
    </section>
   
   <a name="contact"></a>
   <section id="contact">
      <div class="container">
       <h1 align="center">Contacto</h1>
       
       <div class="container">
         <div class="row">
           <div class="col-md-8">
             <!-- TODO jquery form -->
             <form action="MailController.php" method="post" id="contact_form">
               <input type="hidden" name="nonce" value="<?php echo $_SESSION['form_id']; ?>" />
               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <label for="name">Nombre</label>
                     <input type="text" class="form-control" id="name" name="name" required="required" />
                   </div>
                   <div class="form-group">
                     <label for="email">Correo electrónico</label>
                     <input type="email" class="form-control" id="email" name="email" required="required" />
                   </div>
                   <div class="form-group">
                      <label for="subject">Motivo del contacto</label>
                      <input type="text" class="form-control" id="subject" name="subject" required="required" />
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <label for="name">Mensaje</label>
                     <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"></textarea>
                   </div>
                 </div>
                 <div class="col-md-12">
                   <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">Enviar</button>
                 </div>
               </div>
             </form>
           </div>
           <div class="col-md-4">
             <legend><span class="glyphicon glyphicon-globe"></span> Consultorio</legend>
             <address>
               Pocitos-Punta Carretas<br>
               Montevideo, Uruguay<br>
               <!--
               <abbr title="Phone">P:</abbr>
               (123) 456-7890
               -->
             </address>
             <address>
               <strong>Lic. Psic. Bárbara Cardozo Cabanelas</strong><br>
             </address>
           </div>
         </div>
       </div>
     </div>
     <div class="goup">
       <a href="#home"><span class="glyphicon glyphicon-menu-up"></span></a>
     </div>
    </section>
   
    <!-- feedback -->
    <div class="container" id="alert_container">
      <div class="alert" role="alert" id="alert">
        <div id="alert_message"></div>
      </div>
    </div>
    
    <footer>
      <div align="center">
        <span class="glyphicon glyphicon-earphone"></span> <a href="tel:+59899969586">099 969 586</a>
        |
        <span class="glyphicon glyphicon-envelope"></span> <a href="mailto:info@barbaracardozo.com">info@barbaracardozo.com</a>
        <!-- <a href="skype:skype_user?call">Call us using Skype!</a> -->
      </div>
    </footer>
    
    <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

     ga('create', 'UA-65360728-1', 'auto');
     ga('send', 'pageview');
    </script>

  </body>
</html>