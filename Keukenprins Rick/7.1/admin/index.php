<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <div class="container">
    <div class="row">



      <div class="col-4"> <br></div>
      <br>

      <div class="col-4 text-center">
        <br>
        <form name="stad" method="post" action="create.php">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gebruikers naam:</label>
            <input type="text" class="form-control" name="naam" value="" /><br />

          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="text" class="form-control" name="ww" value="" /><br />
          </div>

          <button style="center" type="submit" class="btn btn-outline-primary btn-lg">Submit</button> <!-- geen idee waarom er een error zit, het werkt ook gewoon allemaal, lol. -->

        </form>
      </div>
      <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <a><?php echo $message ?></a>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>