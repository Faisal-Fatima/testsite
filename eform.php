<?php

if(isset($_POST['submit']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
 
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
        $sql = "INSERT INTO employees (id, First_Name, Last_Name, Company, Email, Phone_Number) VALUES ('', '$fname', '$lname', '$company', '$email', '$phone')";
      

$conn->exec($sql);
echo "New record created successfully";

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
    }
$conn = null;



 ?>
 <?php include("footer.php"); ?>