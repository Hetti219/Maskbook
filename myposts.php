<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
}

$u = $_SESSION['user'];

?>

<!doctype html>
<html lang="en">

<head>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>My Posts</title>
</head>

<body class="bg-dark text-light">
    <?php
    $homelink = "";
    $mypostslink = "active";
    include_once('navigation.php');
    ?>


    <div class="card mt-4 bg-dark text-light">

        <div class="card-body">
            <form action="dbh/mynewposts.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Unmask Your Thoughts</label>
                    <textarea class="form-control bg-dark text-light" id="exampleFormControlTextarea1" rows="3" name="desc" minlength="10" maxlength="200" placeholder="Type your thoughts here..."></textarea>
                </div>

                <input type="hidden" name="size" value="12345678">
                <div class="mb-3">
                    <input type="file" name="image">
                </div>

                <button type="submit" class="btn btn-light">Post<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                    </svg></button>
            </form>



        </div>
    </div>



    <?php
    include('dbh/dbdata.php');

    $con = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
    $sql = "SELECT id,description,date,email,image FROM masks WHERE email='$u' ORDER BY date DESC";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];

    ?>


        <div class="card border-light mt-4 bg-dark text-light container-fluid">
            <div class="card-header">
                <?php echo ($row['date']); ?>
                <div style="text-align:end;">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#del"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg></button>


                    <div class="modal" id="del" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark text-light">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you want to delete this post?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <form action="dbh/deletepost.php" method="POST">
                                        <button type="submit" class="btn btn-primary" name="id" value="<?php echo ($id); ?>">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p><?php echo ($row['description']); ?></p>
                    <div id="img_div">
                        <?php
                        if ($row['image'] != null) {
                            echo "<img src='dbh/images/" . $row['image'] . "' style='width:100%'>";
                        } ?>
                    </div>
                    <footer class="blockquote-footer">Someone with the email <cite title="Source Title"><?php echo ($row['email']); ?></cite></footer>
                </blockquote>
            </div>
        </div>





        <?php
        if (isset($_GET['failed'])) {
            echo ("<div class='alert alert-danger mt-3' role='alert' id='success'>
                Failed to Upload your Post
              </div>");
        }
        ?>

    <?php
    }
    $con->close();
    ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</body>

</html>