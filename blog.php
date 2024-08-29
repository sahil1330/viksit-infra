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
    $blogid = $_GET['blogid'];
    require "db/dbconnect.php";
    $sql = "SELECT * FROM blogs WHERE id='$blogid'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $blog_criteria = $row["criteria"];
        $blog_title = $row["blog_title"];
        $blog_desc = $row["blog_desc"];
        $blog_image = $row["blog_image"];
        $blog_location = $row["blog_location"];
        $blog_author = $row["owner"];
        $blog_date = $row["updatedAt"] ?? $row["createdAt"];

    }
    ?>
    <div class="container my-8">

        <h2><?php echo $blog_title; ?></h2>
        <h6><?php echo $blog_date ?></h6>
        <img src="<?php echo "assets/images/blog-images/" . $blog_image; ?>" alt="" height="360" width="640">
        <p class="col-md-8"><?php echo $blog_desc ?></p>

        <h4>Comments</h4>
        <div class="container">
            <div class="row">
                <?php
                if($criticloggedIn || $companyloggedIn){
                $commentsql = "Select * from comments where blogId='$blogid'";
                $result = mysqli_query($conn, $commentsql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $comment = $row["content"];
                    $comment_owner = $row["owner"];
                    $comment_remark = $row["remark"];
                    $comment_date = $row["updatedAt"] ?? $row['createdAt'];

                    ?>
                    <div class=" col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $comment_owner; ?></h5>
                                <p class="card-text"><?php echo $comment; ?></p>
                                <div class="row" style="display: flex; justify-content: space-between">
                                    <p class="card-text"><small class="text-muted"><?php echo $comment_date; ?></small></p>
                                    <p class=""><small class="<?php
                                    if ($comment_remark == "positive") {
                                        echo "text-success";
                                    } else {
                                        echo "text-danger";
                                    }
                                    ?>"><?php echo $comment_remark ?></small></p>
                                </div>

                            </div>
                        </div>
                    </div><?php
                }
            }
                ?>
            </div>
        </div>
        <div class="container my-4">
            <?php
            if ($criticloggedIn || $companyloggedIn) {
                if (isset($_POST['post-comment'])) {
                    $comment = $_POST['comment'];
                    $remark = $_POST['remark'];
                    $sql = "INSERT INTO comments (blogId, content, owner, remark, createdAt ) VALUES ('$blogid', '$comment', '$username', '$remark', current_timestamp())";
                    if (mysqli_query($conn, $sql)) {
                        $showAlert = "Comment posted successfully";
                    } else {
                        $showError = "Error posting comment";
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
                <h4>Post a Comment</h4>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for=" comment">Comment</label>
                        <textarea class="form-control" name="comment" id="comment" rows="3"
                            placeholder="Enter your Comment"></textarea> <br>
                        <select class="form-select" aria-label="comment remark" name="remark">
                            <option selected>Remark</option>
                            <option value="positive">Positive</option>
                            <option value="negative">Negative</option>
                        </select> <br>
                        <button type="submit" class="btn btn-primary my-2" name="post-comment">Submit</button>
                </form>
                <?php
            } ?>
        </div>
    </div>

    <div class="side-bar my-4 ">
        <h3>Recent Blogs</h3>
        <div class="container">
            <div class="row">
                <?php
                
                echo'
                <div class="col-md-3">
                    <img src="assets/blog/blogid1/1703680099New Project (8).jpg" alt="" height="120" width="240">
                    <h5>Blog Title</h5>
                    <h6>description...........</h6>
                    <h6>date </h6>
                </div>';
                ?>
                <div class="col-md-3">
                    <img src="assets/blog/blogid1/1703680099New Project (8).jpg" alt="" height="120" width="240">
                    <h5>Blog Title</h5>
                    <h6>description...........</h6>
                    <h6>date </h6>
                </div>
                <div class="col-md-3">
                    <img src="assets/blog/blogid1/1703680099New Project (8).jpg" alt="" height="120" width="240">
                    <h5>Blog Title</h5>
                    <h6>description...........</h6>
                    <h6>date </h6>
                </div>
            </div>
        </div>
    </div>




    <?php include 'components/footer.php'; ?>

    </div>
    </div>
</body>

</html>