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

 if(isset($_GET["local"]))  
 { 
 	$localResult = $_GET["local"];
 	//echo "locale: ".$localResult." "; //debug dynamic mode
 }

 if(isset($_POST["add_to_cart"]))   //Quando clicco su aggiungi al carrello
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["IDProdotto"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);   // aggiungo gli attributi dei prodotti al vettore
                $item_array = array(  
                     'item_id'               =>     $_GET["IDProdotto"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
            // se il prodotto e' gia' presente, va reinserita la quantita' giusta
            // cosi' facendo, evito di dover scorrere il vettore per cambiare la quantita' 
                echo '<script>alert("Prodotto presente, rimuovilo e riseleziona il numero giusto! ")</script>';  
                echo '<script>window.location="locale.php" + this.localResult.value</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["IDProdotto"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }

 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["IDProdotto"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Prodotto rimosso")</script>';  
                     echo '<script>window.location="locale.php" + this.localResult.value</script>';  

                }  
           }  
      } 
 }  

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
    // Se non trova il prodotto allora mostra l'alert
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


<!-- banner -->
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

			</nav>

		</div>


		<div class="w3l_banner_nav_right">
			
			 <?php   // In base alla variabile $localResult (il nome del locale), cerco le informazioni riguardo i prodotti contenuti in esso.

			
               $queryCart = "

                SELECT P.IDProdotto, P.Nome, P.Prezzo, P.Descrizione, P.foto 
                FROM PRODOTTO AS P, DISTRIBUZIONE AS D , LOCALE AS L
                WHERE P.IDProdotto = D.Prodotto
                AND D.Locale = L.IDLocale
                And L.Nome = '$localResult'

                ";  

                $resultCart = mysqli_query($conn, $queryCart);  //provo connessione e query
                if(mysqli_num_rows($resultCart) > 0)  //se trovo risultati allora...
                {  
                     while($row = mysqli_fetch_array($resultCart))  
                     {  // scorro i risultati della query e mostro n prodotti con questo format.
              	  ?>  
				
					<div class="col-md-3 w3ls_w3l_banner_left w3ls_w3l_banner_left_asdfdfd">

				


						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid1">


								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<img src="<?php echo "images/".$row["foto"].""; ?>" alt=" " class="img-responsive" />
											<p><?php echo $row["Nome"]; ?></p>
											<h4>€<?php echo $row["Prezzo"]; ?></h4>
											<p><?php echo $row["Descrizione"]; ?></p>
										</div>
										<div class="snipcart-details">
											<form action="locale.php?local=<?php echo $localResult;?>&action=add&IDProdotto=<?php echo $row["IDProdotto"]; ?>" method="post">
												<fieldset>
													 <input type="text" name="quantity" class="form-control" value="1" />  
													  <input type="hidden" name="hidden_name" value="<?php echo $row["Nome"]; ?>" />  
                              						  <input type="hidden" name="hidden_price" value="<?php echo $row["Prezzo"]; ?>" />  
													 <br>
													<input type="submit" name="add_to_cart" value="Add to cart" class="button" />
												</fieldset>
											</form>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
<br>
				 
					</div>
						<?php  
            // FINE della parte riguardo il ciclo dei singoli prodotti 
                    }  
               	 }  
                ?> 


				</div>
		
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->

