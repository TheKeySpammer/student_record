<?php
require("partials/header.html");

$db = new mysqli('localhost', 'ursa', 'ulsafar', 'dbLab');
if(mysqli_connect_errno){
    ?>
    <div class="text-center"> 
    <h2 class="alert alert-danger">
        Something went wrong with the database. Please Try again later.
    </h2>
    <a href="index.html" class="btn btn-primary">Go Back</a>
    </div>
    <?php
}
?>
<div class="jumbotron text-center">
    <h1 class="display-2">Student Records</h1>
    <div class="row ">
    <div class="col">
        
    </div>
    <div class = "col">
    </div>
    </div>
</div>


<?php
require("partials/footer.html");
?>