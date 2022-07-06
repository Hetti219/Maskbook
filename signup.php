<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Sign Up</title>
</head>

<body>
  <?php
  include_once('header.php');
  ?>
  <div class="container-md w-50 mt-5">
    <form onsubmit="return verifyPasswords()" action="dbh/newuser.php" method="POST">
      <div class="text-center mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </svg>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required onkeyup="hideFailed()">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="pass1" name="password" required onkeyup="hideError()">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Retype</label>
        <input type="password" class="form-control" id="pass2" required onkeyup="hideError()">
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-dark container-md w-50">Signup</button>
      </div>
      <div class="alert alert-danger mt-3" role="alert" id="error" style="visibility:hidden">
        Passwords Do Not Match!
      </div>
      <?php
      if (isset($_GET['failed'])) {
        echo ("<div class='alert alert-warning mt-3' role='alert' id='failed'>
        User Already Exist!
      </div>");
      }

      ?>
    </form>
  </div>


  <script>
    function verifyPasswords() {
      var p1 = document.getElementById("pass1").value;
      var p2 = document.getElementById("pass2").value;
      if (p1 != p2) {
        document.getElementById("error").style.visibility = "visible";
        return false;
      } else {
        return true;
      }
    }

    function hideError() {
      document.getElementById("error").style.visibility = "hidden";
      hideFailed();
    }

    function hideFailed() {
      document.getElementById("failed").style.visibility = "hidden";
    }
  </script>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>