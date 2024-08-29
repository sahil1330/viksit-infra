<?php
require 'db/dbconnect.php'; // Include your database connection

// Query to fetch all documents
$sql = "SELECT * FROM documents";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Document Dashboard</h1>

        <!-- Documents Table -->
        <?php
        if ($adminloggedIn) {
            ?>
            <?php if ($result->num_rows > 0): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Documents List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Owner</th>
                                    <th>Documents</th>
                                    <th>Status</th>
                                    <th>Rejection Message</th>
                                    <th>Acceptance Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['owner']); ?></td>
                                        <td>
                                            <?php
                                            $documents = json_decode($row['pastProjectsDocuments']);
                                            foreach ($documents as $doc): ?>
                                                <a href="assets/documents/project-documents/<?php echo htmlspecialchars($doc); ?>"
                                                    target="_blank"><?php echo htmlspecialchars($doc); ?></a><br>
                                            <?php endforeach; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['verificationStatus']); ?></td>
                                        <td><?php echo htmlspecialchars($row['rejectionMessage']); ?></td>
                                        <td><?php echo htmlspecialchars($row['acceptanceMessage']); ?></td>
                                        <td>
                                            <?php if ($row['verificationStatus'] === 'pending'): ?>
                                                <form action="verify_document.php" method="POST">
                                                    <input type="hidden" name="document_id"
                                                        value="<?php echo htmlspecialchars($row['id']); ?>">
                                                    <div class="mb-3">
                                                        <label for="action<?php echo htmlspecialchars($row['id']); ?>"
                                                            class="form-label">Action</label>
                                                        <select class="form-select"
                                                            id="action<?php echo htmlspecialchars($row['id']); ?>" name="action"
                                                            required>
                                                            <option value="">Select action</option>
                                                            <option value="verify">Verify</option>
                                                            <option value="reject">Reject</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="comment<?php echo htmlspecialchars($row['id']); ?>"
                                                            class="form-label">Comment</label>
                                                        <textarea class="form-control"
                                                            id="comment<?php echo htmlspecialchars($row['id']); ?>" name="comment"
                                                            rows="3" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="marks<?php echo htmlspecialchars($row['id']); ?>"
                                                            class="form-label">Marks</label>
                                                        <input type="text" class="form-control" id="marks" name="marks"
                                                            aria-describedby="marks">


                                                    </div>
                                                    <button type="submit" name="marks_submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            <?php else: ?>
                                                <?php echo ($row['verificationStatus'] === 'rejected') ? 'Rejected' : 'Verified'; ?>
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
                    No documents found.
                </div>
            <?php endif; ?>

            <?php
            if ($adminloggedIn) {
                ?>
                <div style="display: flex; justify-content: center;">
                    <a href="make-blog.php">
                        <button type="button" class="btn btn-primary mx-auto">Upload Blog</button>
                    </a>
                </div>
                <br>
                <?php
            }
            ?>
            <!-- Project Form -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add New Project</h5>
                </div>
                <div class="card-body">
                    <form action="process_project.php" method="post">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="projectName" name="projectName" required>
                        </div>
                        <div class="mb-3">
                            <label for="projectDetails" class="form-label">Project Details (PDF)</label>
                            <input type="file" class="form-control" id="projectDetails" name="projectDetails" accept=".pdf"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" required>
                        </div>
                        <div class="mb-3">
                            <label for="bid" class="form-label">BID</label>
                            <input type="text" class="form-control" id="bid" name="bid" required>
                        </div>
                        <div class="mb-3">
                            <label for="bidValidFrom" class="form-label">BID Valid From</label>
                            <input type="date" class="form-control" id="bidValidFrom" name="bidValidFrom" required>
                        </div>
                        <div class="mb-3">
                            <label for="bidExpireAt" class="form-label">BID Expire At</label>
                            <input type="date" class="form-control" id="bidExpireAt" name="bidExpireAt" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="action" value="launch_bid" class="btn btn-primary">Launch
                                BID</button>
                        </div>
                        <!--BID Reg over -->
                        <div class="mb-3">
                            <label for="bidderName" class="form-label">BIDder Name</label>
                            <input type="text" class="form-control" id="bidderName" name="bidderName" required>
                        </div>
                        <div class="mb-3">
                            <label for="bidderBudget" class="form-label">BIDder Budget</label>
                            <input type="number" class="form-control" id="bidderBudget" name="bidderBudget" step="0.01"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="bidderTechnicalData" class="form-label">BIDder Technical Data</label>
                            <textarea class="form-control" id="bidderTechnicalData" name="bidderTechnicalData" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="bidderNextAudit" class="form-label">BIDder Next Audit</label>
                            <input type="date" class="form-control" id="bidderNextAudit" name="bidderNextAudit" required>
                        </div>
                        <div class="mb-3">
                            <label for="bidderVerifyingStatus" class="form-label">Bidder Verifying Status</label>
                            <select class="form-select" id="bidderVerifyingStatus" name="bidderVerifyingStatus" required>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bidderVerifyingComments" class="form-label">Bidder Verifying Comments</label>
                            <textarea class="form-control" id="bidderVerifyingComments" name="bidderVerifyingComments"
                                rows="3"></textarea>
                        </div>
                        <button type="submit" name="bid" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>