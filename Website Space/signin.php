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
		
<!-- login -->
				
			<div class="w3_login_module">
				<div class="module form-module">

				  <div class="toggle">  <!-- box bianco con form di login -->
				  </div>

				  <div class="form">
					  <h2>Crea un account</h2>
					<form action="signin.php" method="post">
					  <input type="text" name="Username" placeholder="Username" required=" " id="Username">
					  <input type="password" name="Password" placeholder="Password" required=" " id="Password">
					  <input type="text" name="Nome" placeholder="Nome" required=" " id="Nome">
					  <input type="text" name="Cognome" placeholder="Cognome" required=" " id="Cognome">
					  <input type="text" name="Indirizzo" placeholder="Indirizzo" required=" " id="Indirizzo">
					  <input type="text" name="Telefono" placeholder="Telefono" required=" " id="Telefono">
					  <input type="email" name="Email" placeholder="Email" required=" " id="Email">
					  <input type="submit" value="Registrati">
					</form>
				  </div>
				  <div class="cta"><a href="login.php">Hai gia' un account? ACCEDI!</a></div>
				</div>

			<?php
				$Username = mysqli_real_escape_string($conn, $_REQUEST['Username']);
				$Password = mysqli_real_escape_string($conn, $_REQUEST['Password']);
				$Nome = mysqli_real_escape_string($conn, $_REQUEST['Nome']);
				$Cognome = mysqli_real_escape_string($conn, $_REQUEST['Cognome']);
				$Indirizzo = mysqli_real_escape_string($conn, $_REQUEST['Indirizzo']);
				$Telefono = mysqli_real_escape_string($conn, $_REQUEST['Telefono']);
				$Email = mysqli_real_escape_string($conn, $_REQUEST['Email']);

				if($_POST["Username"] != "" && $_POST["Password"]!= "" && $_POST["Nome"] != "" && $_POST["Cognome"] != "" && $_POST["Indirizzo"] != "" && $_POST["Telefono"] != "" && $_POST["Email"] != ""){ 
				$sql = "INSERT INTO CLIENTE (Username, Password, Nome, Cognome, Indirizzo, Telefono, Email) VALUES ('$Username', '$Password', '$Nome', '$Cognome', '$Indirizzo', '$Telefono', '$Email')";
				}
			 if(mysqli_query($conn, $sql)){
   				 //echo "Records inserted successfully.";
			 	$_SESSION["logged"]=true; //restituisci vero alla chiave logged in SESSION
			 	echo '<script>alert("Registrazione avvenuta con successo!")</script>'; 
				echo '<script>window.location="login.php"</script>';

			} else{
   				 //echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
				}

				

			?>
		
<!-- //login -->
		</div>
		<div class="clearfix"></div>
		<br>
		<br>
	

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