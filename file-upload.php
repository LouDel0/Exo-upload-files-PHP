<?php
// SI le bouton 'submit' est cliqué :
if (isset($_POST['submit'])) {
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png', 'pdf');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) {
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = 'uploads/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        header("Location: image-upload.php");
      } else {
        echo "Your file is too big!";
      }
    } else {
      echo "There was an error uploading your file!";
    }
  } else {
    echo "You cannot upload files of this type!";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>image upload</title>

  <!-- jQuery via CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <!-- Page JS -->
  <script src="main.js" defer></script>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Dropzone -->
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

</head>

<body>
  <div class="container p-5">
    <h1 class="display-1 text-center">Télécharger un fichier</h1>
    <div class="container pt-5">
      <button type="button-open" class="btn btn-primary">> Ouvrir la pop-up</button>
      <!-- <button type="button-close" class="btn btn-danger">> Fermer la pop-up</button> -->
    </div>
    <div class="popup container border mt-2 p-5">
      <div class="form">
        <form method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>">
          <input type="file" class="file" name="file">
          <input type="submit" value="Télécharger" name="submit">
        </form>
      </div>
    </div>
  </div>
</body>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</html>