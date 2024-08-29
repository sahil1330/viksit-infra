<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <div class="decide">

    </div>
    <div class="container">
        <div class="row mx-auto">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center">Login</h1>
                <div class="row my-4">
                    <div class="col-6">
                        <a href="login-critic.php">
                            <button type="button" class="btn btn-primary">Login as Critic</button>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="login-comp.php">
                            <button type="button" class="btn btn-primary">Login as Company</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>