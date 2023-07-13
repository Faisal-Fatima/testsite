<?php
$pageTitle = "Edit Employee";
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
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $company = $_POST['company'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
           

            $sql = "UPDATE employees SET  First_Name = :fname, Last_Name = :lname, Company = :company , Email = :email , Phone_Number = :phone WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            
           
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                echo '<div style = "margin : 2%;
                height: 100vh;"><h4>Record updated successfully.</h4></div>';
            } else {
                echo '<div style = "margin : 2%;
                height: 100vh;"><h4>No changes were made.</h4></div>';
            }
        } else {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
        
                $sql = "SELECT * FROM employees WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($row) {
                    echo '<div class="form">';
                    echo "<form method='POST' action='eedit.php'>";
                    echo "<h1> Edit Employee Details </h1>";
                    echo "<table>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; 
                    echo "<tr><td>";
                    echo "First Name: <input type='text' name='fname' value='" . $row['First_Name'] . "'><br>";
                    echo "</td></tr>";
                    echo "<tr><td>";
                    echo "Last Name: <input type='text' name='lname' value='" . $row['Last_Name'] . "'><br>";
                    echo "</td></tr>";
                    echo "<tr><td>";
                    echo "Company: <input type='text' name='company' value='" . $row['Company'] . "'><br>";
                    echo "</td></tr>";
                    echo "<tr><td>";
                    echo "Email: <input type='email' name='email' value='" . $row['Email'] . "'><br>";               
                    echo "</td></tr>";
                    echo "<tr><td>";
                    echo "Phone Number: <input type='tel' name='phone' value='" . $row['Phone_Number'] . "'><br>";
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