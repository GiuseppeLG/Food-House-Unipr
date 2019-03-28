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

if(isset($_GET["type"]))  
 { 
 	$localResult = $_GET["type"];
 	//echo "locale: ".$localName." "; debug dynamic mode
 }
 unset ($_SESSION["shopping_cart"]);

?>

<html>
<head>
<title><?php echo $localResult; ?></title>  <!-- importo i css -->
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
			<form action="#" method="post">
				<input type="text" name="Product" value="Cerca un prodotto..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cerca un prodotto...';}" required="">
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

<!-- dove stanno le immagini -->
<br>
<div class="w3l_banner_nav_right">

	<?php  
 	// cerca tutti i locali che hanno come tipo di cucina $localResult (dal get della pagina).
			 $queryLocal = "

                SELECT * 
                FROM LOCALE
                WHERE Tipo = '$localResult' 

                ";
        

                $resultLocal = mysqli_query($conn, $queryLocal);  
                if(mysqli_num_rows($resultLocal) > 0)  
                {  
                     while($rowLocal = mysqli_fetch_array($resultLocal))  
                     {  
                     	 ?>

                     	<div class="col-md-4 w3l_banner_nav_right_banner3_btml">
					<a href="locale.php?local=<?php echo $rowLocal["Nome"];?>"> <div class="view view-tenth">
						<img src="<?php echo "images/".$rowLocal["foto"].""; ?>" alt=" " class="img-responsive" />
						<div class="mask">
							<h4><?php echo $rowLocal["Nome"]; ?></h4>
							<p><?php echo $rowLocal["Indirizzo"]; ?></p>
							<p><?php echo "Apertura: ".$rowLocal["OrarioA"]."";?></p>
							<p><?php echo "Chiusura: ".$rowLocal["OrarioC"]."";?></p>
						</div>
					</div></a> <!-- /a per la chiusura del link ad immagine -->
				</div> <!-- per la chiusura della prima classe dei riquadri -->
				<?php 
                     }
                 }
              	 ?>
			
				
				
			
			<div class="clearfix"> </div>
		</div>

<!-- /dove stanno le immagini-->

		</div>
		<div class="clearfix"></div>
	</div>

<div class="clearfix"> </div>

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