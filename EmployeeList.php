<?php
$pageTitle = "Employee List";
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

        $sql = "SELECT * FROM employees";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$className = "list";
 echo '<div class="' . $className . '">';

echo "<h1> List of Employees </h1>";
echo "<div style='overflow-x: auto; margin-top: 2%;'>";
echo "<table>";
echo "<tr><th>First Name</th><th>Last Name</th><th>Company</th><th>Email</th><th>Phone</th><th>Edit</th><th>Delete</th></tr>";

foreach ($rows as $row) {
  $type = "employee";
  $id = $row['id'];
    echo "<tr>";
   
    echo "<td>" . $row['First_Name'] . "</td>";
    echo "<td>" . $row['Last_Name'] . "</td>";
    echo "<td>" . $row['Company'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td style='width:11em;'>" . $row['Phone_Number'] . "</td>";
    echo "<td><a href='eedit.php?id=" . $row['id'] . "'>Edit</a></td>";
    echo '<td><a href="delete.php?type=' . $type . '&id=' . $id . '">Delete</a></td>';
    echo "</tr>";
}

echo "</table>";
echo "</div>";
echo "</div>";
include('footer.php');

?>