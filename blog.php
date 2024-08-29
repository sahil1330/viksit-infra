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
    
    <h1 class="text-center my-4">Create Blog</h1>
    <div class="container my-8">
        
        <h2>Title</h2>
        <h6>date </h6> 
        <img src="assets/blog/blogid1/1703680099New Project (8).jpg" alt="" height="360" width="640">
        <p class="col-md-8">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores quo beatae iste esse dignissimos odio qui sequi molestias, unde sed suscipit veniam consequatur culpa consequuntur ad ut praesentium quibusdam voluptatibus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati vero sit illum eligendi! Tempora optio assumenda omnis ratione qui aliquam animi, necessitatibus voluptatibus sed adipisci vero minima totam accusamus enim. Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum harum consequuntur, dolorem nobis placeat qui labore atque quas quod amet nostrum assumenda architecto ea in enim? Provident consequatur officia quidem!</p>

        <h4>Comments</h4>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-4">
            <form action="" method="POST">
                <div class="form-group
                <label for="comment">Comment</label>
                 <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Enter your Comment"></textarea>
                <button type="submit" class="btn btn-primary my-2">Submit</button>
            </form>
        </div>
    </div>

    <div class="side-bar my-4 ">
        <h3>Recent Blogs</h3>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img src="assets/blog/blogid1/1703680099New Project (8).jpg" alt="" height="120" width="240">
                    <h5>Blog Title</h5>
                    <h6>description...........</h6>
                    <h6>date </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <img src="assets/blog/blogid1/1703680099New Project (8).jpg" alt="" height="120" width="240">
                    <h5>Blog Title</h5>
                    <h6>description...........</h6>
                    <h6>date </h6>
                </div>
            </div>
            <div class="row">
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