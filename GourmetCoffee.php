<?php
require_once("inc_OnlineStoresDB.php");
require_once("Class_OnlineStore.php");
if (class_exists("onlineStore")) {
    $Store = new onlineStore();
}
else {
    $errorMsgs[] = "The <em>onlineStore</em> class is not available!";
    $store = NULL;   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmet Coffee</title>
</head>
<body>
    <h1>Gourmet Coffee</h1>
    <h2>Description goes here</h2>
    <p>Welcome message goes here</p>
    
    <?php
    $TableName = "inventory";
    if (count($errorMsgs) == 0) {
        $SQLstring = "SELECT * FROM $TableName" . " WHERE storeID='COFFEE'";
        $QueryResult = $DBConnect->query($SQLstring);
        if (!$QueryResult) {
            $errorMsgs[] = "<p>Unable to execute the query.<br>" . "Error Code" . $DBConnect->errno . ": " . $DBConnect->error . "</p>\n";
        }
        else {
            echo"<table width='100%'>\n";
            echo"<tr>\n";
            echo"<th>Product</th>\n";
            echo"<th>Description</th>\n";
            echo"<th>Price Each</th>\n";
            echo"</tr>\n";
            
            while (($row = $QueryResult->fetch_assoc()) != NULL) {
                echo"<tr><td>" . htmlentities($row['name']) . "</td>";
                echo"</td>\n";
                echo"<td>" . htmlentities($row['description']) . "</td>";
                echo"</td>\n";
                printf("<td>$%.2f</td></tr>\n", $row['price']);
            }
            echo"</table>\n";
        }
    }
    if (count($errorMsgs) > 0) {
        foreach ($errorMsgs as $msg) {
            echo "<p>" . $msg . "</p>\n";
        }
    }
    ?>
    
</body>
</html>
<?php
if (!$DBConnect->connect_error) {
    echo"<p>Closing database <em>$DBName</em>.</p>\n";
    $DBConnect->close();
}
?>