 <?php
 try {
//    $dbc=new PDO("mysql:host=localhost;dbname=codesnyp_33jdst","codesnyp_jdst","jdst@cs1023") 
//     or die("Unable to connect.");
    $dbc=new PDO("mysql:host=localhost;dbname=twitter","root","") 
     or die("Unable to connect.");
}
catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
    }
 ?>