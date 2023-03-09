<!doctype html>
<html lang="en">

<?php require_once('head.php'); ?>

<body id="section_1">

    <?php require_once('header.php');
    require_once('nav.php'); ?>

    <main>
        <section class="section-padding" id="section_2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center mb-4">
                        <h2>อัพโหลดภาพ POSTER</h2>
                    </div>
                    <div class="col-md-12"> <br>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="text" name="poster_name" required class="form-control" placeholder="ชื่อภาพ"> <br>
                            <input type="text" name="poster_details" required class="form-control" placeholder="รายละเอียด"> <br>
                            <font color="red">*อัพโหลดได้เฉพาะ .jpeg , .jpg , .png </font>
                            <input type="file" name="img_file" required class="form-control" accept="image/jpeg, image/png, image/jpg"> <br>
                            <button type="submit" class="form-control">Submit</button>
                        </form>
                        <h3>รายการภาพ </h3>
                        <table class="table table-striped  table-hover table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อ</th>
                                    <th>รายละเอียด</th>
                                    <th>รูปภาพ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //คิวรี่ข้อมูลมาแสดงในตาราง
                                require_once 'connection.php';
                                $stmt = $conn->prepare("SELECT* FROM poster");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach ($result as $k) {
                                ?>
                                    <tr>
                                        <td><?= $k['poster_id']; ?></td>
                                        <td><?= $k['poster_name']; ?></td>
                                        <td><?= $k['poster_details']; ?></td>
                                        <td><img src="upload/<?= $k['img_file']; ?>" width="70px"></td>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php

                    if (isset($_POST['poster_name'])) {
                        require_once 'connection.php';
                        //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
                        $date1 = date("Ymd_His");
                        //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
                        $numrand = (mt_rand());
                        $img_file = (isset($_POST['img_file']) ? $_POST['img_file'] : '');
                        $upload = $_FILES['img_file']['name'];

                        //มีการอัพโหลดไฟล์
                        if ($upload != '') {
                            //ตัดขื่อเอาเฉพาะนามสกุล
                            $typefile = strrchr($_FILES['img_file']['name'], ".");

                            //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
                            if ($typefile == '.jpg' || $typefile  == '.jpeg' || $typefile  == '.png') {

                                //โฟลเดอร์ที่เก็บไฟล์
                                $path = "upload/";
                                //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
                                $newname = $numrand . $date1 . $typefile;
                                $path_copy = $path . $newname;
                                //คัดลอกไฟล์ไปยังโฟลเดอร์
                                move_uploaded_file($_FILES['img_file']['tmp_name'], $path_copy);

                                //ประกาศตัวแปรรับค่าจากฟอร์ม
                                $poster_name = $_POST['poster_name'];
                                $poster_details = $_POST['poster_details'];

                                //sql insert
                                $stmt = $conn->prepare("INSERT INTO poster (poster_name,poster_details,img_file)
    VALUES (:poster_name, :poster_details,'$newname')");
                                $stmt->bindParam(':poster_name', $poster_name, PDO::PARAM_STR);
                                $stmt->bindParam(':poster_details', $poster_details, PDO::PARAM_STR);
                                $result = $stmt->execute();
                                //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
                                if ($result) {
                                    echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "อัพโหลดภาพสำเร็จ",
                          type: "success"
                      }, function() {
                          window.location = "upload.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
                                } else {
                                    echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เกิดข้อผิดพลาด",
                          type: "error"
                      }, function() {
                          window.location = "upload.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
                                } //else ของ if result


                            } else { //ถ้าไฟล์ที่อัพโหลดไม่ตรงตามที่กำหนด
                                echo '<script>
                         setTimeout(function() {
                          swal({
                              title: "คุณอัพโหลดไฟล์ไม่ถูกต้อง",
                              type: "error"
                          }, function() {
                              window.location = "upload.php"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';
                            } //else ของเช็คนามสกุลไฟล์

                        } // if($upload !='') {

                        $conn = null; //close connect db
                    } //isset
                    ?>
                </div>
            </div>
        </section>

    </main>

    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>


</body>

</html>