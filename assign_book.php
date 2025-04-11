<?php
    require_once 'db_connection.php';

    if(isset($_POST['submit'])) {
        $book_id = $_POST['book_id'];
        $student_id = $_POST['student_id'];
        $due_date = $_POST['due_date'];

        // echo $book_id;
        // echo $student_id;
        // echo $due_date;

        if (empty($book_id) || empty($student_id) || empty($due_date)) {
            echo "<script>alert('Please fill all fields.');</script>";
            exit;
        }

        $query1 = "INSERT INTO book_issues (book_id,student_id,due_date) VALUES ($book_id, $student_id, '$due_date')";
        $res1 = mysqli_query($conn, $query1);
        if($res1){
            $query2 = "UPDATE books SET available = 0 WHERE book_id = $book_id";
            $res2 = mysqli_query($conn, $query2);
            if($res2){
                echo "<script>alert('Book Assigned Successfully!');</script>";
            } 
            else {
                echo "<script>alert('Failed to update book availability.');</script>";
            }
        } 
        else {
            echo "<script>alert('Failed to assign book.');</script>";
        }  
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Assigned</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Assigned Books Details</h2>

    <table border="border" cellpadding="10">
        <tr>
            <th>Book Name</th>
            <th>Student Name</th>
            <th>Issue Date</th>
            <th>Due Date</th>
        </tr>
        <?php
            $query = "SELECT b.title, s.name, bi.issue_date, bi.due_date FROM book_issues bi 
                    JOIN books b ON bi.book_id = b.book_id 
                    JOIN students s ON bi.student_id = s.student_id";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['issue_date'] . "</td>";
                    echo "<td>" . $row['due_date'] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
    <br><br>

    <a href="index.php">Back to Home</a>

    </body>
</html>