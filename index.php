<!DOCTYPE html>
<!-- saved from url=(0040)http://getbootstrap.com/examples/signin/ -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="otros/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="otros/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="otros/css/sb-admin-2.css" rel="stylesheet">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<title>.::login sistema::.</title>
<!-- Bootstrap core CSS -->
<!-- Custom styles for this template -->
<link rel="stylesheet" href="css/style.css">
<link href="sistema/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
body
{
background-color:rgba(0,51,102,1);
}
</style>
  </head>

 <!--
    <div class="container" style="background-color:#FFF; border-radius:20px;">
      <form class="form-signin" action="dispatch.php" method="post">
        <h3 class="text-center">Login Sistema</h3>
        <div class="info"><img src="crearCaptcha.php" border="0" draggable="false"/></div>
        <input type="text" name="code" width="50" class="form-control" value="captcha" />
        <select name="opcion_modulo" class="form-control"/>
        	<option value="">opcion menu</option>
            <option value="academico">academico</option>
            <option value="infraestructura">infraestructura</option>
        </select>
        <input type="text" id="" class="form-control" placeholder="usuario" name="usuario" value="usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" value="password" placeholder="clave" name="clave" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">entrar</button>
      <div class="alert-info">
	 </div>
      </form>
    <div class="page-header" style="border-radius:20px;">
  	<div class="text-success" style="text-align:center; color:#C30;">
    Powered by 
    <a href="http://www.infoegen.cl" class="btn-link">
    	infoegen
    </a>
    </div>
    </div>  
 </div>
<!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    -->
 
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<body>
  <section class="container">
    <div class="login">
      <h1>login sistema</h1>
      <p><div align="center"><?php if(isset($_GET["mensaje"]) && $_GET["mensaje"]!=""){echo $_GET["mensaje"];}?></div>
      <form method="post" action="dispatch.php">
      <p class="text-center"><img src="crearCaptcha.php" border="0" draggable="false"/></p>
        <p><input type="text" name="code" value="" placeholder="codigo captcha"></p>
        <p><input type="text" name="usuario" value="" placeholder="Usuario"></p>
        <p><input type="password" name="clave" value="" placeholder="Password"></p>
        <p class="remember_me">
         <input type="reset" name="commit" value="Limpiar" class="reset">
        </p>
        <p class="submit">
        <input type="submit" name="commit" value="Entrar">
        </p>
      </form>
    </div>
    <div class="login-help">
      <!--
      <p>Olvido su password? <a href="#" data-toggle="modal" data-target="#myModal">Clickee para reestablecer</a></p>
    -->
    </div>
  </section>         
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Solicitar Reestablecer clave</h4>
                                        </div>
                                        <div class="modal-body">
                                         aca no hay nada aun!!
                                        </div>
                                        <div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
<button type="button" class="btn btn-primary" onClick="javascript:procesar();">Solicitar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                     
                     <!-- jQuery Version 1.11.0 -->
    <script src="otros/js/jquery-1.11.0.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="otros/js/bootstrap.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="otros/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->
 <script src="ajax.js"></script>
 
</body>

</html>