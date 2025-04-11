<?php
    require_once 'db_connection.php';

    if(isset($_POST['submit'])) {
        $book_id = $_POST['book_id'];
        $student_id = $_POST['student_id'];
        $due_date = $_POST['due_date'];

        $query1 = "INSERT INTO book_issues (book_id,student_id,due_date) VALUES ($book_id, $student_id, $due_date)";
        $res1 = mysqli_query($conn, $query1);
        if($res1){
            $query2 = "UPDATE books SET available = 0 WHERE id = $book_id";
            $res2 = mysqli_query($conn, $query2);
            if($res2){
                echo "<script>alert('Book Assigned Successfully!');</script>";
            } else {
                echo "<script>alert('Failed to update book availability.');</script>";
            }
        } else {
            echo "<script>alert('Failed to assign book.');</script>";
        }  
    }
?>