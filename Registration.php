
<html>
	<head>
	<title>Registration</title>
	<style>
	body {
	font-family: Arial, Helvetica, sans-serif;
	margin-left: 350px;
	margin-right: 350px;
	margin-top: 50px;

	}
	form {
	border-width: 10px 
	border-style:solid 
	border-color:schwarz;
	
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

	
	<form action="Registration2.php?page=2" method="get">
		
		<div style="background-color:orange">
		<fieldset>
			<legend>Registrieren:</legend>
			<p>
			Anrede: <input type="radio" name="anrede" value="Herr" checked>Herr
					<input type="radio" name="anrede" value="Frau ">Frau
			</p>
			
			<p>
			Vorname: <input type="text" name="vorname" size="20">
			</p>
			
			<p>
			Nachname: <input name="nachname" size="20">
			</p>
			
			<p>
			Geburtsdatum: <input type="date" name"gdatum">
			</p>
			
			<p>
			Straße: <input name="straße" size="20"> 
			Hausnummer: <input type="number" name="hausnummer" size="20">
			</p>
			
			<p>
			PLZ: <input type="number" name="plz" size ="20">
			Wohnort: <input name="wort" size="20">
			</p>
			
			<p>
			Email-Adresse: <input type="email" name="email" size="20">
			</p>
			
			<p>
			Passwort: <input type="password" name="passwor" size="20">
			</p>
			
			<p>
			Passwort wiederholen: <input type="password" size="20" name="passwort2"> 
			</p>
			
			<p>
			Telefonnummer: <input type="number" name="tele""size="20">
			</p>
			
			<p>
			Koerpergroeße: <input name="größe" size="20">
			</p>
			
			<p>
			Anfangsgewicht: <input name="agewicht" size="20">
			</p>
			
			<p>
			Blutdruck: 	<input name="bdruck" size="20">
			</p>
			
			<p>
			Puls: <input name="puls" size="20">
			</p>
	
		<button type="submit">Registrieren </button>
		
	</fieldset>
	</div>
	</form>
<?php
    $error = false;
	$anrede =$_GET['anrede'];
	$vorname =$_GET['vorname'];
	$nachname =$_GET['nachname'];
	$gdatum =$_GET['gdatum'];
	$straße =$_GET['straße'];
	$hausnummer =$_GET['hausnummer'];
	$plz =$_GET['plz'];
	$wort =$_GET['wort'];
    $email = $_GET['email'];
    $passwort = $_GET['passwort1'];
    $passwort2 = $_GET['passwort2'];
	$tele =$_GET['tele'];
	$größe =$_GET['größe'];
	$agewicht =$_GET['agewicht'];
	$bdruck =$_GET['bdruck'];
	$puls =$_GET['puls'];
  
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }     
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo "Die Passwörter müssen übereinstimmen. Bitte wiederhole deine Eingabe...<a href=\"Registration.php\">zurück</a><br>";
        $error = true;
    } else 
	{
		$verbindung = mysql_connect ("localhost", "root", "Passwort");//new PDO('mysql:host=localhost;dbname=pluto','root','');
		
		
		mysql_select_db("pluto");
		
		
		
		$abfrage = "SELECT dbe-mail FROM plutouser WHERE dbe-mail = '$email'";
		$ergebnis = mysql_query ($abfrage);
		while ($row = mysql_fetch_object ($ergebnis))
		{
			$error= true;
		}
	}
		if($error=true) {
			echo "Email schon vergeben. Bitte verwenden Sie einen anderen ...<a href=\"Registration.php\">zurück</a><br>";
		} else {
			$eintrag= "INSERT INTO plutouser (dbanrede, dbvorname, dbnachname, dbgdatum, dbstra, dbhausnr, dbplz, dbort, dbe-mail, dbpw, dbtele, dbgröße, dbagewicht, dbbdruck, dbpuls, dbrolle)
			
			VALUES 
			('$anrede','$vorname','$nachname','$gdatum','$straße','$hausnummer','$plz','$wort','$email','$passwort1','$tele','$größe','$agewicht','$bdruck','$puls')";
			$eintraegen = mysql_query($eintrag);
		}
			
			if($eintraegen = true)
			{
				echo "Vielen Dank. Du hast dich nun registriert...<a href=\"Login_Fenster.php\">Jetzt anmelden</a>";
			}
			else 
			{
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
			}
		
?>
	</body>
	</html>