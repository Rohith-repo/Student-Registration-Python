<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$con = mysqli_connect($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $id = $_POST['id'];
        $email = $_POST['email'];
        $dept = $_POST['dept'];
        $gender = $_POST['gender'];

        $check_query = "SELECT * FROM `registration` WHERE `id` = '$id'";
        $check_result = mysqli_query($con, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            echo "ID already exists";
        } else {
            $sql = "INSERT INTO `registration` (`name`, `id`, `email`, `dept`, `gender`) VALUES ('$name', '$id', '$email', '$dept', '$gender')";
            $rs = mysqli_query($con, $sql);
            
            if ($rs) {
                echo "Data Inserted";
            } else {
                echo "Error inserting records: " . mysqli_error($con);
            }
        }
    }
    if (isset($_POST['show_tables'])) {
        $sql = "SELECT * FROM `registration`";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Data from Table</h2>";
            echo "<table border='2'>";
            echo "<tr>";
            $field_info = mysqli_fetch_fields($result);
            foreach ($field_info as $field) {
                echo "<th>{$field->name}</th>";
            }
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $data) {
                    echo "<td>{$data}</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }
}
mysqli_close($con);
?>
