<?php

$context1 = getInput('c1');
$context2 = getInput('c2');
$context3 = getInput('c3');
$context4 = getInput('c4');
$context5 = getInput('c5');

function getInput($name){
	//persist message to tmp file
	$message = $_GET[$name];
	$dataStore = file_build_path(sys_get_temp_dir(), 'dataStore-'.$name.'.txt');
	if(empty($message)){
	   if(file_exists($dataStore)){
	      $message = file_get_contents($dataStore);
	   }else {
	      $message = '';
           }
	}else{
	   file_put_contents($dataStore, $message);
	}
	return $message;
}



function file_build_path(...$segments) {
    return join(DIRECTORY_SEPARATOR, $segments);
}

session_start();

//function for encoding values
function encode($val) {
   //$val = str_replace("<","&lt;",$val);
   //$val = str_replace(">","&gt;",$val);
   //$val = str_replace("\"","\\\"",$val); //replaces " with \"
   //$val = str_replace("'","\\'",$val); //replaces ' with \'
   //$val = str_replace("\"","&quot;",$val);
   //$val = htmlentities($val);
   //$val = urlencode($val);
   return $val;
}

?>
<html>
   <body>

      <h1>Injection Theory</h1><p>
      Injection is about the control characters.
      <div class="<?= $context2 ?>">
	<?= $context1 ?><br>
      </div><p>

      <script>//Injection into JS
	 var s1 = "<?= $context3 ?>";
	 var s2 = '<?= $context4 ?>';
	 var i = <?= $context5 ?>;
      </script>
      <script>//dom based xss
	var pos = document.URL.indexOf('c6=') + 3;
	document.write(
  	'<style>body{color:' +
    		decodeURI(document.URL.substring(pos, document.URL.length)) +
    	';}</style>',);
      </script>
   </body>
</html>
