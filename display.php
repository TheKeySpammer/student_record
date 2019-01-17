<?php
require("partials/header.html");

$db = new mysqli('localhost', 'ursa', 'ulsafar', 'dbLab');
if(mysqli_connect_errno()){
    ?>
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
        <a href="#" class="btn btn-primary btn-lg rounded-pill ml-3"><i class="fas fa-plus-circle mr-2"></i>Add Student</a>
    </div>
    <div class = "col d-flex justify-content-start">
        <a href="#" class="btn btn-success rounded-pill btn-lg mr-3"><i class="fas fa-search mr-2"></i>Search</a>
    </div>
    </div>
</div>

<h2 class="text-center">List of archived students</h2>
<div class="row justify-content-center">
    <div class="col-8">
        <ul class="list-group">
        
            <?php
            $query = "select Name from std_record";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stmt->bind_result($std_name);
            while($stmt->fetch()){
            ?>
            <li class = "list-group-item">
                <div class="row">
                    <div class="col student_record_disp">
                        <? echo $std_name ?>
                    </div>
                    <div class="col student_record_del"></div>
                </div>
            </li>
            <?php } ?>
        
        </ul>
    </div>
</div>

<?php
}
?>
<?php
$db->close();
require("partials/footer.html");
?>