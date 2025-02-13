




<?php
if(isset($_POST['submit']))
 {
if (PHP_SAPI != 'cli') {
	echo "<pre>";
}

//$string =' Very exorbitantly priced and value for money ratio is poor nothing extradinary ';
	

$string = $_POST['text_to_check'];




require_once 'autoload.php';
$sentiment = new \PHPInsight\Sentiment();
//foreach ($strings as $string) {

	// calculations:
	$scores = $sentiment->score($string);
	$class = $sentiment->categorise($string);

	// output:
	echo "String: $string\n";
	echo "Dominant: $class, scores: ";
	print_r($scores);
	echo "\n";
//}
}
	?>

	<html>
    <head >
       
       </head>
    <body>
        <form action="" method="post" value="">
        <table align="left">
            <tr>
                <td>Enter the Text:</td>
                <td><input type="text" name="text_to_check" value=""></td>
                
            </tr>
            
               <tr>
               <td><input type="submit" name="submit" value="Check"> 
               
               </tr>
        </table>
            </form>
    </body>
</html>
