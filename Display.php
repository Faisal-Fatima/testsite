<?php
$pageTitle = "Display Companies";
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

              // Execute the query
    $query = "SELECT companies.*, COUNT(employees.Company) AS num_employees
    FROM companies
    LEFT JOIN employees ON Name = employees.Company
    GROUP BY Name; ";
    $stmt = $conn->query($query);

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the data
 
   echo    '<h1 style = "margin-top: 2em;
   margin-left: 2%;">Company Details</h1>';
       echo '<p style=" margin-left: 2%;"> Here are the details of all the companies in our database:</p>';
    foreach ($results as $row) {
      echo '<div class="company-details">' ;
        $name = $row['Name'];
        $email = $row['Email'];
        $logo = $row['Logo'];
        $url = $row['Website'];
        $employees = $row['num_employees'];
        $type = "company";
        $id = $row['id'];
       
      echo  
     '<div class="logo">' .
     '<img src= '. $logo. ' width =125  height= 125 alt="Company Logo">' .
     '</div>' .
     '<div class="details">' .
     '<h2 style="text-decoration:underline;">' . $name . '</h2>' .
     '<p><b>Email:</b> ' . $email . '</p>' .
     '<p><b>Website:</b> ' . $url . '</p>' .
     '<p><b>Number of Employees: </b>' . $employees . '</p>' .
     "<a href='cedit.php?id=" . $row['id'] . "'>Edit</a><br>".
   ' <a href="delete.php?type=' . $type . '&id=' . $id . '">Delete</a></td>'.
     '</div>' ;
       
     echo '</div>';
    }
   
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage(); 
}
$conn = null;
?>
<?php include("footer.php"); ?>