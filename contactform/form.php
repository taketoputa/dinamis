<?php
require_once 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];


    $sql = "INSERT INTO contact_form(name, email, phone, message) VALUES (?, ?, ?, ?)";
    
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("ssss", $name, $email, $phone, $message);
        
        if ($stmt->execute()) {
            echo "ok";
        } else {
            echo "Error: " . $stmt->error;
        }

        // close
        $stmt->close();
    } else {
        echo "Error: " . $koneksi->error;
    }
    
    closedb($koneksi);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');</style>
</head>
<body>

<form class="forrm" action="form.php" method="POST">
    <label class="text-name" for="name">Name</label>
    <input type="text" id="name" name="name" required>

    <label class="text-email" for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label class="text-phone" for="phone">Phone</label>
    <input type="tel" id="phone" name="phone" required>

    <label class="text-message" for="message">Message</label>
    <textarea id="message" name="message" rows="4" required></textarea>

    <button id="text-send" class="send">Send</button> 
</form>

</body>
</html>