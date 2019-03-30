<style>
    thead {color:black; background-color:lightgray;}
    tbody {color:black;}
    table,th,td {border:1px solid black;}
</style>
<?php

// Redirect http connections to https
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

// Include db.php file to work with DB connection
require_once("db.php");

// Call connect function to open db connection
$db=connect();

// Verify if POST method has a field called hidAction
$action = $_REQUEST["hidAction"];

// Use switch to achieve the action
switch($action){

    case "add":
        // Case action is "add" verify if user is already on database 
        $stmtVerify = $db->query("SELECT COUNT(*) AS counter FROM customers WHERE cust_name = '" . $_REQUEST['txtName'] . "'");
        $rowVerify = $stmtVerify->fetch(PDO::FETCH_ASSOC);
        
        // Verify if result count is bigger than 0. If yes, return an error message
        if ( $rowVerify['counter'] > 0 ){

?>
            <p align="center">
            Customer can't be added (already on database)<br/><br/>
            <button onclick="window.history.back()">Go Back</button>
            </p>
<?php

        } else {

            // If result equal 0, insert customer data on database
            $sql = "INSERT INTO customers(cust_name, cust_color, cust_pet) VALUES('".$_REQUEST['txtName']."', '".$_REQUEST['clrColor']."', ".$_REQUEST['optPet'].")";
            // Verify result od previous statement
            $result = $db->exec($sql);

            // If result bigger than 0. If yes, return a success message
            if ( $result > 0 ){
?>
                <p align="center">
                Customer successfully added!<br/><br/>
                <button onclick="location.href='index.php';">Go to Home Page</button>
                </p>
<?php

            } else {

                // If result equal 0, return an error message
?>
                <p align="center">
                Error adding customer<br/><br/>
                <button onclick="window.history.back()">Go Back</button>
                </p>
<?php                
            }               
        }
    }

// Query that get customer's name, favorite color and pet (using 2 relationated tables)
$stmtcust = $db->query("SELECT a.cust_name as name, a.cust_color as color, b.pet_name as pet FROM customers a, pets b WHERE a.cust_pet = b.pet_id ORDER BY a.cust_name;");

// Count how many results
$countcust = $stmtcust->rowCount();

// Verify if results bigger than 0. if yes, Mount a table with results
if ( $countcust > 0 ) {

?>	                
    <p>
        <fieldset>
            <legend>Customers List</legend>
                <table border="1" style="width:100%;">
                <thead>
                <tr><th style="width:50%;">Name</th><th>Favorite Color</th><th>Pet</th></tr>
                </thead>
                <tbody>
<?php
                // Loop for all entrys and create table lines
                while($rowcust = $stmtcust->fetch(PDO::FETCH_ASSOC)) {

?>
                    <tr>
                        <td><?php echo $rowcust['name'];?></td>
                        <td bgcolor="<?php echo $rowcust['color'];?>"></td>
                        <td style="text-align:center;"><?php echo $rowcust['pet'];?></td>
                    </tr>
<?php
                }
?>
                </tbody>
            </table>
        </fieldset>                
    </p>                
<?php

} else {

    // If no results, show an error message
?>
    <p align="center">
    No customers on database!<br/><br/>
    <button onclick="location.href='index.php';">Go to Home Page</button>
    </p>
<?php 
     
}

?>
