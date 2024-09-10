<?php
include 'connect.php';

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];

  $img_name = $_FILES['image']['name'];
  $tmp_name = $_FILES['image']['tmp_name'];

  // imagae validation

  $file_ext = explode(".", $img_name);
  $file_cheak = strtolower(end($file_ext));
  $valid_name = array('png', 'jpg', 'jepg');
  if (in_array($file_cheak, $valid_name)) {
    if ($_FILES['image']['size'] < 10485760) { //highest 10 mb

      //insert code
      $upload = move_uploaded_file($tmp_name, "imgFolder/" . $img_name);
      if ($upload) {
        $insert = "INSERT INTO image(name,email,image)
                     VALUES('$name','$email','$img_name')";

        $query = mysqli_query($connect, $insert);
        if ($query) {
          echo "<script>alert('image upload success') </script>";
 
        } else {
          echo "<script>alert('image upload failed') </script>";
        }
      } else {
        echo "<script>alert('image upload failed') </script>";
      }
    } else {
      echo "<script>alert('file size very large ,it is not inserted') </script>";
    }
  } else {
    echo "<script>alert('please cheak file!! allow,jpg,png,jepg') </script>";
  }
}

?>
<?php
include 'header.php';
?>

<body class="container bg-white">
  <div class="col-12">
    <h1 class="display-2 bg-danger text-light text-center py-4"> IMAGE CRUD OPERATION</h1>
  </div>

  <div class="row">

    <div class="col-lg-4 shadow">
      <div class="card">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <h1 class=" text-center text-primary py-3">Image Upload</h1>

            <div class="form-group mb-3 mt-3">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
            </div>
            <div class="form-group mb-3 mt-3">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>

            <div class="mb-3">
              <label for="fle">Image:</label>
              <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(event)">
              <img id="preview" alt="Preview Image" style="display: none;">
            </div>
            <div class="text-center form-group py-3 mt-3">
              <button type="submit" class="btn btn-primary text-center" name="submit">Submit</button>

            </div>
          </div>
        </form>

      </div>
    </div>



    <div class="col-lg-8 shadow">
      <table class="table table-striped">
        <h1 class=" text-center text-info py-3">Fetch Image</h1>

        <form action="" method="post" style="margin-bottom: 20px;">
          <input name="searchName" type="text" placeholder="enter serch name..." style="width: 20%;">

          <button name="searchBtn" style="width: 10%;   margin-left: 20px;">Search</button>
        </form>

        <table class="table table-striped">
          <th>#SL</th>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Image</th>
          <th>Edit</th>
          <th> Delete</th>
          <th> Show</th>

          <!-- fecth image from database -->
          <?php
          //way-1
          // $search_data = '';
          // if (isset($_POST['searchBtn'])) {
          //   $search_data = $_POST['searchName'];
          // }
          // $select = "SELECT * FROM image WHERE name LIKE '%" . mysqli_real_escape_string($connect, $search_data) . "%' ORDER BY id desc";
          // $query = mysqli_query($connect, $select);

          $i = 1;
          // way-2
          $searchName = '';
          if (isset($_POST['searchBtn'])) {
            $searchName = $_POST['searchName'];
          }

          $select = "SELECT * FROM image";
          if (!empty($searchName)) {
            $searchName = mysqli_real_escape_string($connect, $searchName);
            $select .= " WHERE name LIKE '%" . $searchName . "%'";
          }
          $select .= " ORDER BY id DESC";

          $query = mysqli_query($connect, $select);

          if (!$query) {
            die('Error: ' . mysqli_error($connect));
          }

          while ($row = mysqli_fetch_array($query)) { ?>

            <tr>
              <td><?php echo $i ?></td>
              <td><?php echo $row['id'] ?></td>
              <td><?php echo $row['name'] ?></td>
              <td><?php echo $row['email'] ?></td>
              <td><img src="imgFolder/<?php echo $row['image']; ?>" height="50" width="50" alt=""></td>
              <td> <a href="edit.php?idno=<?php echo $row["id"] ?>">Edit</a></td>
              <td> <a onclick="return confirm('Are you sure?')" href="delete.php?idno=<?php echo $row["id"] ?>&image_pic=<?php echo $row['image']  ?>">Delete</a></td>
              <td> <a href="show.php?idno=<?php echo $row["id"] ?>">Show</a></td>

            </tr>


          <?php
            $i++;
          }

          ?>

        </table>

    </div>



  </div>



  <!-- font awesome -->
  <script src="js/all.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- main js  -->
  <script src="js/main.js"></script>


</body>

</html>