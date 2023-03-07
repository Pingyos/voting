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
                    <div class="container py-2">
                        <div class="container">
                            <div class="row portfolio-container">
                                <?php
                                require_once 'connection.php';
                                $stmt = $conn->prepare("SELECT* FROM poster");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach ($result as $t1) {
                                ?>
                                    <div class="col-lg-6 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="col-lg-12 col-md-12 col-12 mb-4 ">
                                            <div class="custom-block-wrap">
                                                <img src="images/1.jpg" custom-block-image img-fluid" while="300" height="500">
                                                <div class="custom-block">
                                                    <div class="custom-block-body">
                                                        <h5 class="mb-3"><?= $t1['poster_name']; ?></h5>
                                                        <p><?= $t1['poster_details']; ?></p>
                                                    </div>
                                                    <a type="button" class="custom-btn btn" onclick="$('#my_popup').modal('show')">Voting</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <form method="POST" role="form">
                                    <div class="modal fade" id="my_popup" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal_title">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="email">Email <span style="color:red;">*</span></label>
                                                        <input type="email" name="email" id="email" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                    <?php echo '<pre>';
                                                    print_r($_POST);
                                                    echo '</pre>';
                                                    ?>
                                                    <?php require_once('save_db.php'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </main>

    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>


</body>

</html>