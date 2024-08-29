<!-- 
<div class="d-flex flex-row mb-3">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="..." class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="..." class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="row mb-4">
    <?php
    $sql = "SELECT * FROM blogs";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $blog_id = $row['id'];
        $blog_title = $row['blog_title'];
        $blog_desc = $row['blog_desc'];
        $blog_img = $row['blog_image'];
        $blog_criteria = $row['criteria'];
        $blog_location = $row['blog_location'];
        $isPublished = $row['isPublished'];
        $blog_date_created = $row['createdAt'];
        $blog_date_updated = $row['updatedAt'] ?? $blog_date_created;
        $author = $row['owner'];
        ?>
        <div class="col-md-6 ">
            <a href="<?php echo "blog.php?blogid=".$blog_id?>">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo "assets/images/blog-images/" . $blog_img ?>"
                                class="img-fluid rounded-start" alt="<?php echo $blog_id; ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $blog_title; ?> </h5>
                                <p class="card-text"><?php echo substr($blog_desc, 0, 500); ?></p>
                                <p class="card-text"><small
                                        class="text-body-secondary"><?php echo $blog_date_created; ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
    } ?>

    <div class="col-md-6 ">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="..." class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Blog title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural
                            lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>