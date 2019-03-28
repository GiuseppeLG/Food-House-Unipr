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
<head>
<title>Chi Siamo</title>  <!-- importo i css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
	
	<body>

<!-- header -->
	<div class="agileits_header"> 
		<div class="w3l_header_right1"> 
		<?php
				if($_SESSION["Username"]!=""){
			 echo "<h2><a href=\"profilo.php\">".$_SESSION["Username"]."</a></h2>";
				 }
		 ?>
	</div>
		<div style="max-height:47px;overflow:auto;">
	 <!-- barra superiore nera -->

		<div class="w3l_search"> 

		   <!-- barra di ricerca -->
			<form action="index.php" method="post">
				<input type="text" name="search" value="Cerca un prodotto..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cerca un prodotto...';}" required="" id=search>
				<input type="submit" value=" ">
			</form>
		</div>

		<?php
		$search = mysqli_real_escape_string($conn, $_REQUEST['search']);
		$sql = "

		SELECT L.Nome 
		FROM DISTRIBUZIONE AS D, LOCALE AS L, PRODOTTO AS P 
		WHERE '$search' LIKE P.Nome
		AND P.IDProdotto = D.Prodotto
		AND D.Locale = L.IDLocale

		";
		if($_POST["search"] != ""){
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // $result2 = str_replace(' ','_',$row["Nome"]);
    	//echo $row["Nome"];
    	 unset ($_SESSION["shopping_cart"]);
        header("location:locale.php?local=".$row["Nome"]."");
    	}
	} else {
    	$message = "Prodotto non trovato!";
		echo "<script type='text/javascript'>alert('$message');</script>";
}
}

?>


		<div class="w3l_header_right1"> 
		 <!-- login/registrazione -->
		
<?php
if($_SESSION["Username"]!=""){
	echo "<h2><a href=\"profilo.php\">Profilo</a></h2>";
}
else{
	echo "<h2><a href=\"login.php\">Entra!</a></h2>";
}

?>
		
		</div>
		<div class="clearfix"> </div>
	</div>
	</div>

	<div class="logo-container">   <!-- inserimento logo (c'e' il background in css) -->
  <a href="https://goprojectunipr.altervista.org"><img src="images/logo.png"></a>
</div>	
<!-- //header -->
<br>
	<div class="banner">
		<div class="w3l_banner_nav_left">
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs"> 

					<ul class="nav navbar-nav nav_1">
						<li><a>CUCINE</a></li> 
						<li><a href="cucina.php?type=italia">Italiana</a></li>
						<li><a href="cucina.php?type=cina">Cinese</a></li>	
						<li><a href="cucina.php?type=india">Indiana</a></li>			
						<li><a href="cucina.php?type=messico">Messicana</a></li>
						<li><a href="cucina.php?type=grecia">Greca</a></li>
						<li><a href="cucina.php?type=giappone">Giapponese</a></li>
					</ul>
				 </div>
			</nav>  <!-- /.navbar-collapse -->
		</div>

			
				<!-- LISTA IMMAGINI CUCINE CON LINK -->
							<a href="cucina.php?type=italia">
							 <img src="images/italy.jpg"> </a>
							 <a href="cucina.php?type=cina">
							  <img src="images/china.jpg"></a>
							  <a href="cucina.php?type=india">
							   <img src="images/india.jpg"></a>
							   <a href="cucina.php?type=messico">
							    <img src="images/mexico.jpg"></a>
							    <a href="cucina.php?type=grecia">
							     <img src="images/greece.jpg"></a>
							     <a href="cucina.php?type=giappone">
							      <img src="images/japan.jpg"></a>

		</div>
		<div class="clearfix"></div>
	</div>
	<br>
<!-- //banner -->
<!-- team -->
	<div class="team">
		<div class="container">
		<!-- about -->
		
			<h3>Chi Siamo</h3>
			<p class="animi">Food House Unipr e' un progetto universitario sviluppato in febbraio 2018 da due giovani studenti: Giuseppe La Gualano e Giorgio Fanelli. L'obbiettivo principale del sito e' fornire una piattaforma e-commerce, basata sul campo ristorazione, che permetta la completa interazione utente e la gestione dei dati mediante pagine dinamiche.</p>
			<div class="agile_about_grids">
				<div class="col-md-6 agile_about_grid_right">
					<img src="images/31.jpg" alt=" " class="img-responsive" />
				</div>
				<div class="col-md-6 agile_about_grid_left">
					<ol>
						<li>Creazione di Account</li>
						<li>Modifica Account</li>
						<li>Scelta cucine e locali</li>
						<li>Acquisto prodotti</li>
						<li>Ricezione ed applicazione buoni sconto</li>
						<li>Visualizzazioni Ordini e Buoni</li>
					</ol>
				</div>
				<div class="clearfix"> </div>
			</div>
		
<!-- //about -->
<br>
<br>

			<h3>Il Nostro Team</h3>
			
			<div class="agileits_team_grids">
				<div class="col-md-3 agileits_team_grid">
				</div>
				<div class="col-md-3 agileits_team_grid">
					<img src="images/giuseppe.jpeg" alt=" " class="img-responsive" />
					<h4>Giuseppe La Gualano</h4>
					<p>Founder</p>

				</div>
				
				<div class="col-md-3 agileits_team_grid">
					<img src="images/giorgio.jpeg" alt=" " class="img-responsive" />
					<h4>Giorgio Fanelli</h4>
					<p>Founder</p>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //team -->


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
					<li><a href="https://w3layouts.com/">W3layouts</a></li>
					
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