<?php
require_once 'config/db.php';
$email = 'codewithrak552@gmail.com';
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();
if ($user) {
    echo "User found: " . print_r($user, true);
} else {
    echo "User NOT found: " . $email;
}
?>
