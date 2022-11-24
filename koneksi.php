<?php
$kon = mysqli_connect("localhost", "root", "", "crud-pkl");

if (!$kon) {
    die("Connection failed: " . mysqli_connect_error());
}

// $sql = "CREATE TABLE MyGuests (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     firstname VARCHAR(30) NOT NULL,
//     lastname VARCHAR(30) NOT NULL,
//     email VARCHAR(50),
//     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//     )";

// if (mysqli_query($kon, $sql)) {
//     echo "Table MyGuests created successfully";
// } else {
//     echo "Error creating table: " . mysqli_error($kon);
// }

// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com')";

// if (mysqli_query($kon, $sql)) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . mysqli_error($kon);
// }

// mysqli_close($kon);
