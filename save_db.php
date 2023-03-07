<?php

if (
    isset($_POST['email'])
) {

    require_once 'connection.php';
    $stmt = $conn->prepare("INSERT INTO uesr
      (email)
      VALUES
      (:email)");
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $result = $stmt->execute();
    $conn = null;

    if ($result) {
        echo '<script>
      swal({
          title: "โหวดคะแนนสำเร็จ", 
          text: "รอสักแปปนะครับ",
          type: "success", 
          timer: 3000, 
          showConfirmButton: false 
        }, function(){
          window.location.href = "index.php"; 
          });
    </script>';
    } else {
        echo '<script>
      swal({
        title: "เกิดข้อผิดพลาด",
        type: "error"
      }, function() {
        window.location = "donate_no_receipt.php";
      });
    </script>';
    }
    //else ของ if result

} //isset
