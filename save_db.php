<meta charset="utf-8">
<?php

if (isset($_POST['email']) && isset($_POST['poster_id'])) {
  $email = $_POST['email'];
  $poster_id = $_POST['poster_id'];

  // Check if both email and poster_id are not empty
  if (!empty($email) && !empty($poster_id)) {
    // Check if the email already exists in the database for this poster_id
    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM uesr WHERE email = ?");
    $check_stmt->execute([$email]);
    $num = $check_stmt->fetchColumn();

    if ($num > 0) {
      // Display error message and redirect back to the form page
      echo '<script>
        swal({
          title: "Eamil นี้ได้มีการโหวดคะแนนไปแล้ว",
          type: "error"
        }, function() {
          window.location = "index.php";
        });
      </script>';
      exit;
    }

    // Insert the email and poster_id into the database
    $insert_stmt = $conn->prepare("INSERT INTO uesr (email, poster_id) VALUES (?, ?)");
    $result = $insert_stmt->execute([$email, $poster_id]);

    if ($result) {
      // Display success message and redirect to the next page
      echo '<script>
        swal({
          title: "บันทึกคะแนนโหวดสำเร็จ",
          text: "ขอบคุณนี้ลงคะแนน",
          type: "success",
          timer: 3000,
          showConfirmButton: false
        }, function(){
          window.location.href = "index.php";
        });
      </script>';
      exit;
    } else {
      // Display error message and redirect back to the form page
      echo '<script>
        swal({
          title: "เกิดข้อผิดพลาด",
          type: "error"
        }, function() {
          window.location = "index.php";
        });
      </script>';
      exit;
    }
  } else {
    // Display error message and redirect back to the form page
    echo '<script>
      swal({
        title: "กรุณากรอกข้อมูลให้ครบถ้วน",
        type: "error"
      }, function() {
        window.location = "index.php";
      });
    </script>';
    exit;
  }
}


?>