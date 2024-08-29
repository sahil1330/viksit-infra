<?php
require 'dbconnect.php'; // Include your database connection

// Query to fetch all projects
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Company Dashboard</h1>

        <!-- Projects Table -->
        <?php if ($result->num_rows > 0): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Available BIDs</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Details</th>
                                <th>Deadline</th>
                                <th>BID</th>
                                <th>BID Valid From</th>
                                <th>BID Expire At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['projectName']); ?></td>
                                    <td>
                                        <a href="assets/documents/project-documents/<?php echo htmlspecialchars($row['projectDetails']); ?>" target="_blank">View Details</a>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['deadline']); ?></td>
                                    <td><?php echo htmlspecialchars($row['bid']); ?></td>
                                    <td><?php echo htmlspecialchars($row['bidValidFrom']); ?></td>
                                    <td><?php echo htmlspecialchars($row['bidExpireAt']); ?></td>
                                    <td>
                                        <?php if (strtotime($row['bidExpireAt']) > time()): ?>
                                            <form action="comp_to_bid.php" method="post">
                                                <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                                <button type="submit" class="btn btn-primary">Bid Now</button>
                                            </form>
                                        <?php else: ?>
                                            <button class="btn btn-secondary" disabled>Expired</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                No BIDs available.
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
