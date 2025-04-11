<?php
    require_once 'db_connection.php';

    if(isset($_POST['submit'])) {
        $book_id = $_POST['book_id'];
        $student_id = $_POST['student_id'];
        $due_date = $_POST['due_date'];

        $query1 = "INSERT INTO book_issues (book_id,student_id,due_date) VALUES ($book_id, $student_id, '$due_date')";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
</head>
<body>
    <h1>Library Managaement System</h1>
    <h2>Assign Book</h2>

    <div class="form-section">
        <form action="assign_book.php" method="POST">

            <label for="book_id" > Book: </label>
            <select name="book_id" id="book_id" required>
            <option value="">-- Select a Book --</option>
                <?php
                    $query = "SELECT * FROM books WHERE available = 1 ORDER BY title";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                    }
                ?>
            </select>

            <br><br>

            <label for="student_id"> Student: </label>
            <select name="student_id" id="student_id" required>
            <option value="">-- Select a Student --</option>
                <?php
                    $query = "SELECT * FROM students ORDER BY name";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                ?>
            </select>

            <br><br>

            <label for="due_date"> Issue Date: </label>
            <input type="date" name="issue_date" id="issue_date" required>

            <br><br>

            <button type="submit" name="submit">Assign Book</button>
        </form>
    </div>

    <br><br>

    <h2>Assigned Books Details</h2>

    <table border="border" >
        <tr>
            <th>Book Name</th>
            <th>Student Name</th>
            <th>Issue Date</th>
            <th>Due Date</th>
        </tr>
    </table>

</body>
</html>