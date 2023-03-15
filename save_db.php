<meta charset="utf-8">
<?php
if (isset($_POST['email'], $_POST['poster_id'], $_POST['poster_level'], $_POST['poster_presenter'],$_POST['poster_name'])) {
  $email = $_POST['email'];
  $poster_id = $_POST['poster_id'];
  $poster_level = $_POST['poster_level'];
  $poster_presenter = $_POST['poster_presenter'];
  $poster_name = $_POST['poster_name'];
  
  if (!empty($email)) {
    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM user_reg WHERE email = ?");
    $check_stmt->execute([$email]);
    $num = $check_stmt->fetchColumn();

    if ($num > 0) {
      // Check if both email and poster_id are not empty
      if (!empty($poster_id)) {
        // Check if the email already exists in the database for this poster_id
        $check_stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = ? AND poster_id = ?");
        $check_stmt->execute([$email, $poster_id]);
        $num = $check_stmt->fetchColumn();

        if ($num > 0) {
          // Display error message and redirect back to the form page
          echo '<script>
              swal({
                title: "Email นี้ได้มีการโหวดคะแนนไปแล้ว",
                text: "โหวตนวัตกรรมที่ท่านประทับใจได้เพียง 1 ผลงานที่เท่านั้น",
                type: "error"
              }, function() {
                window.location = "index.php";
              });
            </script>';
          exit;
        }

        // Insert the email and poster_id into the database
        $insert_stmt = $conn->prepare("INSERT INTO user (email, poster_id, poster_level, poster_presenter, poster_name) VALUES (?,?,?,?,?)");
        $insert_stmt->execute([$email, $poster_id, $poster_level, $poster_presenter, $poster_name]);

        // Display success message and redirect to the next page
        echo '<script>
            swal({
              title: "บันทึกคะแนนโหวดสำเร็จ",
              text: "ขอบคุณที่ลงคะแนน",
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
              title: "กรุณากรอกข้อมูลให้ครบถ้วน",
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
            title: "Email ยังไม่ได้ทำการลงทะเบียน",
            text: "กรุณาลงทะเบียนก่อนเข้างาน",
            type: "error"
          }, function() {
            window.location = "index.php";
      });
    </script>';
      exit;
    }
  }
}
?>