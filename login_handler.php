<?php
session_start();

function flash($message, $type = 'info')
{
    if (!isset($_SESSION['flash_messages'])) {
        $_SESSION['flash_messages'] = [];
    }
    $_SESSION['flash_messages'][$type][] = $message;
}

include 'includes/header.php';

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
        header('Location: admin/home.php');
    } elseif ($_SESSION['user']['role'] === 'student') {
        header('Location: student/home.php');
    } elseif ($_SESSION['user']['role'] === 'faculty') {
        header('Location: faculty/home.php');
    }
    exit;
}

if ($_POST) {
    include('database/connection.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verify Admin Login (with password verification)
    $query = 'SELECT * FROM users WHERE email = :email';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();

        if (password_verify($password, $user['password'])) {
            $user['role'] = 'admin';
            $_SESSION['user'] = $user;
            $_SESSION['login_name'] = $user['firstname'] . ' ' . $user['lastname'];
            header('location: admin/home.php');
            exit;
        }
    }

    // Verify Student Login (with password verification)
    $query = 'SELECT * FROM student_list WHERE email = :email';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();

        // Verify hashed password for student
        if (password_verify($password, $user['password'])) {
            $user['role'] = 'student';
            $_SESSION['user'] = $user;
            $_SESSION['login_name'] = $user['firstname'] . ' ' . $user['lastname'];
            header('location: student/home.php');
            exit;
        }
    }

    // Verify Faculty Login (with password verification)
    $query = 'SELECT * FROM college_faculty_list WHERE email = :email';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();

        // Verify hashed password for faculty
        if (password_verify($password, $user['password'])) {
            $user['role'] = 'faculty';
            $_SESSION['user'] = $user;
            $_SESSION['login_name'] = $user['firstname'] . ' ' . $user['lastname'];
            header('location: faculty/home.php');
            exit;
        }
    }

    // If login fails
    flash('Username or password is incorrect.', 'danger');
    header('location: index.php');
    exit;
}
?>