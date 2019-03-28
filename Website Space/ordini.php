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
			<form action="ordini.php" method="post">
				<input type="text" name="Product" value="Cerca un prodotto..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cerca un prodotto...';}" required="" id="search">
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
				// query
				$UsernameDB = $_SESSION["Username"];
				$sqlSearchOrder ="
				SELECT O.IDOrdine, sum(O.Importo) as Importo
				FROM ORDINE AS O
				WHERE O.Cliente = '$UsernameDB'
              	GROUP BY O.IDOrdine

				";

$resultSqlSearchOrder = $conn->query($sqlSearchOrder);
$groupBy = []; 

while ($rowSqlSearchOrder = $resultSqlSearchOrder->fetch_assoc())
{

	//echo "importo:".$rowSqlSearchOrder['Importo']."";
    
    $groupSearch = $rowSqlSearchOrder["IDOrdine"]; 
    $groupBy[$groupSearch][] = $rowSqlSearchOrder; 
}

$sqlSearchBuoni ="
SELECT B.IDBuonoSconto as BuonoID 
FROM BUONOSCONTO AS B
WHERE B.Cliente = '$UsernameDB'
";

$resultSqlSearchBuoni = $conn->query($sqlSearchBuoni);

				 ?>

			<div class="w3_login_module">
				<div class="module form-module">

				  <div class="toggle">  <!-- box bianco con form di login -->
				  </div>

				  <div class="form">
					  <h2>I tuoi ordini</h2>
				
					  <p>
					  	<?php 
					  	foreach($groupBy as $current_ord => $ord_rows)
						{
							?>
						<p>
							<?php
    						echo "Ordine n.{$current_ord}\n";


  								  foreach($ord_rows as $rowSqlSearchOrder)
   									 {
      									  echo " - Totale: ".$rowSqlSearchOrder['Importo']."\n";
      									 			
      
    								}
    								?>
    								</p>
    								<?php
						}
						?>
						<br>
						 <h2>I tuoi buoni</h2>
						 <p>
						 <?php

						while ($rowSqlSearchBuoni = $resultSqlSearchBuoni->fetch_assoc())
						{		
    
   							 $groupSearchBuono = $rowSqlSearchBuoni['BuonoID']; 
   							 echo "ID Buono: ".$groupSearchBuono."\n";


   							?>
   							 </p>
   							 <?php
						} 

						?>
					

				  </div>
				  <div class="cta"><a href="index.php">Torna alla Homepage</a></div>
				</div>

			<?php
           // altra query

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