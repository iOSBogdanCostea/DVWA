<?php

if (isset($_GET['Login'])) {
    // Get username and password
    $user = $_GET['username'];
    $pass = $_GET['password'];
    $pass = md5($pass); // Note: MD5 is not recommended for hashing passwords; consider using password_hash instead

    // Prepare and execute the query securely
    $stmt = $GLOBALS["___mysqli_ston"]->prepare("SELECT * FROM `users` WHERE user = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        // Get user's details
        $row = $result->fetch_assoc();
        $avatar = $row["avatar"];

        // Login successful
        $html .= "<p>Welcome to the password protected area {$user}</p>";
        $html .= "<img src=\"{$avatar}\" />";
    } else {
        // Login failed
        $html .= "<pre><br />Username and/or password incorrect.</pre>";
    }

    $stmt->close();
    ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
}


?>
