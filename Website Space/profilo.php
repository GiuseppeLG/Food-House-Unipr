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

// CONTROLLO SE L'UTENTE E' LOGGATO, ALTRIMENTI NON PUO' ACCEDERE A QUESTA PAGINA E RIMANDO A LOGIN.
if($_SESSION["Username"] == ""){
	$message = "Non sei autentificato! Effettua il Login.";
	echo "<script type='text/javascript'>alert('$message'); window.location = './login.php';</script>";
}
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
			<form action="profilo.php" method="post">
				<input type="text" name="Product" value="Cerca un prodotto..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cerca un prodotto...';}" required="" id="search">
				<input type="submit" value=" ">
			</form>
		</div>

		<?php
		//echo "search: ".$_POST['search']."";
		$search = mysqli_real_escape_string($conn, $_REQUEST['search']);
		$sqlS = "

		SELECT L.Nome 
		FROM DISTRIBUZIONE AS D, LOCALE AS L, PRODOTTO AS P 
		WHERE '$search' LIKE P.Nome
		AND P.IDProdotto = D.Prodotto
		AND D.Locale = L.IDLocale

		";

		//echo "search2: ".$search."";
		if($_POST["search"] != ""){
		$resultS = $conn->query($sqlS);
		
		
		if ($resultS->num_rows > 0) {
    // output data of each row
    while($rowS = $resultS->fetch_assoc()) {
       // $result2 = str_replace(' ','_',$row["Nome"]);
    	
    	 unset ($_SESSION["shopping_cart"]);
        header("location:locale.php?local=".$rowS["Nome"]."");
    	}
	} else {
    	$message = "Prodotto non trovato!";
		echo "<script type='text/javascript'>alert('$message');</script>";
}
}

?>
		
		<div class="w3l_header_right1">  <!-- login/registrazione -->
			<h2><a href="login.php">Logout</a></h2>
		</div>
	</div>
		<div class="clearfix"> </div>
	</div>

	<div class="logo-container">   <!-- inserimento logo (c'e' il background in css) -->
   <a href="https://goprojectunipr.altervista.org"><img src="images/logo.png"></a>
</div>
<!-- //header -->
		
<!-- login -->
				<?php
				$UsernameDB = $_SESSION["Username"];

		// NOME QUERY 
				$PasswordDB = "

		SELECT C.Password
		FROM CLIENTE AS C 
		WHERE '$UsernameDB' LIKE C.Username

		";
	
		$result0 = $conn->query($PasswordDB);
		$row0 = $result0->fetch_assoc();

		// NOME QUERY 
				$NameDB = "

		SELECT C.Nome
		FROM CLIENTE AS C 
		WHERE '$UsernameDB' LIKE C.Username

		";
	
		$result1 = $conn->query($NameDB);
		$row1 = $result1->fetch_assoc();


		// COGNOME QUERY	
		$CognomeDB = "

		SELECT C.Cognome
		FROM CLIENTE AS C 
		WHERE '$UsernameDB' LIKE C.Username

		";
	
		$result2 = $conn->query($CognomeDB);
		$row2 = $result2->fetch_assoc();

		// INDIRIZZO QUERY	
		$IndirizzoDB = "

		SELECT C.Indirizzo
		FROM CLIENTE AS C 
		WHERE '$UsernameDB' LIKE C.Username

		";
	
		$result3 = $conn->query($IndirizzoDB);
		$row3 = $result3->fetch_assoc();

		// TELEFONO QUERY	
		$TelefonoDB = "

		SELECT C.Telefono
		FROM CLIENTE AS C 
		WHERE '$UsernameDB' LIKE C.Username

		";

		$result4 = $conn->query($TelefonoDB);
		$row4 = $result4->fetch_assoc();

		// EMAIL QUERY	
		$EmailDB = "

		SELECT C.Email
		FROM CLIENTE AS C 
		WHERE '$UsernameDB' LIKE C.Username

		";
	
	
		$result5 = $conn->query($EmailDB);
		$row5 = $result5->fetch_assoc();

				 ?>

			<div class="w3_login_module">
				<div class="module form-module">

				  <div class="toggle">  <!-- box bianco con form di login -->
				  </div>

				  <div class="form">
					  <h2>Il tuo Profilo</h2>
					<form action="profilo.php" method="post">
					  <?php echo "Username: ".$_SESSION["Username"]." " ?>
					  <br>
					  <br>
					  <input type="password" name="Password" value="<?php echo $row0["Password"]; ?>" placeholder="Password" required=" " id="Password">
					  <input type="text" name="Nome" value="<?php echo $row1["Nome"]; ?>" placeholder= "Nome"  required=" " id="Nome">
					  <input type="text" name="Cognome" value="<?php echo $row2["Cognome"]; ?>" placeholder="Cognome" required=" " id="Cognome">
					  <input type="text" name="Indirizzo" value="<?php echo $row3["Indirizzo"]; ?>" placeholder="Indirizzo" required=" " id="Indirizzo">
					  <input type="text" name="Telefono" value="<?php echo $row4["Telefono"]; ?>" placeholder="Telefono" required=" " id="Telefono">
					  <input type="email" name="Email" value="<?php echo $row5["Email"]; ?>" placeholder="Email" required=" " id="Email">
					  <input type="submit" value="Modifica">
					</form>
				  </div>
				  <div class="cta"><a href="ordini.php">Visualizza ordini e buoni</a></div>
				</div>

			<?php
                $Username = $_SESSION["Username"];
				$Password = mysqli_real_escape_string($conn, $_REQUEST['Password']);
				$Nome = mysqli_real_escape_string($conn, $_REQUEST['Nome']);
				$Cognome = mysqli_real_escape_string($conn, $_REQUEST['Cognome']);
				$Indirizzo = mysqli_real_escape_string($conn, $_REQUEST['Indirizzo']);
				$Telefono = mysqli_real_escape_string($conn, $_REQUEST['Telefono']);
				$Email = mysqli_real_escape_string($conn, $_REQUEST['Email']);

				if($_POST["Password"]!= "" && $_POST["Nome"] != "" && $_POST["Cognome"] != "" && $_POST["Indirizzo"] != "" && $_POST["Telefono"] != "" && $_POST["Email"] != ""){

				$sql = "

				UPDATE CLIENTE 
				SET Password = '$Password',  Nome = '$Nome', Cognome = '$Cognome', Indirizzo = '$Indirizzo', Telefono = '$Telefono', Email = '$Email'
				WHERE Username = '$Username'

				";
			}

			 if(mysqli_query($conn, $sql)){
   				$message = "Dati modificati con successo!";
				echo "<script type='text/javascript'>alert('$message'); window.location = './profilo.php';</script>";
				//RICARICA LA PAGINA DOPO L'OK DEL MESSAGGIO ALERT (CHE FA DA DEBUG, INDICA CHE SIA AVVENUTA CON SUCCESSO)


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