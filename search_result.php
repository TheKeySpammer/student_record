<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Search Result</title>
    </head>
    <body>
        <h1>Query Result</h1>
        <?php
        $q_type = $_POST['search'];
        $name = $_POST['name'];
        if(!$q_type || !$name){
            echo "<p> Wrong </p>";
        }

        $db = new mysqli('localhost', 'root', 'oedipus', 'student');
        $query = "SELECT * FROM std_record WHERE $q_type = $name";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->bind_result($s_id, $std_name, $mob_no, $grade);
        while($stmt->fetch()){
        ?>
        <p>Student ID: <?echo $s_id;?> </p>
        <p>Name: <?echo $std_name;?> </p>
        <p>Mobile Number: <?echo $mob_no;?> </p>
        <p>Grade: <?echo $grade;?> </p>
        <?php
        }
        $stmt->free_result();
        $db->close();
        ?>

    </body>
</html>
