
 <?php
$pageTitle = "Add Employee";
$section = null;
 include("header.php");?>


 <?php
$fname = $lname = $company = $email =  $phone ='';
$fnameErr = $lnameErr = $companyErr = $emailErr =  $phoneErr ='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["fname"])) {
        $fnameErr = "First Name is required";
      } else {
        $fname = test_input($_POST["fname"]);
        $fname = filter_var($fname, FILTER_SANITIZE_STRING);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
            $fnameErr = "Only letters and white space allowed";
          }
      }

      if (empty($_POST["lname"])) {
        $lnameErr = "Last Name is required";
      } else {
        $lname = test_input($_POST["lname"]);
        $lname = filter_var($lname, FILTER_SANITIZE_STRING);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
            $lnameErr = "Only letters and white space allowed";
          }
      }
      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
          }
      }
    
    
    
      if (empty($_POST["phone"])) {
        $phoneErr = "Phone Number is required";
      } else {
       // $phone = test_input($_POST["phone"]);
       $phone = $_POST["phone"];
       $pattern = '/^(?:(?:\+|00)44[\s-]?(?:\(\d{1,5}\)|\d{1,5})[\s-]?\d{1,6}[\s-]?\d{1,6}[\s-]?\d{1,9}|\(0\d{3}\)\s?\d{3}[\s-]?\d{4}|\(0\d{4}\)\s?\d{6}|\(0\d{2}\)\s?\d{4}[\s-]?\d{4}|\d{4}[\s-]?\d{6}|\d{5}[\s-]?\d{4}|\d{3}[\s-]?\d{4}[\s-]?\d{4})$/';
    
    if(! preg_match($pattern, $phone)){
        $phoneErr = "Invalid phone number please use the format +44 xxx xxx xxxx";
   }
  
 }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
    
?>


<?php

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
            // Fetch companies from the database and populate the select dropdown
            $sql = "SELECT Name FROM companies";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $companies = $stmt->fetchAll(PDO::FETCH_COLUMN,0);

            ?>


<div class="form" id="form">
    <form method="POST" action =" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" action="eform.php">
        <h1>Add a New Employee</h1>
        <table>
            <tr>
                <td>
                <label for="fname">First Name:</label>*<br>
                    <input type="text" name="fname" value="<?php echo $fname;?>" id="">
                    <span class="error"> <?php echo $fnameErr;?></span>
<br><br>
                
                </td>
            </tr>
            <tr>
                <td>
                <label for="lname">Last Name:</label>*<br>
                    <input type="text" name="lname" value="<?php echo $lname;?>" id="">
                    <span class="error"> <?php echo $lnameErr;?></span>
<br><br>
                    
                </td>
            </tr>

            <tr>
                <td>
                <label for="company">Company:</label><br>
                <select name="company" id="company">
                <?php foreach ($companies as $company) { ?>
                    <option value="<?php echo htmlspecialchars($company); ?>"><?php echo htmlspecialchars($company); ?></option>
                    
            <?php } ?>
            </select>
                
                </td>
            </tr>
            <tr>
                <td>
                <label for="email">Your Email:</label>*<br>
                    <input type="email" name="email" value="<?php echo $email;?>" id="">
                    <span class="error"> <?php echo $emailErr;?></span>
<br><br>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phone">Phone Number:</label>*<br>
                    <input id="" type="tel" name="phone" value="<?php echo $phone;?>"> 
                    <span class="error"> <?php echo $phoneErr;?></span>
                   
                </td>
            </tr>
            <tr>
                <td>
                    <input class= "submit" type="submit" name="submit" value="Submit">
                </td>
            </tr>
        </table>
    </form>
                </div>
<?php
    if(empty($fnameErr) && empty($lnameErr ) && empty($emailErr) && empty($phoneErr) ){
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

?>
<script>
  document.getElementById('form').style.display = 'none';
  </script>

<?php
echo '<div style = "margin : 2%;
height: 100vh;"><h4>New record created successfully</h4></div>';

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
    }
  
$conn = null;



    }
    ?>

<?php include("footer.php"); ?>