<?php
$pageTitle = "Welcome";
$section = null;
 include("header.php");

 
?>
	<div class="welcome">
    <div class="">

      <h1>Welcome</h1>
      <p class="">What would you like to do today?</p>
      
      <figure class="item">
      <a href="AddCompany.php">
    <img src="addcompany.png"/>
    <figcaption class="caption">Add Company</figcaption>
</a>
</figure>
<figure class="item">
<a href="AddEmployee.php">
    <img src="AddEmployee.png"/>
    <figcaption class="caption">Add Employee</figcaption>
</a>
</figure>
<figure class="item">
<a href="Display.php">
    <img src="companydetails.png"/>
    <figcaption class="caption">View Company Details</figcaption>
</a>
</figure>

		</div>

	</div>

<?php include("footer.php"); ?>