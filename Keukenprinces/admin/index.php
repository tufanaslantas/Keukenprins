<?php
if (!isset($message)) $message = '';
?>

<!doctype html>
<html lang="nl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inloggen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-4">
        <h3 class="text-center mb-4">Inloggen</h3>
        <form method="post" action="admin/create.php">
          <div class="mb-3">
            <label for="naam" class="form-label">Gebruikersnaam</label>
            <input type="text" class="form-control" id="naam" name="naam" required>
          </div>
          <div class="mb-3">
            <label for="ww" class="form-label">Wachtwoord</label>
            <input type="password" class="form-control" id="ww" name="ww" required>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Log in</button>
          </div>
        </form>

        <?php if (!empty($message)) : ?>
          <div class="alert alert-info mt-3" role="alert">
            <?= htmlspecialchars($message) ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
