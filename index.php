<?php 

// DEFINE THE ROOT FOLDER WHERE KELMA SCRIPT IS COPIED
if (!defined('KPATH')) {define('KPATH', dirname( __FILE__ ) . '/');}

// DEFINE FILES AND FOLDERS
define( 'CONFIG', 'config.php' );
define( 'FPDF', 'fpdf.php' );
define( 'INC', KPATH . 'includes/');

$check = file_exists( INC . CONFIG);
function display_marque($parent_id = 0) {
     global $con;
    $query = $con->query('SELECT * FROM marque');
    if(mysqli_num_rows($query) > 0) {
      
         
      echo '<select id="source" name="source" onchange="load_new_content()">';
         while ($marque = mysqli_fetch_array($query)){ 
          $queryv = $con->query('SELECT * FROM vehicule WHERE id_marque = "'.$marque['id_marque'].'"');
           $vehicule = mysqli_fetch_array($queryv);
            if(mysqli_num_rows($queryv) > 0) {
        echo '<optgroup class="slctor" label="'.$marque['NOM'].'">';
        echo '<option class="slctshilde" value="'.$vehicule['id_vehicule'].'">'.$vehicule['version'].'</option>';
        echo ' </optgroup>';
        }
        }
            echo '</select>';

    }
}


require(INC . CONFIG);
require(INC . FPDF);
if(isset($_POST['cree'])){   
if(isset($_POST['FULL_NAME']) && !empty($_POST['FULL_NAME']) && isset($_POST['BIRTHDATE']) && !empty($_POST['BIRTHDATE'])){
//                                         |
//         ________________________________|_______________________________
//        |                                                                | 
//   TABLE CLIENT                                                TABLE CONDUCTEUR
  $FULL_NAME = $_POST['FULL_NAME'];                         $CFULL_NAME = $_POST['CFULL_NAME'];
  $BIRTHDATE = $_POST['BIRTHDATE'];                         $CBIRTHDATE = $_POST['CBIRTHDATE'];
  $CIN = $_POST['CIN'];                                     $CCIN = $_POST['CCIN'];
  $CIN_DATE_V = $_POST['CIN_DATE_V'];                       $CCIN_DATE_V = $_POST['CCIN_DATE_V'];
  $CIN_DATE_EX = $_POST['CIN_DATE_EX'];                     $CCIN_DATE_EX = $_POST['CCIN_DATE_EX'];
  $PASSEPORT = $_POST['PASSEPORT'];                         $CPASSEPORT = $_POST['CPASSEPORT'];
  $PASS_DATE_V = $_POST['PASS_DATE_V'];                     $CPASS_DATE_V = $_POST['CPASS_DATE_V'];
  $PASS_DATE_EX = $_POST['PASS_DATE_EX'];                   $CPASS_DATE_EX = $_POST['CPASS_DATE_EX'];
  $PERMIS = $_POST['PERMIS'];                               $CPERMIS = $_POST['CPERMIS'];
  $PERMIS_DATE_V = $_POST['PERMIS_DATE_V'];                 $CPERMIS_DATE_V = $_POST['CPERMIS_DATE_V'];
  $PERMIS_GOTIN = $_POST['PERMIS_GOTIN'];                   $CPERMIS_GOTIN = $_POST['CPERMIS_GOTIN'];
  $PHONE = $_POST['PHONE'];                                 $CPHONE = $_POST['CPHONE'];
  $MOBILE = $_POST['MOBILE'];                               $CMOBILE = $_POST['CMOBILE'];
  $ADRESSE = $_POST['ADRESSE'];                             $CADRESSE = $_POST['CADRESSE']; 
//         |__________________________        ______________________________|
//                                    |      |                        
//             INSERTION DES INFOS SUR LA TABLE *CLIENT* ET * CONDUCTEUR                                                                   
//                                    |      |   
$con->query('INSERT INTO client (FULL_NAME, BIRTHDATE, CIN, CIN_DATE_V, CIN_DATE_EX, PASSEPORT, PASS_DATE_V, PASS_DATE_EX, PERMIS, PERMIS_DATE_V, PERMIS_GOTIN, PHONE, MOBILE, ADRESSE) VALUES ("'.$FULL_NAME.'", "'.$BIRTHDATE.'", "'.$CIN.'", "'.$CIN_DATE_V.'", "'.$CIN_DATE_EX.'", "'.$PASSEPORT.'", "'.$PASS_DATE_V.'", "'.$PASS_DATE_EX.'", "'.$PERMIS.'", "'.$PERMIS_DATE_V.'", "'.$PERMIS_DATE_V.'", "'.$PHONE.'", "'.$MOBILE.'", "'.$ADRESSE.'")') or die("MySQL Error: " . mysqli_error($con));
//                                           |
//                                           | INSERT IN TABLE CONDUCTEUR
$con->query('INSERT INTO conducteur (FULL_NAME, BIRTHDATE, CIN, CIN_DATE_V, CIN_DATE_EX, PASSEPORT, PASS_DATE_V, PASS_DATE_EX, PERMIS, PERMIS_DATE_V, PERMIS_GOTIN, PHONE, MOBILE, ADRESSE) VALUES ("'.$CFULL_NAME.'", "'.$CBIRTHDATE.'", "'.$CCIN.'", "'.$CCIN_DATE_V.'", "'.$CCIN_DATE_EX.'", "'.$CPASSEPORT.'", "'.$CPASS_DATE_V.'", "'.$CPASS_DATE_EX.'", "'.$CPERMIS.'", "'.$CPERMIS_DATE_V.'", "'.$CPERMIS_DATE_V.'", "'.$CPHONE.'", "'.$CMOBILE.'", "'.$CADRESSE.'")') or die("MySQL Error: " . mysqli_error($con)); 
} }

