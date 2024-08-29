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
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <?php
    $showWarning = false;
    $showAlert = false;
    $showError = false;
    if ($companyloggedIn) {
        require "db/dbconnect.php";
        $documentsSql = "Select * from documents where owner='$username'";
        $result = mysqli_query($conn, $documentsSql);
        $row = mysqli_fetch_assoc($result);
        $verificationStatus = $row["verificationStatus"] ?? "pending";
        if ($verificationStatus == "pending") {
            $showWarning = "Your documents are under verification. You will be able to pariticipate in bidding and post blogs once your documents are verified.";
        } else if ($verificationStatus == "verified") {
            $acceptanceMessage = $row['acceptanceMessage'];
            $showAlert = $acceptanceMessage;
        } else if ($verificationStatus == "rejected") {
            $rejectedMessage = $row["rejectionMessage"];
            $showError = $rejectedMessage;
        }
    }
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
    if ($companyloggedIn) {
        ?>
        <div style="display: flex; justify-content: center;">
            <a href="make-blog.php">
                <button type="button" class="btn btn-primary mx-auto">Upload Blog</button>
            </a>
        </div>
        <?php
    }

    ?>
    <h1 class="text-center my-4">INFRA TRENDS</h1>
    <div class="container my-4">

            <?php include "components/blogs.php"; ?>

    </div>
    <?php include 'components/footer.php'; ?>
</body>

</html>