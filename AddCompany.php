<?php
$pageTitle = "Add Company";
$section = null;
 include("header.php");
 

 ?>

<?php
$name = $email = $logo =$url ='';
$nameErr = $emailErr = $logoErr =$urlErr ='';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
      } else {
        $name = test_input($_POST["name"]);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
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
    
      if (empty($_POST["logo"])) {
        $logo = "";
      } else {
        $logo = test_input($_POST["logo"]);
      }
    
      if (empty($_POST["website"])) {
        $urlErr = "";
      } else {
        $url = test_input($_POST["website"]);
        $url = filter_var($url, FILTER_SANITIZE_URL);

        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
            $urlErr = "Invalid URL";
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



<div class="form">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h1>Add a New Company</h1>
        <table>
            <tr>
                <td>
                    <label for="name">Company's Name:</label>*<br>
                    <input type="text" name="name" value="<?php echo $name;?>" id="">
                    <span class="error"> <?php echo $nameErr;?></span>
<br><br>
                </td>
            </tr>
            
            
            <tr>
                <td>
                    <label for="email">Email:</label>*<br>
                    <input type="email" name="email" value="<?php echo $email;?>" id="">
                    <span class="error"> <?php echo $emailErr;?></span>
<br><br>
                </td>
            </tr>
            <tr>
                <td>
                    
                    <label for="logo">Logo Url:</label><br>
                    <input type="url" name="logo" value="<?php echo $logo;?>" id="">
                    <span class="error"><?php echo $logoErr;?></span>
                    

<br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="website">Website:</label><br>
                    <input id="" type= "website" name="website" value="<?php echo $url;?>"> 
                    <span class="error"><?php echo $urlErr;?></span>
<br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Submit">
                </td>
            </tr>
        </table>
</form>
<?php

if(empty($nameErr) && empty($emailErr) && empty($logoErr)  && empty($urlErr )){
if(isset($_POST['submit']))
    {
        $cname = $_POST['name'];
        $c_email = $_POST['email'];
        $logo = $_POST['logo'];
        
        $url = $_POST['website'];

       
// $sql = "INSERT INTO companies (name, email, website, logo_path) VALUES (?, ?, ?, ?)";
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$name, $email, $website, $logoPath]);

// Display success message or perform any other necessary action
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
        $sql = "INSERT INTO companies (id, Name, Email, Logo, Website) VALUES ('', ?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $email, $logo , $url]);
      //fire query to save entries and check it with if statement
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