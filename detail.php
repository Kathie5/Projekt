
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<title>Patientenübersicht</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Assistant</h1>
				<a href="patientenübersichtAssistant.php"><i class="fas fa-user-circle"></i>Patientenübersicht</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
<?php
require_once('server.php');
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'patientendb';
// Try and connect using the info above.
$db = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$sql = "SELECT * FROM patientdata";
if ($erg = $db->query($sql)) {
    while ($datensatz = $erg->fetch_object()) {
        $daten[] = $datensatz;
    }
}
?>
<!-- Hier kommt die bearbeiten-Seite -->
<div data-role="page" id="bearbeiten" data-theme="b">
 
  <div data-role="main" class="ui-content">
    <?php
    
      if ( isset($_REQUEST['uid']) and $_REQUEST['uid'] > 0 )
      {
        // laden der Daten
        $id = (INT) $_REQUEST['uid'];
        $sql = "SELECT * FROM patientdata WHERE id = '$uid' ";
        if ($erg = $db->query($sql)) {
          $datensatz = $erg->fetch_object();
        }        
        echo "<h1>Daten ändern</h1>";
      }
      if ( isset($_POST['id']) and $_POST['id'] != '' )
      {
          $vorname    = $_POST['vorname'];
          $nachname= $_POST['nachname'];
		  $geburtsdatum= $_POST['geburtsdatum'];
          $strasse = $_POST['strasse'];
		  $hnummer     = $_POST['hnummer'];
		  $plz     = $_POST['plz'];
		  $ort     = $_POST['ort'];
		  $telefonnummer     = $_POST['telefonnummer'];
		  $mobilnummer     = $_POST['mobilnummer'];
		  $email     = $_POST['email'];
		  
          // Überprüfen, ob neuer Datensatz oder Update eines bestehenden
          if ( ! isset( $_POST['uid'] )) {
            // neuer Datensatz
            echo "<p>Vorname: $vorname";
            echo "<p>Nachname: $nachname";
			 echo "<p>Geburtsdatum: $geburtsdatum";
			  echo "<p>Strasse: $strasse";
			   echo "<p>nummer: $nummer";
			    echo "<p>Plz: $plz";
				 echo "<p>Ort: $ort";
				  echo "<p>Telefonnummer: $telefonnummer";
			echo "<p>Mobilnummer: $mobilnummer";
            echo "<p>Email: $email";
           
            $einfuegen = $db->prepare("INSERT INTO profile
                (vorname, nachname,geburtsdatum,strasse, nummer,plz,ort,telefonnummer, mobilnummer email)
                VALUES (?, ?, ?, ?,?,?,?,?,?,?)");
            $einfuegen->bind_param('ssssssssss', $vorname, $nachname,$geburtsdatum,$strasse,$nummer, $plz,$ort,$telefonnummer, $mobilnummer, $email );
            if ($einfuegen->execute()) {
                echo "<p>Daten werden gespeichert</p>";    
            }
          }
          else
          {
            $updaten = $db->prepare("UPDATE profile SET 
                vorname=?,
                nachname=?,
				geburtsdatum=?,
				strasse=?,
				nummer=?,
				plz=?,
				ort=?,
				telefonnummer=?,
				mobilnummer=?,
                email=?
                
                WHERE id=?" );
            $updaten->bind_param('ssssi', $id, $vorname, $nachname,$geburtsdatum,  $strasse,$nummer,$plz,$ort,$telefonnummer,$mobilnummer, $email );
            if ($updaten->execute()) {
              echo "<p>Daten $id wurden geupdatet - betroffen war davon ";    
            }
            echo $updaten->affected_rows;
            echo " Datensatz</p>";
          }
      }
      else
      {
?>
    <form id="terminaufnehmen" method="post" action="bearbeiten.php">
        <div data-role="fieldcontain">
            <fieldset>
				<p>
                <input type="hidden" name="id" id="id"
                <?php  
                if ( isset($datensatz->id) )
                {
                   echo 'value="'.$datensatz->id .'"'; 
                }
                ?> 
				</p>
                
				<p>
                <label for="vorname">Vorname</label>
                <input type="text" name="vorname" id="vorname"  
                <?php  
                if ( isset($datensatz->vorname) )
                {
                    echo 'value="'. $datensatz->vorname .'"'; 
                }
                ?>
				</p>
                
                <label for="nachname">Nachname</label>
                <input type="text" name="nachname" id="nachname"
                <?php  
                if ( isset($datensatz->nachname) )
                {
                  echo 'value="'. $datensatz->nachname .'"';
                }
                ?>   
				 >
                <label for="geburtsdatum">Geburtsdatum</label>
                <input type="datum" name="geburtsdatum" id="geburtsdatum"
                <?php  
                if ( isset($datensatz->geburtsdatum))
                {
                    echo 'value="'. $datensatz->geburtsdatum .'"';
                }
                ?> 
				>
                <label for="strasse">Strasse</label>
                <input type="text" name="strasse" id="strasse"
                <?php  
                if ( isset($datensatz->strasse))
                {
                    echo 'value="'. $datensatz->strasse .'"';
                }
                ?> 
				>
                <label for="nummer">Nummer</label>
                <input type="text" name="nummer" id="nummer"
                <?php  
                if ( isset($datensatz->hnummer))
                {
                    echo 'value="'. $datensatz->hnummer
                ?> 
				>
                <label for="plz">Plz</label>
                <input type="text" name="plz" id="plz"
                <?php  
                if ( isset($datensatz->plz))
                {
                    echo 'value="'. $datensatz->plz .'"';
                }
                ?> 
				>
                <label for="ort">Ort</label>
                <input type="text" name="ort" id="ort"
                <?php  
                if ( isset($datensatz->ort))
                {
                    echo 'value="'. $datensatz->ort.'"';
                }
                ?> 
				 <label for="telefonnummer">Telefonnummer</label>
                <input type="text" name="telefonnummer" id="telefonnummer"
                <?php  
                if ( isset($datensatz->telefonnummer))
                {
                    echo 'value="'. $datensatz->telefonnummer.'"';
                }
                ?> 
				 <label for="mobilnummer">Mobilnummer</label>
                <input type="text" name="mobilnummer" id="mobilnummer"
                <?php  
                if ( isset($datensatz->mobilnummer))
                {
                    echo 'value="'. $datensatz->mobilnummer.'"';
                }
                ?> 
                
                <label for="email">Email</label>
                <input type="text" name="email" id="email"
                <?php  
                if ( isset($datensatz->email) )
                { 
                  echo 'value="'. $datensatz->email .'"';
                }
                ?>                  
                               
                >
                <input type="submit" value="speichern">
            </fieldset>
        </div>
    </form>   
<?php
        }
    
    
    ?>
  </div>

</div>
</body>
</html>