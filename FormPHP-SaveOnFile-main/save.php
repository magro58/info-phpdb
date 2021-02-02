<?php

function display() {
if(isset($_POST['submit']))
{	
	$mySessionID=$_POST['mySessionID'];
	session_id($mySessionID);
	session_start();
	if (!isset($_SESSION['mySessionID'])) {
	       header('Location:form.php');
	       exit;
	} else 
		$mySessionID=$_SESSION['mySessionID'];
	$pw=$_SESSION['pw'];
	$cognome="Cognome: ".$_SESSION['cognome'];
	$nome = "Nome: ".$_SESSION['nome'];
	$codice= "Codice Fisicale: ".$_SESSION['codice'];
	$email= "Indirizzo eMail: ".$_SESSION['email'];
	$sesso= "Indirizzo Sesso: ".$_SESSION['sesso'];
	
	$ErrForm="";
	$styleErrForm="padding:0%";
	
	$docroot= $_SERVER['DOCUMENT_ROOT'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$nomefile=$docroot."/".$uri."/".$mySessionID.".txt";

	$fp=fopen($nomefile,"w");
	
	if(!$fp){
		$title="Errore durante il salvataggio";
		die();
	}
	else{
		fwrite($fp,$cognome."\r\n");		
		fwrite($fp,$nome."\r\n");
		fwrite($fp,$sesso."\r\n");
		fwrite($fp,$codice."\r\n");
		fwrite($fp,$email."\r\n");
		fwrite($fp,$pw."\r\n");

		$title="Dati salvati correttamente";
		$hidden="hidden";
		$submitButton="Esci";
//		$typeSubmit="hidden";
		$url="";		
	
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$url= "http://".$host.$uri."/form.php";
		$nameSubmit="again";
	}
}
else
{
	$mySessionID=$_GET['mySessionID'];

	session_id($mySessionID);
	session_start();
/*	if (!isset($_SESSION['mySessionID'])) {
		header('Location:form.php');
		exit;
	} else 
		$mySessionID=$_SESSION['mySessionID'];
*/	
	$pw=$_SESSION['pw'];
	$cognome="Cognome: ".$_SESSION['cognome'];
	$nome = "Nome:".$_SESSION['nome'];
	$codice= "Codice Fisicale: ".$_SESSION['codice'];
	$email= "Indirizzo eMail: ".$_SESSION['email'];
	$sesso= "Sesso: ".$_SESSION['sesso'];
	
	$ErrForm="";
	$styleErrForm="padding:0%";
	$hidden="";
	$title="Riepilogo dati";
	$submitButton="Salva";
	$nameSubmit="submit";
//	$typeSubmit="submit";  <button id="conf" name='$nameSubmit'  $typeSubmit>$submitButton</button>
	$url="{$_SERVER['PHP_SELF']}";
}	
 $str = <<<HTML_FORM
   	<!DOCTYPE html>
<html>
<head>
<title> My site</title>
<link rel="stylesheet" href="css/stili.css" type="text/css">
</head>
<body >
<div >
<form   action='$url' method="POST" name="invio">
  <div id="titolo" >$title</div>
  <div class="testo2" $hidden>$cognome</div>
  <div class="testo2" $hidden>$nome</div>
  <div class="testo2" $hidden>$sesso</div>
  <div class="testo2" $hidden>$codice</div>
  <div class="testo2" $hidden>$email</div>
  <div class="testo2" $hidden>Password: ***********</div>
   <input type="hidden" name="mySessionID" value='$mySessionID'>
    <p>
   <button id="conf" name='$nameSubmit' >$submitButton</button>
   </p>
</form>
</div>

</body>
</html>

HTML_FORM;



  
return $str;
}
echo display();
?>