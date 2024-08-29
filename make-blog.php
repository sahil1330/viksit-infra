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
    <h1 class="text-center my-4">Create Blogg</h1>
    <div class="container my-4">
        <form action="create-blog">
        
            <div class="form-group">
            <label for="blog title">Enter your Blog title: </label>
            <input type="text" class="form-control col-md-6" id="blog-title">
            <label for="blog title">Location: </label>
            <input type="text" class="form-control col-md-6" id="blog-location"><br>
            </div>


            <!-- <label for="blog-short-description (optional)">Enter your Blog description: </label>
            <input type="text" class="form-control" id="blog-title"><br> -->

            <label for="blog-contain">Enter your contain </label>
            <textarea class="form-control"  rows="3" id="blog-content"></textarea>
            <br>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" id="blog-img">
                <label class="custom-file-label" for="customFile">Upload imgs</label>
            </div>

            <br>
          <input type="submit">
        </form>

            <?php include 'components/footer.php'; ?>

        </div>
    </div>
</body>

</html>