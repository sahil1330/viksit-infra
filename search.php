<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viksit Infra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        .container {
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <?php
    $showWarning = false;
    $showAlert = false;
    $showError = false;
    ?>
    <?php
    if ($showWarning) {
        ?>
        <div class="alert alert-warning" role="alert">
            <?php echo $showWarning; ?>
        </div>
        <?php
    }
    if ($showAlert) {
        ?>
        <div class="alert alert-success" role="alert">
            <?php echo $showAlert; ?>
        </div>
        <?php
    }
    if ($showError) {
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $showError; ?>
        </div>
        <?php
    }
    ?>
    <?php
    include 'db/dbconnect.php';
    $sql = "Select * from projects where match (projectName, projectDetails, bid, bidderName, bidderTechnicalData, bidderVerifyingComments) against ('" . $_GET["search"] . "');";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $projectName = $row["projectName"];
        $projectDetails = $row["projectDetails"];
        $bid = $row["bid"];
        $bidderName = $row["bidderName"];
        $bidderTechnicalData = $row["bidderTechnicalData"];
        $bidderVerifyingComments = $row["bidderVerifyingComments"];
        // $projectStatus = $row["projectStatus"];
        // $projectOwner = $row["projectOwner"];
        // $projectCreatedAt = $row["createdAt"];
        // $projectUpdatedAt = $row["updatedAt"];
        $projectId = $row["id"];
    
        // Displaying the search result
        echo '
            <div class="result">
                <h3><a href="comp_to_bid" class="text-dark">'.$projectName.'</a></h3>
                <p>'.$projectDetails.'</p>
            </div>';
    }

    ?>
    <!-- Search results -->
    <div class="container my-3">
        <h1 class="py-3">Search results for <em>"<?php echo $_GET['search']; ?>"</em></h1>
        <div class="result">
            <h3><a href="/projects/ddf" class="text-dark">Cannot find project</a></h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis nisi optio necessitatibus
                explicabo numquam ipsam, ea quis molestias porro consequuntur vitae aut id! Labore amet facere nisi
                similique nostrum, assumenda minima vel. Autem cupiditate nobis molestias. Aliquid, ducimus explicabo.
                At iure saepe ut quae odio accusamus tenetur, dolor, porro molestias omnis ea harum vero tempora vel
                suscipit non sint labore facere hic quasi beatae modi doloribus asperiores officia? Iste id laborum
                maxime quis. Voluptates, dolore aliquid suscipit nostrum sunt incidunt hic sint distinctio quia veniam
                ipsa, delectus obcaecati nesciunt?</p>
        </div>

    </div>

    <?php include 'components/footer.php'; ?>
</body>

</html>