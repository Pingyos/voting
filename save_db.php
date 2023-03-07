<?php

if (
    isset($_POST['name_Title'])
) {

    require_once 'connection.php';
    $stmt = $conn->prepare("INSERT INTO poster
      (eamil)
      VALUES
      (:eamil)");
    $stmt->bindParam(':eamil', $_POST['eamil'], PDO::PARAM_STR);
    $result = $stmt->execute();
    $conn = null;

    if ($result) {
        echo '<script>
      swal({
          title: "บันทึกข้อมูลบริจาคสำเร็จ", 
          text: "ระบบจะทำการ Generator cq code เพื่อให้ท่านได้ชำระเงิน กรุณารอสักครู่",
          type: "success", 
          timer: 3000, 
          showConfirmButton: false 
        }, function(){
          window.location.href = "qrgenerator_receipt.php"; 
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
