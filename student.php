
<?php
$conn = mysqli_connect("localhost", "root", "123321", "school_db");

if (!$conn) {
    die("Database connection failed.");
}

mysqli_set_charset($conn, "utf8mb4");

$search_name = "";
$result = null;
$searched = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_name = trim($_POST['search_name'] ?? '');
    $searched = true;

    $search = "%" . $search_name . "%";

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM students WHERE name LIKE ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $search);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
}

include 'nav.php';
?>

<div class="container">

    <div class="page-header">
        <h1>Student Check</h1>

        <p>Search for a student by name and view their score and status.</p>

        <i class="bi bi-mortarboard-fill header-icon"></i>
    </div>

    <!-- Search Form -->
    <div class="portal-card mb-4">

        <form method="POST">
            <div class="row g-3 align-items-end">

                <div class="col-md-8">
                    <label class="form-label">Student Name</label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person-fill"></i>
                        </span>

                        <input type="text"
                               name="search_name"
                               class="form-control"
                               placeholder="Enter student name"
                               value="<?= htmlspecialchars($search_name) ?>"
                               required>
                    </div>
                </div>

                <div class="col-md-4">
                    <button type="submit"
                            class="btn btn-primary w-100">
                        <i class="bi bi-search me-2"></i>
                        Search
                    </button>
                </div>

            </div>
        </form>
    </div>

    <!-- Search Results -->
    <div class="portal-card mb-5">

        <div class="card-heading">
            <span class="circle-icon">
                <i class="bi bi-list-ul"></i>
            </span>
            <h4>Search Results</h4>
        </div>

        <?php if ($searched): ?>

            <?php if (mysqli_num_rows($result) > 0): ?>

                <div class="row g-3">

                    <?php while ($student = mysqli_fetch_assoc($result)): ?>

                        <?php
                        $passed = $student['score'] >= 50;
                        $status = $passed ? "Pass" : "Fail";
                        $class = $passed ? "pass" : "fail";
                        ?>

                        <div class="col-lg-4 col-md-6">
                            <div class="result-card">

                                <span class="circle-icon"
                                      style="<?= !$passed ? 'background:#ffe2e7;color:#e32240;' : '' ?>">
                                    <i class="bi bi-person-fill"></i>
                                </span>

                                <div class="result-info">
                                    <strong>
                                        <?= htmlspecialchars($student['name']) ?>
                                    </strong>

                                    <p>
                                        Score: <?= $student['score'] ?>
                                    </p>
                                </div>

                                <span class="status <?= $class ?>">
                                    <?= $status ?>
                                </span>

                            </div>
                        </div>

                    <?php endwhile; ?>

                </div>

            <?php else: ?>

                <div class="alert alert-secondary text-center mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    No student found
                </div>

            <?php endif; ?>

        <?php else: ?>

            <div class="alert alert-light text-center mb-0">
                Enter a student name to view search results.
            </div>

        <?php endif; ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>