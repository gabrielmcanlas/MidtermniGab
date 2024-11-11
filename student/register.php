<?php
session_start();

// Initialize an array to store student data
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// Initialize variables
$studentId = $firstName = $lastName = '';
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentId = trim($_POST['studentId']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);

    // Validate inputs
    if (empty($studentId)) {
        $errors[] = "Student ID is required.";
    }
    if (empty($firstName)) {
        $errors[] = "First Name is required.";
    }
    if (empty($lastName)) {
        $errors[] = "Last Name is required.";
    }

    // If there are no errors, process the registration
    if (empty($errors)) {
        // Check if the student ID already exists for editing
        $existingStudentIndex = array_search($studentId, array_column($_SESSION['students'], 'studentId'));
        if ($existingStudentIndex !== false) {
            // Update existing student
            $_SESSION['students'][$existingStudentIndex]['firstName'] = $firstName;
            $_SESSION['students'][$existingStudentIndex]['lastName'] = $lastName;
        } else {
            // Create new student
            $_SESSION['students'][] = [
                'studentId' => $studentId,
                'firstName' => $firstName,
                'lastName' => $lastName
            ];
        }

        // Reset form fields
        $studentId = $firstName = $lastName = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register a New Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="card-title">Register a New Student</h3><br>
        
        <!-- Display error messages -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Registration</li>
                        </ol>
                    </nav>
                </div>
            </nav>
        </div><br>
        <!-- Registration Form Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <!-- Form to Register Student -->
                <form method="POST" id="registrationForm">
                    <div class="mb-3">
                        <label for="studentId" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="studentId" name="studentId" value="<?php echo htmlspecialchars($studentId); ?>" placeholder="Enter Student ID" required>
                    </div>

                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="Enter First Name" required>
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" placeholder="Enter Last Name" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Add Student</button>
                </form>
            </div>
        </div>
        <!-- Student List Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3 class="card-title">Student List</h3>
                <table class="table table-striped" id="studentListTable">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['students'] as $student): ?>
                            <tr>
                                <td <?php echo htmlspecialchars($student['studentId']); ?></td>
                                <td><?php echo htmlspecialchars($student['firstName']); ?></td>
                                <td><?php echo htmlspecialchars($student['lastName']); ?></td>
                                <td>
                                    <form method="POST" action="edit.php" style="display:inline;">
                                        <input type="hidden" name="studentId" value="<?php echo htmlspecialchars($student['studentId']); ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                                    </form>
                                    <form method="POST" action="delete.php" style="display:inline;">
                                        <input type="hidden" name="studentId" value="<?php echo htmlspecialchars($student['studentId']); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>