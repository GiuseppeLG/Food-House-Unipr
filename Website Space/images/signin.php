<?php
$servername = "";
$username = "goprojectunipr";
$password = "";
$dbname = "my_goprojectunipr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
		
		<div class="w3l_search">    <!-- barra di ricerca -->
			<form action="#" method="post">
				<input type="text" name="Product" value="Cerca un prodotto..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cerca un prodotto...';}" required="">
				<input type="submit" value=" ">
			</form>
		</div>

		<div class="product_list_header">   <!-- carrello -->
			<form action="#" method="post" class="last">
                <fieldset>
                    <input type="hidden" name="cmd" value="_cart" />
                    <input type="hidden" name="display" value="1" />
                    <input type="submit" name="submit" value="Guarda Carrello" class="button" />
                </fieldset>
            </form>
		</div>
		
		<div class="w3l_header_right1">  <!-- login/registrazione -->
			<h2><a href="login.html">Entra!</a></h2>
		</div>
		<div class="clearfix"> </div>
	</div>

	<div class="logo-container">   <!-- inserimento logo (c'e' il background in css) -->
  <img src="images/logo.png">
</div>
<!-- //header -->
		
<!-- login -->
				
			<div class="w3_login_module">
				<div class="module form-module">

				  <div class="toggle">  <!-- box bianco con form di login -->
				  </div>

				  <div class="form">
					  <h2>Crea un account</h2>
					<form action="#" method="post">
					  <input type="text" name="Username" placeholder="Username" required=" ">
					  <input type="password" name="Password" placeholder="Password" required=" ">
					  <input type="text" name="Nome" placeholder="Nome" required=" ">
					  <input type="text" name="Cognome" placeholder="Cognome" required=" ">
					  <input type="text" name="Telefono" placeholder="Telefono" required=" ">
					  <input type="email" name="Email" placeholder="Email" required=" ">
					  <input type="submit" value="Registrati">
					</form>
				  </div>
				  <div class="cta"><a href="login.html">Hai gia' un account? ACCEDI!</a></div>
				</div>
			
		
		
<!-- //login -->
		</div>
		<div class="clearfix"></div>
		<br>
		<br>
	

<div class="footer">
		<div class="container">
			<div class="col-md-3 w3_footer_grid">
				<h3>LINK UTILI</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="login.html">Sign In / Login</a></li>
					<li><a href="checkout.html">Carrello</a></li>
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>INFORMAZIONI</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="about.html">Chi Siamo</a></li>
				</ul>
			</div>

			<div class="col-md-3 w3_footer_grid">
				<h3>OCCIDENTALI</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="italia.html">Italiana</a></li>
					<li><a href="messico.html">Messicana</a></li>
					<li><a href="grecia.html">Greca</a></li>
					
				</ul>
			</div>

			<div class="col-md-3 w3_footer_grid">
				<h3>ORIENTALI</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="giappone.html">Giapponese</a></li>
					<li><a href="cina.html">Cinese</a></li>
					<li><a href="india.html">Indiana</a></li>
				</ul>
			</div>
			
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //footer -->

<script src="js/minicart.js"></script> <!-- importo il carrello -->
<script>
		paypal.minicart.render();

		paypal.minicart.cart.on('checkout', function (evt) {
			var items = this.items(),
				len = items.length,
				total = 0,
				i;

			// conta il numero di item aggiunti al carrello
			for (i = 0; i < len; i++) {
				total += items[i].get('quantity');
			}

		});

	</script>

</body>
</html>