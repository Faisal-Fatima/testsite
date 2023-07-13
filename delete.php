



<?php
$pageTitle = "Delete Entry";
$section = null;
 include("header.php");


$host = "localhost";
        $username = "form_user";
        $password = "abc123";
        $dbname = "companies_employees";
 

        try {
          $conn = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }


        $type = $_GET['type'];
$id = $_GET['id'];

// Perform necessary input validation and security checks

if ($type === 'company') {
    // Delete company record
    $sql = "DELETE FROM companies WHERE id = :id";
} elseif ($type === 'employee') {
    // Delete employee record
    $sql = "DELETE FROM employees WHERE id = :id";
} else {
    // Invalid type
    die("Invalid record type");
}

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
      echo '<div style = "margin : 2%;
      height: 100vh;"><h4>Record deleted successfully.</h4></div>';
  } else {
      echo "No records found to delete.";
  }



include("footer.php"); ?>