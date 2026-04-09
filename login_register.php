<?php
session_start();
require 'config.php';

// ───────────────────────────────────────────
//  SIGN UP
// ───────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'signup') {

    $full_name = trim($_POST['full_name']);
    $student_id = trim($_POST['student_id']);
    $course_section = trim($_POST['course_section']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $_SESSION['signup_error'] = "Passwords do not match.";
        $_SESSION['active_form'] = 'signup';
        header("Location: loginpage.php");
        exit();
    }

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['signup_error'] = "Email is already registered.";
        $_SESSION['active_form'] = 'signup';
        header("Location: loginpage.php");
        exit();
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (full_name, student_id, course_section, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $student_id, $course_section, $email, $hashed);

    if ($stmt->execute()) {
        $_SESSION['signup_success'] = "Registration successful!";
        $_SESSION['active_form'] = 'login';
        header("Location: loginpage.php");
        exit();
    } else {
        $_SESSION['signup_error'] = "Signup failed. Please try again.";
        $_SESSION['active_form'] = 'signup';
        header("Location: loginpage.php");
        exit();
    }
}

// ───────────────────────────────────────────
//  LOG IN
// ───────────────────────────────────────────


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];
    // =========================
    // ✅ ADMIN CHECK (ADD HERE)
    // =========================
    if ($email === "leewaldo@pampangasteteu.edu.ph" && $password === "sanapumasakami") {
        $_SESSION['user_role'] = 'admin';
        $_SESSION['user_email'] = $email;

        header("Location: index.php");
        exit();
    }
    // =========================
    $stmt = $conn->prepare("SELECT id, full_name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $full_name, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows === 0) {
        // Email not found
        $_SESSION['login_error'] = "Email not found. Please register first.";
        $_SESSION['active_form'] = 'login';
        header("Location: loginpage.php");
        exit();
    } elseif (!password_verify($password, $hashed_password)) {
        // Wrong password
        $_SESSION['login_error'] = "Incorrect password. Please try again.";
        $_SESSION['active_form'] = 'login';
        header("Location: loginpage.php");
        exit();
    } else {
        // Success
        $_SESSION['user_id'] = $id;
        $_SESSION['full_name'] = $full_name;
        $_SESSION['user_role'] = 'user';
        header("Location: try.php");
        exit();
    }
}

header("Location: loginpage.php");
exit();
?>