<?php 
include 'db.php';

$firstname = $_SESSION['first_name'] ?? '';
$lastname  = $_SESSION['last_name'] ?? '';
$phone     = $_SESSION['phone'] ?? '';
$email     = $_SESSION['email'] ?? '';
$address   = $_SESSION['address'] ?? '';

$errors = ['first_name' => '', 'last_name' => '', 'phone' => '', 'email' => '', 'address' => ''];
$current_step = 'step1';
if (isset($_POST['save'])) {
    $firstname = trim($_POST['first_name']);
    $lastname  = trim($_POST['last_name']);
    if (empty($firstname)) {
        $errors['first_name'] = "Please enter your first name.";
    } elseif (strlen($firstname) < 3) {
        $errors['first_name'] = "First name must be at least 3 characters.";
    }
    if (empty($lastname)) {
        $errors['last_name'] = "Please enter your last name.";
    } elseif (strlen($lastname) < 3) {
        $errors['last_name'] = "Last name must be at least 3 characters.";
    }
    if (empty($errors['first_name']) && empty($errors['last_name'])) {
        $_SESSION['first_name'] = $firstname;
        $_SESSION['last_name']  = $lastname;
        $current_step = 'step2';
    } else {
        $current_step = 'step1';
    }
}

if (isset($_POST['save_1'])) {
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    if (empty($phone)) {
        $errors['phone'] = "Please enter your phone number.";
    } elseif (!preg_match('/^\d{10}$/', $phone)) {
        $errors['phone'] = "Phone number must be exactly 10 digits.";
    }
    if (empty($email)) {
        $errors['email'] = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }
    if (empty($errors['phone']) && empty($errors['email'])) {
        $_SESSION['phone'] = $phone;
        $_SESSION['email'] = $email;
        $current_step = 'step3';
    } else {
        $current_step = 'step2';
    }
}

if (isset($_POST['save_3'])) {
    $address = trim($_POST['address']);
    $errors['address'] = '';
    if (empty($address)) {
        $errors['address'] = "Please enter your address.";
    } elseif (strlen($address) < 10) {
        $errors['address'] = "address must be exactly 10 digits.";
    }
    if (empty($errors['address'])) {
        $imageName = '';
        if (!empty($_FILES['image']['name'])) {
            $targetDir = "uploads/"; 
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $imageName = time() . "_" . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $imageName;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $_SESSION['image'] = $imageName;
            } else {
                echo "Error uploading image.";
            }
        }
        $_SESSION['address'] = $address;
        $sql = "INSERT INTO multi_forms(first_name,last_name,email,phone,image,address)VALUES(?,?,?,?,?,?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssssss",
            $_SESSION['first_name'],
            $_SESSION['last_name'],
            $_SESSION['email'],
            $_SESSION['phone'],
            $_SESSION['image'],
            $_SESSION['address'],
        );
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['form_completed'] = true;
            unset($_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['email'], $_SESSION['phone'], $_SESSION['address'], $_SESSION['image']);
            header("Location: welcome.php");
            exit();
        }
    }
}