// MESSAGE TO STYLE REQUIRED INPUTS
$message = " Required";

?>


<html >
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CREE UNE FACTURE - LOCATION</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN CORE CSS FRAMEWORK -->
<link href="assets/css/install.css" rel="stylesheet" type="text/css" media="all"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css">

<!-- BEGIN JS AND JQUERY -->
  <link rel="stylesheet" href="assets/js/bootstrap.min.csss">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.maskedinput.min.js"></script>
<script>

$(document).ready(function(){ var selected_option=$("#source option:selected").val();
$.post("index.php",  {option_value: selected_option},
  function(data) {("#matricule").html(data);
alert(data)});  }

$(document).ready(function(){
$.mask.definitions['~']='[+-]';
  $("#phone").mask("(+999)-99999-9999");
  $("#mobile").mask("(+999)-99999-9999");
  $("#bd").mask("99/99/9999");
  $("#date, #bdcond, #cindatev, #cindatex").mask("99/99/9999");
  $("#time").mask("99:99:99");
  $("#zip").mask("999-999");
  $("#credit").mask("9999/9999/9999/9999");
  $("#tax").mask("99-9999999");
  $("#cin, #cinc").mask("99-999999999");
  $("#pport,#pportc").mask("99-999999999");
  $("#permis, #permisc").mask("99-999999999");
  $("#ssn").mask("999-99-99999");
  $("#coupan").mask("ABCD-9999-9999-9999");
});

  </script>
<!-- BEGIN META TAGS -->

</head>
<body>
<?php 
$step = isset( $_GET['step'] ) ?  $_GET['step'] : 0;

switch($step) {
  case 0:




  ?>

<!-- MESSAGES -->

<main>

<h1>Crée une nouvelle facture</h1>
<div id="content">
<br><br>
<form method="POST" action="">
<div id="partie">
<h3>Informations client</h3>
<div id="bloc">
<label class="col-lg-3 text-right <?php if(isset($_POST['cree']) && empty($_POST['FULL_NAME'])){ echo $message; } ?>" for="nom">Nom et Prénom:</label><input name="FULL_NAME" class="col-lg-6 at" type="text" placeholder="____________________________________________" >
 </div>
<div id="bloc">
  <label class="col-lg-3 text-right" for="date">Date de Naissance:</label><input name="BIRTHDATE" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date">
  </div>
<div id="bloc">
<label class="col-lg-3 text-right" for="cin">N° de CIN:</label><input name="CIN" class="col-lg-6 withmask" type="text" placeholder="__-_________" class="form-control" id="cin"><label class="col-lg-3 text-right" for="date">Valable du:</label><input  name="CIN_DATE_V" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date"><label  class="col-lg-3 text-right" for="date">au:</label><input name="CIN_DATE_EX" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date">
 </div>
 <div id="bloc">
<label class="col-lg-3 text-right" for="pport">N° de Passeport!</label><input name="PASSEPORT" class="col-lg-6 withmask" type="text" placeholder="__-_________" class="form-control" id="pport"><label class="col-lg-3 text-right" for="date">Valable du:</label><input name="PASS_DATE_V" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date"><label class="col-lg-3 text-right" for="date">au:</label><input name="PASS_DATE_EX" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date">
 </div>
<div id="bloc">
<label class="col-lg-3 text-right" for="permis">N° de Permis:</label><input name="PERMIS" class="col-lg-6 withmask" type="text" placeholder="__-_________" class="form-control" id="permis"><label class="col-lg-3 text-right" for="date">Delivrée le:</label><input name="PERMIS_DATE_V" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date"><label class="col-lg-3 text-right" for="date">à</label><input name="PERMIS_GOTIN" class="col-lg-6 ville" type="text"  class="form-control" placeholder="_________________" >
 </div>
<div id="bloc">
<label class="col-lg-3 text-right" for="cin">Adresse:</label><input name="ADRESSE" class="col-lg-6 at" type="text" placeholder="____________________________________________" >
 </div>
 <label class="col-lg-3 text-right" for="phone">Tél:</label><input  name="PHONE" class="col-lg-6 withmask" type="text" placeholder="(____) ____-___" class="form-control" id="phone"><label class="col-lg-3 text-right" for="mobile">GSM</label><input name="MOBILE" class="col-lg-6 withmask" type="text" placeholder="(+___)-_____-____" class="form-control" id="mobile">
 


<div id="bloc">
 <h3>Autre conducteur</h3>
<div id="bloc">
<label class="col-lg-3 text-right" for="nom">Nom et Prénom:</label><input name="CFULL_NAME" class="col-lg-6 at" type="text" placeholder="____________________________________________" >
 </div>
<div id="bloc">
  <label class="col-lg-3 text-right" for="date">Date de Naissance:</label><input name="CBIRTHDATE" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date">
  </div>
<div id="bloc">
<label class="col-lg-3 text-right" for="cin">N° de CIN:</label><input name="CCIN" class="col-lg-6 withmask" type="text" placeholder="__-_________" class="form-control" id="cin"><label class="col-lg-3 text-right" for="date">Valable du:</label><input  name="CCIN_DATE_V" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date"><label  class="col-lg-3 text-right" for="date">au:</label><input name="CCIN_DATE_EX" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date">
 </div>
 <div id="bloc">
<label class="col-lg-3 text-right" for="pport">N° de Passeport!</label><input name="CPASSEPORT" class="col-lg-6 withmask" type="text" placeholder="__-_________" class="form-control" id="pport"><label class="col-lg-3 text-right" for="date">Valable du:</label><input name="CPASS_DATE_V" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date"><label class="col-lg-3 text-right" for="date">au:</label><input name="CPASS_DATE_EX" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date">
 </div>
<div id="bloc">
<label class="col-lg-3 text-right" for="permis">N° de Permis:</label><input name="CPERMIS" class="col-lg-6 withmask" type="text" placeholder="__-_________" class="form-control" id="permis"><label class="col-lg-3 text-right" for="date">Delivrée le:</label><input name="CPERMIS_DATE_V" class="col-lg-6 withmask" type="text" placeholder="__/__/_____" class="form-control" id="date"><label class="col-lg-3 text-right" for="date">à</label><input name="CPERMIS_GOTIN" class="col-lg-6 ville" type="text"  class="form-control" placeholder="_________________" >
 </div>
<div id="bloc">
<label class="col-lg-3 text-right" for="cin">Adresse:</label><input name="CADRESSE" class="col-lg-6 at" type="text" placeholder="____________________________________________" >
 </div>
 <label class="col-lg-3 text-right" for="phone">Tél:</label><input  name="CPHONE" class="col-lg-6 withmask" type="text" placeholder="(____) ____-___" class="form-control" id="phone"><label class="col-lg-3 text-right" for="mobile">GSM</label><input name="CMOBILE" class="col-lg-6 withmask" type="text" placeholder="(+___)-_____-____" class="form-control" id="mobile">
 
 </div>


<div id="bloc">
 <h3>Information sur la Voiture</h3>
<div id="bloc">
<label class="col-lg-3 text-right" for="nom">Marque </label>
<?
display_marque();
 ?>
 </div>

</div>


<input type="submit" name="cree" class="button bleu" value="ENVOYER">

</form>

<? break;
case 2: 

if(!$check){ 
	    header('Location: index.php?step=0'); }
if ($check) { 
	if(empty($check)){ 
		header('Location: index.php?step=1'); }
	require( INC . CONFIG);
 	global $con;
if(mysqli_connect_error() == 1){ header('Location: index.php?step=1'); }	
if (mysqli_connect_error() == 0) { $blogname =  $con->query('SELECT OPTION_VALUE FROM options WHERE OPTION_ID = 3');
if (!empty($blogname)) { header('Location: index.php?step=4'); }
}}


  ?>

<div id="ins-top"><p>INSTALLATION DE <strong class="red">KELMA</strong></p><span>ETAPE 02 SUR 04</span></div>
<!-- MESSAGES -->
<div class="message success"><span>:)</span><p class="title">Première partie passée</p><p>Votre fichier config.php a était créé, veuillez continuer à finir les étapes suivants pour assurer l’installation complète</p></div>
<h1>Bravoooo !!</h1>
<div id="content">C’est parfait ! Vous avez passé la première partie de l’installation. Kelma peut désormais communiquer avec votre base de données. Si vous êtes prêt(e), il est maintenant temps de passé a la deuxième etape…

<br><br>

</div>
<div id="footer"><a href="index.php?step=3"><div class="button bleu" >Lancer l’installation</div></a> </div>
</form>
<? break;
case 3: 

if(!$check){ 
	    header('Location: index.php?step=0'); }
if ($check) { 
	if(empty($check)){ 
		header('Location: index.php?step=1'); }
	require( INC . CONFIG);
 	global $con;
if(mysqli_connect_error() == 1){ header('Location: index.php?step=1'); }	
if (mysqli_connect_error() == 0) { $blogname =  $con->query('SELECT OPTION_VALUE FROM options WHERE OPTION_ID = 3');
if (!empty($blogname)) { header('Location: index.php?step=4'); }
}}

if(isset($_POST['install'])){		
if(isset($_POST['SITETITLE']) && !empty($_POST['SITETITLE']) && isset($_POST['SITEUSER']) && !empty($_POST['SITEUSER']) && isset($_POST['USERPASSWORD']) && !empty($_POST['USERPASSWORD'])){
	$SITETITLE = $_POST['SITETITLE'];
	$SITEUSER = $_POST['SITEUSER'];
	$USERPASSWORD = md5($_POST['USERPASSWORD']);
	$USEREMAIL = $_POST['USEREMAIL'];

$con->query('INSERT INTO members (PSEUDO, PASSWORD, EMAIL, REGDATE) VALUES("'.$SITEUSER.'", "'.$USERPASSWORD.'", "'.$USEREMAIL.'", "'.time().'")') or die("MySQL Error: " . mysqli_error($con)); 
$con->query('UPDATE options  SET OPTION_VALUE = "'.$SITETITLE.'" WHERE OPTION_ID = 3  ') or die("MySQL Error: " . mysqli_error($con)); 
header('Location: index.php?step=4');
} }

// MESSAGE TO STYLE REQUIRED INPUTS
$message = " Required";
  ?>

<div id="ins-top"><p>INSTALLATION DE <strong class="red">KELMA</strong></p><span>ETAPE 02 SUR 04</span></div>
<!-- MESSAGES -->
<div class="message black"><span>:)</span><p class="title">Bienvenue</p><p>Bienvenue dans la très célèbre installation en 5 minutes de Kelma ! Vous n’avez qu’à remplir les informations demandées ci-dessous et vous serez prêt à utiliser la plus extensible et puissante plateforme de publication de contenu au monde.</p></div>
<h1>Informations nécessaires</h1>
<div id="content">Veuillez renseigner les informations suivantes. Ne vous inquiétez pas, vous pourrez les modifier plus tard.
<br><br>

