<?php
$insert=false;
$update=false;
$delete=false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "note";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}
if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `notes` WHERE `SNO` = '$sno'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Deletion successful
        $delete = true;
    } else {
        // Deletion failed
        echo "The record was not deleted due to this error: " . mysqli_error($conn);
    }
}

// echo $_GET['update'];
// echo $_POST['SNOEDIT'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['SNOEDIT'])){

        $sno=$_POST["SNOEDIT"];
        $title =$_POST['TITLEEDIT'];
    $description =$_POST['DESCRIPTIONEDIT'];
    $sql = "UPDATE `notes` SET `TITLE` = '$title', `DESCRIPTION` = '$description' WHERE `notes`.`SNO` = $sno;";
    $result = mysqli_query($conn, $sql);
    if($result){
        $update=true;
    }
    }
    else{
    $title =$_POST['TITLE'];
    $description =$_POST['DESCRIPTION'];
    $sql = "INSERT INTO `notes` (`TITLE`, `DESCRIPTION`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $insert=true;
        // echo "The record has been successfully inserted <br>";
    } else {
        echo "The record was not inserted because of this error: " . mysqli_error($conn);
    }
}
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script> -->

    <title>INote-Note taking made easy</title>
</head>

<body>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">Edit Notes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/INote/" method="post">
                <div class="modal-body">
                    
                        <input type="hidden" name="SNOEDIT" id="SNOEDIT">
                        <div class="form-group">
                            <label for="title">Note Title</label>
                            <input type="text" class="form-control" id="TITLEEDIT" name="TITLEEDIT"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="desc">Note Description</label>
                            <textarea class="form-control" id="DESCRIPTIONEDIT" name="DESCRIPTIONEDIT"
                                rows="3"></textarea>
                        </div>
                    
                </div>
                <div class="modal-footer d-block mr-auto">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">INote</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>success </strong>your note has been inserted successfully
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    ?>
    <?php
    if($delete){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>success </strong>your note has been deleted successfully
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    ?>
    <?php
    if($update){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>success </strong>your note has been updated successfully
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    ?>
    <div class="container my-4">
        <h2>Add Note</h2>
        <form action="/INote/index.php" method="post">
            <div class="form-group">
                <label for="title">Note Title</label>
                <input type="text" class="form-control" id="TITLE" name="TITLE" aria-describedby="emailHelp"
                    placeholder="">
            </div>
            <div class="form-group">
                <label for="desc">Note Description</label>
                <textarea class="form-control" id="DESCRIPTION" name="DESCRIPTION" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>
    <div class="container" my-4>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);
                $sno=0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno=$sno+1;
                    echo "<tr>
                        <th scope='row'>" . $sno . "</th>
                        <td>" . $row['TITLE'] . "</td>
                        <td>" . $row['DESCRIPTION'] . "</td>
                        <td><button class='edit btn btn-sm btn-primary' id=".$row['SNO'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['SNO'].">Delete</button></td>
                    </tr>";
                }
                
                ?>
            </tbody>
        </table>
    </div>
    <hr>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script>


        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((elements) => {
            elements.addEventListener("click", (e) => {
                console.log("edit ",);
                tr = e.target.parentNode.parentNode;
                TITLE = tr.getElementsByTagName("td")[0].innerText;
                DESCRIPTION = tr.getElementsByTagName("td")[1].innerText;
                console.log(TITLE, DESCRIPTION);
                TITLEEDIT.value = TITLE;
                DESCRIPTIONEDIT.value = DESCRIPTION;
                SNOEDIT.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');

            })
        })
        deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/INote/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    </script>
</body>

</html>