<?php
$pageTitle = "Edit Company";
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


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $logo = $_POST['logo'];
            $website = $_POST['website'];
           

            $sql = "UPDATE companies SET Name = :name, Email = :email , Logo =:logo, Website =:website WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':logo',$logo);
            $stmt->bindParam(':website', $website);
           
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                echo "Record updated successfully.";
            } else {
                echo "No changes were made.";
            }
        } else {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
        
                $sql = "SELECT * FROM companies WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($row) {
                    echo '<div class="form">';
                    echo "<form method='POST' action='cedit.php'>";
                    echo "<h1> Edit Company Details </h1>";
                    echo "<table>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<tr><td>";
                    echo "Name: <input type='text' name='name' value='" . $row['Name'] . "'><br>";
                    echo "</td></tr>";
                    echo "<tr><td>";
                    echo "Email: <input type='email' name='email' value='" . $row['Email'] . "'><br>";
                    echo "</td></tr>";
                    echo "<tr><td>";
                    echo "Logo: <input type='url' name='logo' value='" . $row['Logo'] . "'><br>";
                    echo "</td></tr>";
                    echo "<tr><td>";
                    echo "Website: <input type='url' name='website' value='" . $row['Website'] . "'><br>";
                    echo "</td></tr>";
                    echo "<tr><td>";
                    echo "<input type='submit' value='Update'>";
                    echo "</td></tr>";
                    echo "</table>";
                    echo "</form>";
                    echo "</div>";
                    
                } else {
                    echo "Record not found.";
                }
            }
        }
       include("footer.php"); ?>