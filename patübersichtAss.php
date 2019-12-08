<html>
<head>
<meta charset="utf-8">
		<title>Patientenübersicht</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<style>
.tabellentext {
    vertical-align: middle !important;
	text-align:justify;

	
	}
</style>
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
$sql = "SELECT p.uid, p.vorname,p.nachname,MAX (h.date) FROM patientendata AS p INNER JOIN user AS u ON p.uid=u.id INNER JOIN healthdata AS h  ON u.id = h.uid ";
if ($erg = $db->query($sql)) {
    while ($datensatz = $erg->fetch_object()) {
        $daten[] = $datensatz;
    }
}
?>
<div data-role="main" class="ui-content">
  	<h1>Patientenübersicht</h1>
    <table style="width:100%"id="meineTabelle" data-role="table" class="ui-responsive" data-mode="columntoggle" data-column-btn-text="Spalten" >
      <thead>
        <tr>
          <th data-priority="4">ID</th>
          <th data-priority="3">Nachname</th>
          <th data-priority="1">Vorname</th>
          <th data-priority="2">letzterEintrag</th> 
        </tr>
      </thead>
      <tbody>
	
	
    <?php

    foreach ($daten as $inhalt) {
    ?>
        <tr>
            <td class="tabellentext">
                <?php echo $inhalt->p.uid; ?>
            </td>
           <td>
                <?php 
                // echo $inhalt->datum;
                echo '<a data-ajax="false" data-role="button" href="detail.php?id=';
                echo $inhalt->p.uid;
                echo '">';
                echo ($inhalt->p.nachname); 
                echo '</a>';                
                ?>
            </td>
            <td class="tabellentext">
                <?php echo $inhalt->p.vorname; ?>
            </td>
            <td class= "tabellentext">
                <?php echo $inhalt->h.date; ?>
            </td>
			
                
      </tr>
    <?php
    }
    ?>
      </tbody>
    </table>
</body>
</html>