<?php
  $insert = false;
  $update= false;
  $delete= false;
  


     // Connecting to the Database 
      $servername="localhost";
      $username="root";
      $password="";
      $database="crud";

// Create a Connection
    $conn = mysqli_connect($servername, $username, $password, $database);
     // Die if connection was not successful

     if (!$conn){
      die("Sorry we faield to connect:".mysqli_connect_error());
        echo "<br>";
        //  exit();
      }
      // for delete 
      if(isset($_GET['delete'])){
        $sno = $_GET['delete'];
        $delete=true;
        $sql ="DELETE FROM `inotes` WHERE `sno` = $sno";
        $result = mysqli_query($conn,$sql);


      }
     
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
          if(isset($_POST['snoEdit']))
          {
            // Update The record 
            $sno = $_POST['snoEdit'];
            $text = $_POST['titleEdit'];
            $description = $_POST['descriptionEdit'];
            $sql = "UPDATE `inotes` SET  `title`='$text' , `description` = '$description' WHERE `inotes` .`sno` = $sno";
            $result = mysqli_query($conn,$sql);
            if($result){
                $update=true;
            }
               else
              {
                  echo " The Data was  NOT Updated successfully Because of this error --->  <br> ".mysqli_error($conn);
              }

          }
          else
          { 

            $text = $_POST['title'];
            $description = $_POST['description'];
            // insetion Exicution
            $sql = "INSERT INTO `inotes` (`title`, `description`) VALUES ('$text', '$description')";

            $result = mysqli_query($conn,$sql);
              if($result)
              {
                $insert = true;
              }
              else{
                echo " the record has Not been Inserted successfully! due to this error --->". mysqli_error($conn);
              }
        }

      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - iNotes</title>

    <link rel="stylesheet" href="../bootstrap/bootstrap-4.5.0-dist/css/bootstrap.css">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="../bootstrap/bootstrap-4.5.0-dist/js/bootstrap.js"> </script>

    <script src="../bootstrap/bootstrap-4.5.0-dist/js/bootstrap.bundle.js"> </script>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;600&display=swap" rel="stylesheet">


    <style>
    * {

        font-family: 'Josefin Sans', sans-serif;

    }

    h2 {
        font-weight: bold;
    }

    table {
        font-weight: bold;

    }

    nav {
        font-weight: bold;
        text-transform: uppercase;
    }

    .navtext {
        font-size: 18px;
    }

    a:hover {
        background-color: rgb(51, 47, 47);
    }

    .hnone {
        background-color: none;
    }

    .btncolor {
        background-color: burlywood;
        color: black;
        font-weight: 600;
    }
    </style>


</head>

<body>

    <!-- editModal -->
    <strong>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><strong>Edit This Note</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="\myWebproject\crud_iNotes\index.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="snoEdit" id="snoEdit">
                            <div class="form-group">
                                <label for="title">Edit Note Title</label>
                                <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                                    aria-describedby="emailHelp">
                            </div>

                            <div class="form-group">
                                <label for="desc"> Edit Note Discription</label>
                                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit"
                                    rows="3"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer d-block m-auto">
                            <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
    </strong>
    </form>
    </div>
    </div>
    </div>


    <nav class=" text- navbar navbar-expand-lg " style=" background-color:burlywood ">
        <div style=" padding-left: 100px; padding-right: 100px;" class="container-fluid">
            <a class="navbar-brand hnone " href="#"><img src="crud_img/iNotes_img.jpg" alt="iNotes_img.jpg"
                    style=" height: 45px; "></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white navtext" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white navtext" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white navtext" href="#">Contact Us</a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    </div>
    <?php 
        if($insert){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your Note has been Inserted Successfully .
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }
      ?>
    <?php 
        if($update){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your Note has been Updated Successfully .
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }
      ?> <?php 
      if($delete){
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Success!</strong> Your Note has been Deleted Successfully .
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>";
      }
    ?>

    <div class="container my-4">
        <form action="\myWebproject\crud_iNotes\index.php" method="POST">
            <h2 style="color: black;">Add note in iNotes</h2>
            <div class="form-group">
                <label for="title"><strong>Note Title</strong></label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <label for="desc"><strong>Note Discription</strong></label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btncolor">Add Note</button>
        </form>
    </div>
    <div class="container">
        <hr>
    </div>

    <div class="container" style="color: black;  margin-top: 3rem;">
        <h2>Your Notes Here!</h2>
        <table class="table table-hover" id="myTable">
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

          $sql = "SELECT * FROM `inotes`";
          $result = mysqli_query($conn,$sql);
          // We can show rows in Better Way  
          $s_no = 1;
          while($data = mysqli_fetch_assoc($result))
          { 
            echo "<tr>
                <th scope='row'>".$s_no."</th>
                <td>".$data['title']."</td>
                <td>".$data['description']."</td>
                <td><button class='edit btn-sm btncolor' id =".$data['sno']."  >Edit</button> <button class='Delete btn-sm btncolor' id=d".$data['sno'].">Delete</button>

              </tr>";
              $s_no += 1;
      
          }


          ?>
            </tbody>
        </table>
        <hr>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"> </script>

    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>

    <script>
    // js for edit
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit ");
            tr = e.target.parentNode.parentNode;

            title = tr.getElementsByTagName("td")[0].innerText;
            description = tr.getElementsByTagName("td")[1].innerText;
            console.log(title, description);
            titleEdit.value = title;
            descriptionEdit.value = description;
            snoEdit.value = e.target.id;
            console.log(e.target.id);
            $('#editModal').modal('toggle')


        })
    })
    // js for detete
    Deletes = document.getElementsByClassName('Delete');
    Array.from(Deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("Delete ");
            sno = e.target.id.substr(1, );

            if (confirm("Are You Sure, You Want To DELETE This Note!")) {
                console.log("yes");
                window.location = `index.php?delete=${sno}`;
                // Create a form and use Post request to Submit a form


            } else {
                console.log("no");
            }


        })
    })
    </script>

</body>

</html>