<?php
require("partials/header.html");

// Create a connection to MySQL database on localhost
$db = new mysqli('localhost', 'ursa', 'ulsafar', 'dbLab');
if(mysqli_connect_errno()){
?>  
    <!-- Displaying error message if connection not successful -->
    <div class="text-center"> 
    <h2 class="alert alert-danger">
        Something went wrong with the database. Please Try again later.
    </h2>
    <a href="index.html" class="btn btn-primary">Go Back</a>
    </div>
    <?php
}else{
?>
<div class="jumbotron text-center">
    <h3 class="display-2 mb-3">Student Records</h3>
    <div class="row">
    <div class="col">
    <!-- This button Create a modal form to add new Student -->
        <a href="#" class="btn btn-primary btn-lg rounded-pill ml-3"><i class="fas fa-plus-circle mr-2"></i>Add Student</a>
    </div>
    <div class = "col d-flex justify-content-start">
    <!-- This opens a Modal form to search a Student record -->
        <a href="#" class="btn btn-success rounded-pill btn-lg mr-3"><i class="fas fa-search mr-2"></i>Search</a>
    </div>
    </div>
</div>

<h2 id="record_heading">List of archived students</h2>
<div class="row justify-content-center">
    <div class="col-8">
        <div class="row justify-content-center">
            <div class="col-8" id="student_list">
                <?php
                // Displaying student records 
                $query = "select Name, MobileNumber, Grade from std_record";
                $stmt = $db->prepare($query);
                if($stmt->execute()){
                $stmt->bind_result($std_name, $mobile_number, $grade);
                while($stmt->fetch()){
                ?>
                <h3 class="my-4 student_name"><span><? echo $std_name ?></span></h3>
                <div class="student_data container">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">Mobile Number</h5>
                            <p class="card-text"><?echo $mobile_number?></p>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Grade</h5>
                            <p class="card-text"><?echo $grade?></p>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
</div>

<?php
}
?>
<?php
$db->close();
require("partials/footer.html");
?>