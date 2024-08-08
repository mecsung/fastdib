<?php
    require_once 'model/connection.php';

    $errors = array();
    if (isset($_POST['update-btn'])) {
        $idnum = $_POST['idnum'];
        $statusChange = $_POST['statusChange'];

        if (empty($idnum)) { $error['idnum'] = "idnum empty"; }
        if (empty($fstatusChange)) { $error['statusChange'] = "statusChange empty"; }   

        if (count($errors) == 0) {
            // Verify if the ID exists
            $selectQuery = "SELECT * FROM data WHERE idnum='$idnum'";
            $result = mysqli_query($connection, $selectQuery);

            if (mysqli_num_rows($result) > 0) {
                // If ID exists, proceed with update
                $updateQuery = "UPDATE data SET stat='$statusChange' WHERE idnum='$idnum'";
                if (mysqli_query($connection, $updateQuery)) {
                    $successMessage = "Status Change Successful";
                    // header('location: status-change.php');
                } else {
                    $errors['database'] = "Error updating data: " . mysqli_error($connection);
                }

            } else {
                $errors['idnum'] = "ID not found";
            }
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Change Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <!-- <link rel="stylesheet" href="styles/register-style.css"> -->
    <link rel="stylesheet" href="styles/status-change-style.css">
</head>
    <body>
        <div class="box">
            <form action="status-change.php" method="POST">
                <img src="assets/image.png" alt="nufi-logo">
                <div class="text-logo-name">
                    <h2>FaStDiB</h2>
                    <h3>(FAculty STatus DIsplay Board)</h5>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Enter ID Number</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="idnum" placeholder="2x-xxxxxx">
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="statusChange">
                        <option selected>Change Status</option>
                        <option value="in-class">In Class/Campus</option>
                        <option value="at-desk">At Desk</option>
                        <option value="absent">Absent</option>
                    </select>
                </div>
                
                <div class="d-grid gap-2">
                    <input class="btn btn-primary" type="submit" name="update-btn" value="Update">
                </div>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Toast Container -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                <?php echo $error; ?>
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($successMessage)): ?>
                <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <?php echo $successMessage; ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastElList = [].slice.call(document.querySelectorAll('.toast'));
                var toastList = toastElList.map(function(toastEl) {
                    return new bootstrap.Toast(toastEl);
                });
                toastList.forEach(toast => toast.show());
            });
        </script>
    </body>
</html>