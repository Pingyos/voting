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
                        <h2>ระบบโหวด</h2>
                    </div>
                    <!-- Projects Start -->
                    <div class="container">
                        <div class="row">
                            <?php
                            require_once 'connection.php';
                            $stmt = $conn->prepare("SELECT * FROM poster");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $t1) {
                            ?>
                                <div class="col-lg-4 col-md-6 col-6">
                                    <a href="#?poster_id=<?= $t1['poster_id']; ?>" onclick="$('#my_popup').modal('show'); $('#poster_id').val (<?= $t1['poster_id']; ?>);">
                                        <img src="upload/<?= $t1['img_file']; ?>" class="about-image ms-lg-auto bg-light shadow-lg img-fluid mx-auto" alt="">
                                    </a>
                                    <div class="custom-block-body text-center">
                                        <h4 class="text mt-lg-3 mb-lg-3"><?= $t1['poster_name']; ?></h4>
                                        <p class="text">Lorem Ipsum dolor sit amet, consectetur adipsicing kengan omeg kohm tokito Professional charity theme based</p>
                                    </div>
                                </div>


                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <form method="POST" role="form">
                        <div class="modal fade" id="my_popup" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="email">Email <span style="color:red;">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control" required>
                                            <input type="text" name="poster_id" id="poster_id" hidden>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="form-control">Submit</button>
                                        <?php require_once('save_db.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <?php echo '<pre>';
                    print_r($_POST);
                    echo '</pre>';
                    ?>  -->
        </section>

    </main>

    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>


</body>

</html>