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
    $showAlert = false;
    $showError = false;
    if ($companyloggedIn) {
        require 'db/dbconnect.php';
        if (isset($_POST['create-blog'])) {
            $blog_title = $_POST['blog-title'];
            $blog_criteria = $_POST['blog-criteria'];
            $blog_location = $_POST['blog-location'];
            $blog_desc = $_POST['blog-desc'];
            $blog_img = $_FILES['blog-img']['name'];
            $blog_owner = $username;
            $blog_img_temp = $_FILES['blog-img']['tmp_name'];
            $blog_img_size = $_FILES['blog-img']['size'];
            $blog_img_error = $_FILES['blog-img']['error'];
            $blog_img_type = $_FILES['blog-img']['type'];
            $blog_img_ext = explode('.', $blog_img);
            $blog_img_actual_ext = strtolower(end($blog_img_ext));
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'webp', 'avif');
            if (in_array(strtolower($blog_img_actual_ext), $allowed_extensions)) {
                if ($blog_img_error === 0) {
                    if ($blog_img_size < 10000000) {
                        $blog_img_name_new = $username . uniqid('', true) . "." . $blog_img_actual_ext;
                        $blog_img_destination = 'assets/images/blog-images/' . $blog_img_name_new;
                        move_uploaded_file($blog_img_temp, $blog_img_destination);
                        $sql = "INSERT INTO blogs (blog_title, blog_desc, criteria, blog_location, blog_image, owner, isPublished, createdAt) VALUES (?, ?, ?, ?, ?, ?, 1, current_timestamp())";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "ssssss", $blog_title, $blog_desc, $blog_criteria, $blog_location, $blog_img_name_new, $blog_owner);
                        if (mysqli_stmt_execute($stmt)) {
                            $showAlert = "Blog created successfully";
                        } else {
                            $showError = "Failed to create blog";
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        $showError = "File size too large";
                    }
                } else {
                    $showError = "Error uploading file";
                }
            } else {
                $showError = "File in invalid format";
            }
        } else {
            echo "Please fill the form and submit";
        }
    }
    ?>
    <?php
    if ($showAlert) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $showAlert; ?>
        </div><?php
    }
    if ($showError) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $showError; ?>
        </div> <?php
    }
    ?>
    <h1 class="text-center my-4">Create Blog</h1>
    <div class="container my-4">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="blog title">Enter your Blog title: </label>
                <input type="text" class="form-control col-md-6" id="blog-title" name="blog-title"><br>
                <label for="blog title">Enter your Blog Criteria: </label>
                <input type="text" class="form-control col-md-6" id="blog-criteria" name="blog-criteria"><br>
                <label for="blog title">Location: </label>
                <input type="text" class="form-control col-md-6" id="blog-location" name="blog-location"><br>
            </div>
            <!-- <label for="blog-short-description (optional)">Enter your Blog description: </label>
            <input type="text" class="form-control" id="blog-title"><br> -->
            <label for="blog-desc">Enter your description: </label>
            <textarea class="form-control" rows="3" id="blog-desc" name="blog-desc"></textarea>
            <br>
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="blog-img" name="blog-img">
                <label class="input-group-text" for="blog-img">Upload</label>
            </div>
            <br>
            <button type="submit" name="create-blog" class="btn btn-primary">Create</button>
        </form>

        <?php include 'components/footer.php'; ?>

    </div>
    </div>
</body>

</html>