<form method="POST">
<table class="installer-form">
  <tbody>
    <tr>
    	<td class="inst-title">Titre du site</td>
    	<td class="inst-input<?php if(isset($_POST['install']) && empty($_POST['SITETITLE'])){ echo $message; } ?>"><input type="text" name="SITETITLE" value="<?php if(isset($_POST['SITETITLE'])) {echo $_POST['SITETITLE'];} else {echo "kelma";}  ?>"></td>
    </tr>
    <tr>
    	<td class="inst-title">Identifiant</td>
    	<td class="inst-input<?php if(isset($_POST['install']) && empty($_POST['SITEUSER'])){ echo $message; } ?>"><input type="text" name="SITEUSER" value="<?php if(isset($_POST['SITEUSER'])) {echo $_POST['SITEUSER'];} ?>">
    	<p class="inst-describe">Les identifiants ne peuvent utiliser que des caractères alphanumériques, des espaces, des tirets bas ("_"), des traits d'union ("-"), des points et le symbole @.</p></td>

   </tr>
   
    	
    </tr>
    <tr>
    	<td class="inst-title">Mot de passe</td>
    	<td class="inst-input<?php if(isset($_POST['install']) && empty($_POST['USERPASSWORD'])){ echo $message; } ?>"><input type="text" name="USERPASSWORD" value="<?php if(isset($_POST['USERPASSWORD'])) {echo $_POST['USERPASSWORD'];} ?>">
    	<p class="inst-describe"><bold>Important</bold>: Vous aurez besoin de ce mot de passe pour vous connecter. Pensez à le stocker dans un lieu sûr.</p></td>
    	
    </tr> 
     <tr>
    	<td class="inst-title">Adresse de la base de données</td>
    	<td class="inst-input<?php if(isset($_POST['install']) && empty($_POST['USEREMAIL'])){ echo $message; } ?>"><input type="text" name="USEREMAIL" value="<?php if(isset($_POST['USEREMAIL'])) {echo $_POST['USEREMAIL'];} else {echo "localhost";} ?>"><p class="inst-describe">Vérifiez bien cette adresse de messagerie avant de continuer.</p></td>

    </tr>    
  </tbody>
</table>
</div>
<div id="footer"><input type="submit" name="install" class="button bleu" value="ENVOYER"></div>
</form>
<? break;
case 4: 
	?>
	<div id="ins-top"><p>INSTALLATION TERMINER <strong class="red">FELICITATION</strong></p></div>
<!-- MESSAGES -->
<h1>Quel succès !</h1>
<div id="content">Kelma est installé. Vous attendiez-vous à d’autres étapes ? Désolé de vous décevoir ;-)
<br><br>

</div>
<div id="footer"><input type="submit" name="install" class="button bleu" value="CONENXION"></div>
	<? break; } ?>
</main>
</body>
</html>