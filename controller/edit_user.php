<?php
$db = require("../model/DB.php");
$config = require('../config.php');
$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();

 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $id = $_POST['id'];
    $name = $_POST['name'];
    $standard = $_POST['standard'];
    $roll_number = $_POST['roll_number'];
    $dob =$_POST['dob'];

    $sql = "UPDATE students SET name = ?, standard = ?, roll_number = ?,  dob= ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $standard, $roll_number, $dob,$id);

    if ($stmt->execute()) {
           header("Location: ../view/students_form");

    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $id = $_GET["id"];
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    ?>
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-center text-2xl font-bold my-4">Edit User</h1>
    <form method="post" action="edit_user.php" class="max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg">
        <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
            <input type="text" name="name" value="<?php echo $user["name"]; ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label for="standard" class="block text-gray-700 font-bold mb-2">which standard studying:</label>
            <input type="text" name="standard" value="<?php echo $user["standard"]; ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label for="roll_number" class="block text-gray-700 font-bold mb-2">roll number:</label>
            <input type="text" name="roll_number" value="<?php echo $user['roll_number']; ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label for="dob" class="block text-gray-700 font-bold mb-2">DOB:</label>
            <input type="date" name="dob" value="<?php echo $user["dob"]; ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="text-center">
            <input type="submit" value="Update" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
        </div>
    </form>
</body>
</html>

    <?php
    $stmt->close();
    $conn->close();
}
?>

