<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
Powered by: Giuseppe La Gualano & Giorgio Fanelli
LinkedIn: https://www.linkedin.com/in/giuseppe-la-gualano/
-->

<?php
session_start();
include("db_con.php");
?>

<html>

<head> <!-- importo i css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
	
	<body>

<!-- header -->
	<div class="agileits_header">  <!-- barra superiore nera -->
		<div style="max-height:47px;overflow:auto;">
		<div class="w3l_search">    <!-- barra di ricerca -->
			<form action="#" method="post">
				<input type="text" name="Product" value="Cerca un prodotto..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cerca un prodotto...';}" required="">
				<input type="submit" value=" ">
			</form>
		</div>
		
		<div class="w3l_header_right1">  <!-- login/registrazione -->
			<h2><a href="login.php">Entra!</a></h2>
		</div>
	</div>
		<div class="clearfix"> </div>
	</div>

	<div class="logo-container">   <!-- inserimento logo (c'e' il background in css) -->
    <a href="https://goprojectunipr.altervista.org"><img src="images/logo.png"></a>
</div>
<!-- //header -->

<!-- sidebar -->
	
		
<!-- login -->
		
			
			<div class="w3_login_module">
				<div class="module form-module">

				  <div class="toggle">  <!-- box bianco con form di login -->
				  </div>

				  <div class="form">
					<h2>Entra nel tuo account</h2>
					<form action="login.php" method="post">
					  <input type="text" name="Username" placeholder="Username" required=" " id="Username">
					  <input type="password" name="Password" placeholder="Password" required=" " id="Password">
					  <input type="submit" value="Login">
					</form>
				  </div>

				  <div class="cta"><a href="signin.php">Non hai un account? REGISTRATI!</a></div>
				</div>
			
			<?php

$_SESSION["Username"]=$_POST["Username"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION username
$_SESSION["Password"]=$_POST["Password"]; 

if($_POST["Username"] != "" && $_POST["Password"]!= ""){ 
$query = "SELECT * FROM CLIENTE WHERE Username='".$_POST["Username"]."' AND password ='".$_POST["Password"]."'";

$result = $conn->query($query);
if ($result->num_rows > 0) {
	$_SESSION["logged"]=true; //restituisci vero alla chiave logged in SESSION
	header("location:index.php");
    }

    	$message = "Hai inserito dati sbagliati!";
		echo "<script type='text/javascript'>alert('$message');</script>";
    }
    
	?>
		
		
<!-- //login -->
		</div>
		<div class="clearfix"></div>
	
<!-- //banner -->

<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="col-md-3 w3_footer_grid">
				<h3>LINK UTILI</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="login.php">Sign In / Login</a></li>
					<li><a href="profilo.php">Profilo</a></li>
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>INFORMAZIONI</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="about.php">Chi Siamo</a></li>
				</ul>
			</div>

			<div class="col-md-3 w3_footer_grid">
				<h3>OCCIDENTALI</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="cucina.php?type=italia">Italiana</a></li>
					<li><a href="cucina.php?type=messico">Messicana</a></li>
					<li><a href="cucina.php?type=grecia">Greca</a></li>
					
				</ul>
			</div>

			<div class="col-md-3 w3_footer_grid">
				<h3>ORIENTALI</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="cucina.php?type=giappone">Giapponese</a></li>
					<li><a href="cucina.php?type=cina">Cinese</a></li>
					<li><a href="cucina.php?type=india">Indiana</a></li>
				</ul>
			</div>

			<p>Powered By: <a href="https://www.linkedin.com/in/giuseppe-la-gualano/">Giuseppe La Gualano</a>
			, Giorgio Fanelli</p>
			<p>License: <a href="https://w3layouts.com/">Creative Commons Attribution 3.0 Unported</a></p>
			
				<div class="clearfix"> </div>
			</div>
		</div>
	
<!-- //footer -->

</body>
</html>