<?php
    require_once 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Library Management System </title>
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
                        echo "<option value='" . $row['book_id'] . "'>" . $row['title'] . "</option>";
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
                        echo "<option value='" . $row['student_id'] . "'>" . $row['name'] . "</option>";
                    }
                ?>
            </select>

            <br><br>

            <label for="due_date"> Due Date: </label>
            <input type="date" name="due_date" id="due_date" required>

            <br><br>

            <button type="submit" name="submit">Assign Book</button>
        </form>
    </div>

</body>
</html>