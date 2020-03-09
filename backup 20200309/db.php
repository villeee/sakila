            <?php         
    $server = "localhost";
    $user = "root";  
    $pw = "";
    $database = "sakila";

    $mysqli = new mysqli("$server","$user","","$database");
    if($mysqli -> connect_error) {
        die("Failed to connect to MySQL: " . $mysqli -> connect_error);
    }
    $mysqli -> set_charset("utf8");
?>