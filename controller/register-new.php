<?php
session_start();

require_once __DIR__ . '/../model/connection.php';

$errors = array();

if (isset($_POST['register-btn'])) {
    $idnum = $_POST['idnum'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cubicle_num = $_POST['cubicle_num'];
    $stat = "absent";

    // Check if all values are NOT NULL
    if (empty($idnum)) { $errors['idnum'] = "ID Number is required."; }
    if (empty($fname)) { $errors['fname'] = "First Name is required."; }
    if (empty($lname)) { $errors['lname'] = "Last Name is required."; }
    if (empty($cubicle_num)) { $errors['cubicle_num'] = "Cubicle Number is required."; }

    // Validate ID number format: 20xx-xxxxxx
    if (!preg_match('/^\d{2}-\d{4,6}$/', $idnum)) {
        $errors['idnum_format'] = "ID number format is invalid.";
    }

    // Check if ID number already exists
    if (empty($errors)) {
        $checkIdQuery = "SELECT idnum FROM data WHERE idnum = ?";
        $stmt = $connection->prepare($checkIdQuery);
        $stmt->bind_param('s', $idnum);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors['idnum_exists'] = "ID number already exists.";
        }
        $stmt->close();
    }

    // If errors are present, store them in the session and redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = array(
            'idnum' => $idnum,
            'fname' => $fname,
            'lname' => $lname,
            'cubicle_num' => $cubicle_num
        );
        header('Location: ../index.php');
        exit();
    }
    // If no errors
    else {
        $insertQuery = "INSERT INTO data (idnum, fname, lname, cubicle_num, stat) VALUES (?, ?, ?, ?, ?)";

        $stmt = $connection->prepare($insertQuery);
        $stmt->bind_param('sssss', $idnum, $fname, $lname, $cubicle_num, $stat);

        if ($stmt->execute()) {
            header('Location: ../index.php');
        } else {
            $errors['db_error'] = "Database Error: Failed to Register.";
        }
    }
    $connection->close();
}

if (isset($_POST['update-btn'])) {
    $idnum = $_POST['idnum'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cubicle_num = $_POST['cubicle_num'];
    $stat = "absent";

    // Check if all values are NOT NULL
    if (empty($idnum)) { $errors['idnum'] = "ID Number is required."; }
    if (empty($fname)) { $errors['fname'] = "First Name is required."; }
    if (empty($lname)) { $errors['lname'] = "Last Name is required."; }
    if (empty($cubicle_num)) { $errors['cubicle_num'] = "Cubicle Number is required."; }

    // Validate ID number format: 20xx-xxxxxx
    if (!preg_match('/^\d{2}-\d{4,6}$/', $idnum)) {
        $errors['idnum_format'] = "ID number format is invalid.";
    }

    if (count($errors) == 0) {
        // Verify if the cubicle_num exists
        $selectQuery = "SELECT * FROM data WHERE cubicle_num='$cubicle_num'";
        $result = mysqli_query($connection, $selectQuery);

        if (mysqli_num_rows($result) > 0) {
            // Update the record
            $updateQuery = "UPDATE data SET idnum='$idnum', fname='$fname', lname='$lname', stat='$stat' WHERE cubicle_num='$cubicle_num'";
            if (mysqli_query($connection, $updateQuery)) {
                header('Location: ../index.php');
            } else {
                $errors['database'] = "Error updating data: " . mysqli_error($connection);
            }
        } else {
            $errors['cubicle_num'] = "Cubicle number does not exist";
        }
    }
}

if (isset($_POST['delete-record'])) {
    $cubicle_num = $_POST['cubicle_num'];
    
    $selectQuery = "SELECT * FROM data WHERE cubicle_num='$cubicle_num'";
    $result = mysqli_query($connection, $selectQuery);

    if (mysqli_num_rows($result) > 0) {
        // Delete the record
        $deleteQuery = "DELETE FROM data WHERE cubicle_num='$cubicle_num'";
        if (mysqli_query($connection, $deleteQuery)) {
            header('Location: ../index.php');
        } else {
            $errors['database'] = "Error deleting data: " . mysqli_error($connection);
        }
    } else {
        $errors['cubicle_num'] = "Cubicle number does not exist";
    }
}

if (isset($_POST['auto-update-btn'])) {
    $updateQuery = "UPDATE data SET stat='absent'";
    if (mysqli_query($connection, $updateQuery)) {
        $errors['status'] = "Status Change Successful";
        header('Location: ../index.php');
    } else {
        $errors['error'] = "Status Change Unsuccessful";
        header('Location: ../index.php');
    }
    mysqli_close($connection);
}

?>
