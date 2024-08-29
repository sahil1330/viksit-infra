<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Bid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include "components/navbar.php" ?>
    <?php
    if ($adminloggedIn) {
        ?>
        <div class="container mt-4">
            <h1 class="text-center mb-4">Submit Your Bid</h1>
            <form action="comp_bid_process.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="bidderName" class="form-label">BIDder Name</label>
                    <input type="text" class="form-control" id="bidderName" name="bidderName" required>
                </div>
                <div class="mb-3">
                    <label for="bidamt" class="form-label">BIDder Amt</label>
                    <input type="number" class="form-control" id="bidamt" name="bidamt" required>
                </div>
                <div class="mb-3">
                    <label for="bidderBudget" class="form-label">Bidder Budget (PDF)</label>
                    <input type="file" class="form-control" id="bidderBudget" name="bidderBudget" accept=".pdf" required>
                </div>
                <div class="mb-3">
                    <label for="bidderTechnicalData" class="form-label">Bidder Technical Data (PDF)</label>
                    <input type="file" class="form-control" id="bidderTechnicalData" name="bidderTechnicalData"
                        accept=".pdf" required>
                </div>
                <div class="mb-3">
                    <label for="bidderNextAudit" class="form-label">BIDder Next Audit</label>
                    <input type="date" class="form-control" id="bidderNextAudit" name="bidderNextAudit" required>
                </div>
                <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($_GET['project_id']); ?>">
                <button type="submit" class="btn btn-primary">Submit Bid</button>
            </form>
        </div>
        <?php
    }
    ?>
</body>

</html>