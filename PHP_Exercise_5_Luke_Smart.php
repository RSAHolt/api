<h4>
    1. ### Handling Form Data with $_REQUEST
    Create an HTML form with fields for "Name," "Email," and "Message." Write a PHP script to handle the form submission using $_REQUEST. Display the submitted data in the format:
    • *"Name: John, Email: john@example.com, Message: Hello there!"*

</h4>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="PHP_Exercise_5_Luke_Smart.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php 
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $message = $_REQUEST['message'];

    echo "Name: $name, Email: $email, Message: $message";
} 

?>

<h4>
    2. ### Server Details with $_SERVER
        Use $_SERVER to display the following server details:
            • Host name
            • PHP version
            • Request method used

</h4>

<?php 
    echo"Host name: ".$_SERVER['SERVER_NAME']." <br>";
    echo"PHP version: ".phpversion()."<br>";
    echo"Request method used: ".$_SERVER['REQUEST_METHOD']." <br>";

?>

<h4>
    3. ### Database Connection
    Write a script to connect to a MySQL database. Create a table users with fields id, name, and email. Insert a sample record.

</h4>

<?php 
    $servername = "localhost";
    $username = "root";  
    $password = "2378";    
    $dbname = "do_01"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully<br>";

    $createSql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP
    )";
    
    if ($conn->query($createSql) === TRUE) {
        echo "Table 'users' created successfully.<br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    $insertSql = "INSERT INTO users (name, email) VALUES ('John Doe', 'john.doe@example.com')";
    
    if ($conn->query($insertSql) === TRUE) {
        echo "Sample record inserted successfully.<br>";
    } else {
        echo "Error inserting record: " . $conn->error . "<br>";
    }

    $conn->close();
?>

<h4>
    4. ### CRUD Operations
        • Write scripts to insert, retrieve, update, and delete records from the users table.
        • Example: Update a user's email and delete a user by their ID.
</h4>

<?php 
$servername = "localhost";
$username = "root";
$password = "2378";
$dbname = "do_01";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

// Inserting new user
$insertSql = "INSERT INTO users (name, email) VALUES ('Jane Smith', 'jane.smith@example.com')";
if ($conn->query($insertSql) === TRUE) {
    echo "New record created successfully.<br>";
} else {
    echo "Error inserting record: " . $conn->error . "<br>";
};

// Retrieve
$selectSql = "SELECT * FROM users";
$result = $conn->query($selectSql);

// Displaying the table
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registration Date</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["reg_date"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found.<br>";
};

// Updating
$updateSql = "UPDATE users SET email='jane.smith@newdomain.com' WHERE name='Jane Smith'";

if ($conn->query($updateSql) === TRUE) {
    echo "Record updated successfully.<br>";
} else {
    echo "Error updating record: " . $conn->error . "<br>";
}

// Deleting
$deleteSql = "DELETE FROM users WHERE id=1";

if ($conn->query($deleteSql) === TRUE) {
    echo "Record deleted successfully.<br>";
} else {
    echo "Error deleting record: " . $conn->error . "<br>";
}

$conn->close();

?>

<h4>
5. ### Final Project
    • Create a web form to collect user data (Name, Email, and Message).
    • Save the data into the database.
    • Display all records in an HTML table with options to edit or delete individual entries.


</h4>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Form</title>
</head>
<body>
    <h1>Submit Your Information</h1>
    <form action="submit_form.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "2378";
$dbname = "do_01";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Insert data into database
$insertSql = "INSERT INTO customers (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($insertSql) === TRUE) {
    echo "New record created successfully.<br>";
    echo "<a href='view_records.php'>View Records</a>";
} else {
    echo "Error: " . $conn->error;
}

$selectSql = "SELECT * FROM customers";
$result = $conn->query($selectSql);

echo "<h1>All Records</h1>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["message"] . "</td>
                <td>
                    <a href='edit_record.php?id=" . $row["id"] . "'>Edit</a> | 
                    <a href='delete_record.php?id=" . $row["id"] . "'>Delete</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No records found.<br>";
}


$conn->close();
?>
