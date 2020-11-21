<form method="POST" >
<h3 style="text-align: center; color:#11C4C2;">Country Devise</h3>
<h4 style="text-align: center;">Country : <input type="text" name="pays">
<input type="submit" value="Devise">
</h4>
</form>
                     <!-- ******* WS1_Client ******* -->
<?php
require_once('lib/nusoap.php');
	$error  = '';
	$result = array();
	$wsdl = "http://localhost/ToCode3-2/WS1/WS1.php?wsdl";
		if(!$error){
			
			$client = new nusoap_client($wsdl, true);
			$err = $client->getError();
			if ($err) {
				echo '<h3>error</h3>' . $err;
				
			    exit();
			}
			 try {
				 
                  
				    $result1 = $client->call('countryTocodeCountry', array('country'=>$_POST['pays']));
                   
			  }
			  catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
		}	

?>

                         <!-- ******* WS2_Client ******* -->
<?php
require_once('lib/nusoap.php');
$wsdl = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";
$client = new nusoap_client($wsdl, 'wsdl');
$err = $client->getError();
if ($err) {
   echo '<h2>L\'error :</h2>' . $err;
   exit();
}

$result=$client->call('CountryCurrency', array('sCountryISOCode'=>$result1));
$res = ($result['CountryFlagResult']['sName']);
echo ($result['CountryFlagResult']['sName']);
if($res =='Country not found in the database'){

    echo '<h4 style="color:red;text-align:center;">Country not found in the database</h4></br>';

}
else {
echo " <p style=\"text-align: center;\"><strong>".$_POST['pays']."Devise is: </strong>".($result['CountryCurrencyResult']['sISOCode'])."(".($result['CountryCurrencyResult']['sName']).")"."</p></br>";

}
?>

