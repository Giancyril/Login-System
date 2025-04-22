<?php
session_start();
include 'db.php'; // make sure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $otp = $_POST['otp'] ?? '';

    if (!isset($_SESSION['otp']) || !isset($_SESSION['otp_email'])) {
        echo 'OTP expired or not sent.';
        exit;
    }

    if ($email === $_SESSION['otp_email'] && $otp == $_SESSION['otp']) {
        unset($_SESSION['otp']);
        unset($_SESSION['otp_email']);
    
        // ✅ Fixed: reference the correct table name
        $stmt = $conn->prepare("SELECT id, name FROM registered WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $row = $result->fetch_assoc()) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
        } else {
            echo 'User not found in database.';
            exit;
        }
    
        $_SESSION['loggedin'] = true;
        $_SESSION['user_email'] = $email;
    
        echo 'success';
    }
     else {
        echo 'Invalid OTP or email mismatch.';
    }
}
?>
