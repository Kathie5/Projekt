
<html>
	<head>
	<title>Login-Fenster</title>
	<style>
	body {
	font-family: Arial, Helvetica, sans-serif;
	margin-left: 500px;
	margin-right: 500px;
	margin-top: 250px;

	}
	form {
	border-width: 10px 
	border-style:solid 
	border-color:schwarz;
	
	}
	
	
	input [type=text], input [type=passwort]{
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
	}
	button {
		background color: darkorange;
		color: orange;
		padding: 14px 60px;
		margin-left: 50px;
		margin-right:10px;
		border: none;
		cursor: pointer;
		width: 33,33%;
	}
	
	button:hover {
		opacity: 1; 
	}
	
</style>
	</head>
	<body>
	

		
		
		<form action="login2.php" method="get" >
		
		<!--<div class="Bild">
			img src=".png" alt= "Logo" class="logo">
			</div>-->
		
		<div style="background-color: orange";class="Anmeldung">
		<p>
		E-Mail: 
		<input type="text" placeholder="Gib deine E-Mail-Adresse ein" size="35" name="email">
		</p>
		<p>
		Passwort: 
		<input type="password" placeholder="Gib dein Passwort ein" size="35" name="passwort"><br>
		</p>
		<p>
		<button type="submit">Login </button> 
		</p>
		</form>
		<a href="Registration.php">Noch nicht angemeldet? Registrieren</a>
		
		</div>
		

	</body>
</html>