<div style="color:#0000FF" class="table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="20%">Nome Prodotto</th>  
                               <th width="10%">Quantita'</th>  
                               <th width="20%">Prezzo</th>  
                               <th width="15%">Totale</th>  
                               <th width="25%">Azione</th>  
                       
                          </tr>  
                          <?php   

                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               //$total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  

                                if(isset($_POST["Buono"])){ // se e' impostato il buono sconto

                       
            

                            $values["item_price"] = ($values["item_price"] - ($values["item_price"]/100)*5);
                           // echo $values["item_price"]; // debug

                          
                        } // Procedo con la rimozione degli item, specularmente all'add.
                          ?>   
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td>€ <?php echo $values["item_price"]; ?></td>  
                               <td>€ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="locale.php?local=<?php echo $localResult;?>&action=delete&IDProdotto=<?php echo $values["item_id"]; ?>"><span class="text-danger">Rimuovi</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  

                               }  

                          ?>  
                          <tr>  
                 
                               <td colspan="3">

                               	<?php 
                              
                               	if(isset($_POST["Buono"]))  
 										{  
                       

 											$sessionUsername = $_SESSION["Username"];
 											$sessionBuono = $_POST["Buono"];

                      //Cerco se il buono esiste ed e' associato all'utente corrente.
 										 $buonoQuery = "
 										 SELECT B.Valore
 										 FROM BUONOSCONTO AS B, CLIENTE AS C
 										 WHERE C.Username = B.Cliente 
 										 AND B.Cliente = '$sessionUsername'
 										 AND B.IDBuonoSconto = '$sessionBuono'

 										 ";

										$resultBuonoQuery = $conn->query($buonoQuery);

										if ($resultBuonoQuery->num_rows > 0) { //Se esiste allora mostro alert ed applico sconto
                  
echo '<script>alert("Sconto del 5% applicato!")</script>';
   										 
echo "				    <a>";
echo "				    <br>";
echo "                  <div style align=\"right\" class =\"form\">\n";
echo "					 <h4>Buono sconto applicato!</h4>  ";
echo "					</form>\n";
echo "				  </div>\n";
echo "				</a>";
		//$total = ($total -($total/100)*5); // calcolo del totale, debug
//echo "buono sconto id:".$sessionBuono.""; // debug
$_SESSION["Buono"] = $sessionBuono;
//echo "buono sconto sessione:".$_SESSION["Buono"].""; // debug

		
 							}
 								else{ // se non esiste allora mostro errore.
                 
 									echo '<script>alert("Buono sconto non trovato!")</script>'; 
 									echo "				    <a>";
echo "				    <br>";
echo "                  <div style align=\"right\" class =\"form\">\n";
echo "					<form action=\"\" method=\"post\">\n";
echo "					  <input type=\"text\" name=\"Buono\" placeholder=\"Buono Sconto\" id=\"Buono\" required=\"\">\n";
echo "					  <input type=\"submit\" value=\"Applica\">\n";
echo "					</form>\n";
echo "				  </div>\n";
echo "				</a>";

 								}
 							}

 								else{

                 // forma standard del box riguardo il buono sconto.
echo "				    <a>";
echo "				    <br>";
echo "                  <div style align=\"right\" class =\"form\">\n";
echo "					<form action=\"\" method=\"post\">\n";
echo "					  <input type=\"text\" name=\"Buono\" placeholder=\"Buono Sconto\" id=\"Buono\" required=\"\">\n";
echo "					  <input type=\"submit\" value=\"Applica\">\n";
echo "					</form>\n";
echo "				  </div>\n";
echo "				</a>";

 								}
                               	?>
                           </td>
				
				<td align="center">
					<br>
					<b>

					Totale: € <?php echo number_format($total, 2); ?></b></td>  
                             
                 <td  align="center"> 
                 	<br>
							<a>
				  <div style align="center" class ="form">
					<form action="locale.php?local=<?php echo $localResult;?>&action=ordine" method="post">
					  <input type="submit" value="ORDINA">
					</form>
				  </div>
				</a>

                               </td>
                             
                          </tr>  
		

                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>


		<div class="clearfix"></div>
	</div>

	<?php

	   if($_GET["action"] == "ordine")  
      {  
      	$dataCorrente = date("Y/m/d");
      	echo '<script>alert("Ordine Effettuato!")</script>';
        

      	if ($total > 20){
      		echo '<script>alert("Aggiunto buono sconto al tuo profilo!")</script>';

      		// as maxid perche' altrimenti non funziona la stampa in echo "Buono: " . $rowSearchIDBuono['MaxID']. "<br>";
			$sessionUsername = $_SESSION["Username"];

      		$sqlSearchIDBuono = "
      		SELECT MAX(IDBuonoSconto) AS MaxID 
      		FROM BUONOSCONTO AS B
      		WHERE B.Cliente = '$sessionUsername'
      		";

				
		$resultSearchIDBuono = $conn->query($sqlSearchIDBuono);

if ($resultSearchIDBuono->num_rows > 0) {
    // output data of each row
 $sessionUsername = $_SESSION["Username"];
    while($rowSearchIDBuono = $resultSearchIDBuono->fetch_assoc()) {
    	 $rowSearchIDBuono['MaxID']++; //incremento l'ID del buono sconto in modo da poterne inserire uno diverso con sicurezza.
    	 $incrementID = $rowSearchIDBuono['MaxID'];
        
        // INSERISCO IL BUONO SCONTO NEL DATABASE
        $sqlInsertBuono = "
      		INSERT INTO BUONOSCONTO (IDBuonoSconto, Cliente, Valore) VALUES ('$incrementID', '$sessionUsername', '5')
      		";
      		$conn->query($sqlInsertBuono);

    }   // chiusura while

} // chiusura if

} // chiusura total

echo '<script>window.location="ordini.php"</script>';

$sessionUsername = $_SESSION["Username"]; // richiamo il session username per controllo

// Cerco il numero massimo di IDOrdine in modo da poterlo incrementare negli ordini successivi e non avere duplicati.
	$sqlSearchIDOrdine = "
      		SELECT MAX(IDOrdine) AS MaxIDOrdine 
      		FROM ORDINE AS O
      		WHERE O.Cliente = '$sessionUsername'
      		";

				
		$resultSearchIDOrdine = $conn->query($sqlSearchIDOrdine);

if ($resultSearchIDOrdine->num_rows > 0) {
    // PER INCREMENTARE L'ID ORDINE, procedo come per IDBuonoSconto.
 $sessionUsername = $_SESSION["Username"];
    while($rowSearchIDOrdine = $resultSearchIDOrdine->fetch_assoc()) {
    	 $rowSearchIDOrdine['MaxIDOrdine']++; //incremento l'ID deLL'ordine in modo da poterne inserire uno diverso con sicurezza.
    	 $incrementIDOrdine = $rowSearchIDOrdine['MaxIDOrdine']; //assegno il risultato alla variabile increment.
    	
    			$dataCorrente = date("Y/m/d"); //CALCOLO LA DATA CORRENTE DA INSERIRE NELL'ORDINE

            // In base al valore dinamico (&local=$localResult) , ricavo l'IDLocale che mi servira' da inserire nell'ordine.
      			$sqlLocalNameSearch ="
      			SELECT L.IDLocale
      			FROM LOCALE AS L
      			WHERE '$localResult' = L.Nome
      			";

      			$resultLocalNameSearch = $conn->query($sqlLocalNameSearch);
      			$rowLocalNameSearch = $resultLocalNameSearch->fetch_assoc();

				// INSERISCO L'ORDINE NEL DATABASE
      			 // SCORRO L'ARRAY PER OGNI PRODOTTO INSERITO...
      			//CICLO FOREACH PER SCORRERE I VETTORI ED INSERIRE ORDINI CAMBIANDO VARIABILI. (AGGIUNGERE ATTRIBUTO QUANTITA' E IMPORTO PARZIALE)
    	    
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                            //echo "prova1: ".$values["item_price"].""; // debug
                               //$total = 0;   // debug
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               { 
                                //  echo "prova2: ".$values["item_price"].""; // debug
                                  //echo "buono sconto:".$_SESSION["Buono"].""; // debug

                  if($_SESSION["Buono"] != ""){      
                     foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               { 
                                // calcolo riguardo lo sconto (5% default)
                            $values[item_price] = (($values[item_price] - ($values[item_price]/100)*5) * $values[item_quantity]);
                             //$values[item_price] = ($values[item_quantity] * $values[item_price]); // debug
                          //  echo "prova3: ".$values["item_price"].""; // debug
                           // echo "buono inserted successfully."; // debug
                        
                           
                           // INSERISCO TUTTE LE VARIABILI MODIFICATE ALL'INTERNO DELLA TABELLA ORDINE , CICLICAMENTE.
                $sqlOrdine = "
                          
				INSERT INTO ORDINE (IDOrdine, Locale, Prodotto, Cliente, Data, Quantita, Importo) 
				VALUES ('$incrementIDOrdine', '$rowLocalNameSearch[IDLocale]', '$values[item_id]','$sessionUsername', '$dataCorrente', '$values[item_quantity]','$values[item_price]')
				";

				
			 if(mysqli_query($conn, $sqlOrdine)){
   				 //echo "Records inserted successfully."; // inserire alert e redirect... 
          // IL CARRELLO SI AZZERA SOPRA, QUANDO SI RICHIAMA "action=ordine"
			 
         $sessionBuono = $_SESSION["Buono"]; // per passare il valore alla query
          //unset($_SESSION["Buono"]);

   				// RIMUOVO DAL DATABASE IL BUONO SCONTO EVENTUALMENTE UTILIZZATO

          $deleteBuonoSconto = "

          DELETE FROM BUONOSCONTO
          WHERE BUONOSCONTO.IDBuonoSconto = '$sessionBuono' 
          AND BUONOSCONTO.Cliente = '$sessionUsername'

          ";

          $conn->query($deleteBuonoSconto);

          unset($_SESSION["Buono"]); //unset sessione buono.
				

			} else{
   				 //echo "ERROR: Could not able to execute $sqlOrdine. " . mysqli_error($conn); // debug
				}
    } // chiusura foreach dentro if session buono

}// if buono post
    else { // senza buono sconto

      $values[item_price] = ($values[item_quantity] * $values[item_price]);

$sqlOrdine = "
                          
        INSERT INTO ORDINE (IDOrdine, Locale, Prodotto, Cliente, Data, Quantita, Importo) 
        VALUES ('$incrementIDOrdine', '$rowLocalNameSearch[IDLocale]', '$values[item_id]','$sessionUsername', '$dataCorrente', '$values[item_quantity]','$values[item_price]')
        ";

        
       if(mysqli_query($conn, $sqlOrdine)){
           //echo "Records inserted successfully."; // inserire alert e redirect... 

        // azzero il carrello
         


          // RIMUOVO DAL DATABASE IL BUONO SCONTO EVENTUALMENTE UTILIZZATO

        

      } else{
          // echo "ERROR: Could not able to execute $sqlOrdine. " . mysqli_error($conn); // debug
        }
    


    } // else senza buono sconto

                               } //chiusura foreach 
                         } // chiusura if session cart 

   

				

      } // chiusura while
} // chiusura if

      } // chiusura if action == ordine
      // session_destroy ();
      ?>

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