

<?php
$pageTitle = "Company List";
$section = null;
 include("header.php");
 $className = "list";
 echo '<div class="' . $className . '">';

echo "<h1> List of Companies </h1>";

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

        $sql = "SELECT * FROM companies";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<div style='overflow-x: auto; margin-top: 2%;'>";
echo "<table>";
echo "<tr><th>Name</th><th>Email</th><th>Website</th><th>Edit</th><th>Delete</th></tr>";

foreach ($rows as $row) {
  $type = "company";
$id = $row['id'];
    echo "<tr>";

    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td>" . $row['Website'] . "</td>";
    echo "<td><a href='cedit.php?id=" . $row['id'] . "'>Edit</a></td>";
    echo '<td><a href="delete.php?type=' . $type . '&id=' . $id . '">Delete</a></td>';
    echo "</tr>";
}

echo "</table>";

echo "</div>";


include('footer.php');