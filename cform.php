<?php


if(isset($_POST['submit']))
    {
        $cname = $_POST['name'];
        $c_email = $_POST['email'];
        $logo = $_POST['logo'];
        $url = $_POST['website'];

        //database details. You have created these details in the third step. Use your own.
        $host = "localhost";
        $username = "form_user";
        $password = "abc123";
        $dbname = "companies_employees";
 

        try {
          $conn = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //echo "Connected successfully";
        

        
        //This below line is a code to Send form entries to database
        $sql = "INSERT INTO companies (id, Name, Email, Logo, Website) VALUES ('', '$cname', '$c_email', '$logo' , '$url')";
      //fire query to save entries and check it with if statement

$conn->exec($sql);
echo "New record created successfully";

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
    }
$conn = null;

 ?>
 <?php include("footer.php"); ?>