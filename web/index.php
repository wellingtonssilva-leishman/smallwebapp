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

?>
<html>
    <head>
        <title>Small Web Application</title>
    </head>
    <body>
        <form action="/action.php" method="post">
            <fieldset>
                <legend>Small Web Application</legend>
                    <p>
                        <label>Input your name</label><br>
                        <input type="text" id="txtName" name="txtName" placeholder="First Name" required>
                    </p>
                    <p>
                        <label>Choose your favorite Color</label><br>
                        <input id="clrColor" name="clrColor" type="color" value="#0000ff">
                    </p>
                    <p>
                        <label>Choose a pet</label><br>
<?php 
                        // Get Pets from database to fill radio options
                        $stmtpets = $db->query("SELECT * FROM pets ORDER BY pet_name");
                        
                        // Loop for all entrys and create a radio option
                        while($rowpet = $stmtpets->fetch(PDO::FETCH_ASSOC)) {

?>	                     
                            <label><input type="radio" name="optPet" id="optPet<?php echo $rowpet['pet_name'];?>" value="<?php echo $rowpet['pet_id'];?>" required="required"><?php echo $rowpet['pet_name'];?></label>
<?php

	                    }

// Close DB connection
$db->connection = null;

?>	
                    </p>
                    <p>
                        <input type="hidden" name="hidAction" id="hidAction" value="add">
                        <button type="submit" value="submit" id="btnSubmit">Send</button>
                    </p>
            </fieldset>
        </form>
    </body>
</html>
