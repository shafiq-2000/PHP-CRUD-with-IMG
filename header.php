<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>image_insert</title>

  <!-- font awesome -->
  <link rel="stylesheet" href="css/all.min.css">
  <!-- bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- main css  -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <!-- image preview -->
  <script type="text/javascript">
    // function previewImage(event) {
    //   var input = event.target;
    //   var image = document.getElementById('preview');
    //   if (input.files && input.files[0]) {
    //     var reader = new FileReader();
    //     reader.onload = function(e) {
    //       image.src = e.target.result;
    //     }
    //     reader.readAsDataURL(input.files[0]);
    //   }
    // }

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block'; // প্রিভিউ ইমেজ দেখানো হচ্ছে
        };
        reader.readAsDataURL(event.target.files[0]);
    }
  </script>

<style>
    #preview {
        margin-top: 10px;
        width: 180px;
        height: 200px;
        border: 2px solid #ddd;
        padding: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, .2);
        border-radius: 5px;
        transition: transform .2s ease-in-out;
    }

    #preview:hover {
        transform: scale(1.05);
    }
</style>

</head>