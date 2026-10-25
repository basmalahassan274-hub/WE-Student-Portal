
<?php
$conn = mysqli_connect("localhost", "root", "123321", "school_db");

if (!$conn) {
    die("Database connection failed.");
}

mysqli_set_charset($conn, "utf8mb4");

// Delete Student
if (isset($_GET['delete_id'])) {
    $id = (int) $_GET['delete_id'];

    $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: index.php");
    exit();
}

$message = "";

// Add Student
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['student_name'] ?? '');
    $score = $_POST['score'] ?? '';

    if ($name !== "" && is_numeric($score)) {
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO students (name, score) VALUES (?, ?)"
        );

        $score = (int) $score;
        mysqli_stmt_bind_param($stmt, "si", $name, $score);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Student added successfully!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "Please enter valid student information.";
    }
}

$result = mysqli_query($conn, "SELECT * FROM students");
$count = mysqli_num_rows($result);

include 'nav.php';
?>

<div class="container">

    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Manage students, add new records and view all students.</p>
        <i class="bi bi-bookshelf header-icon"></i>
    </div>

    <?php if ($message != ""): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="row g-4 mb-5">

        <!-- Add Student -->
        <div class="col-lg-4">
            <div class="portal-card">

                <div class="card-heading">
                    <span class="circle-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </span>
                    <h4>Add New Student</h4>
                </div>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Student Name</label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>

                            <input type="text"
                                   name="student_name"
                                   class="form-control"
                                   placeholder="Enter student name"
                                   required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Score</label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-bar-chart-fill"></i>
                            </span>

                            <input type="number"
                                   name="score"
                                   class="form-control"
                                   placeholder="Enter score"
                                   required>
                        </div>
                    </div>

                    <button type="submit"
                            class="btn btn-primary w-100">
                        <i class="bi bi-plus-lg me-2"></i>
                        Add Student
                    </button>

                </form>
            </div>
        </div>

        <!-- Students Table -->
        <div class="col-lg-8">
            <div class="portal-card">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">

                    <div class="card-heading mb-0">
                        <span class="circle-icon">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <h4>All Students</h4>
                    </div>

                    <span class="total-badge">
                        <i class="bi bi-display me-2"></i>
                        Total Students: <?= $count ?>
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Score</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $number = 1; ?>

                            <?php while ($student = mysqli_fetch_assoc($result)): ?>

                                <?php
                                $status = $student['score'] >= 50 ? "Pass" : "Fail";
                                $class = $student['score'] >= 50 ? "pass" : "fail";
                                ?>

                                <tr>
                                    <td><?= $number++ ?></td>

                                    <td><?= $student['id'] ?></td>

                                    <td>
                                        <?= htmlspecialchars($student['name']) ?>
                                    </td>

                                    <td><?= $student['score'] ?></td>

                                    <td>
                                        <span class="status <?= $class ?>">
                                            <?= $status ?>
                                        </span>
                                    </td>

                                    <td>
                                        <a href="index.php?delete_id=<?= $student['id'] ?>"
                                           class="delete-btn"
                                           onclick="return confirm('Are you sure you want to delete this student?')">

                                            <i class="bi bi-trash3 me-1"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>

                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
