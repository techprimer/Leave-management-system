<?php




define('DB_HOST', 'localhost');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'leaves');
//define('DB_USER_TBL', 'nikhil');
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!$conn){
 die('Could not Connect My Sql:' .mysql_error());
}

?>