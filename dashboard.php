<?php
// Start the session
session_start();

// Check if the user is logged in by checking the session variable
if (!isset($_SESSION['email'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.php');
    exit;
}

// Get the logged-in user's email
$userEmail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-4">
        <!-- Row for the heading and logout button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="top text-center">Welcome to the System, <?php echo htmlspecialchars($userEmail); ?>!</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add a Subject</h5>
                        <p class="card-text">This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
                        <a href="#" class="btn btn-primary">Add Subject</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Register a Student</h5>
                        <p class="card-text">This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>
                        <a href="student/register.php" class="btn btn-primary">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>