<?php
$sql_article = "SELECT * FROM article";
$sql_user = "SELECT * FROM user";
$sql_gallery = "SELECT * FROM gallery";

$result_article = $conn->query($sql_article);
$result_user = $conn->query($sql_user);
$result_gallery = $conn->query($sql_gallery);

$lenght_article = $result_article->num_rows;
$lenght_user = $result_user->num_rows;
$lenght_gallery = $result_gallery->num_rows;

?>
<style>
    .card-custom {
        max-width: 18rem;
        border-radius: 15px;
        transition: transform 0.2s ease-out, box-shadow 0.3s ease-out;
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    .container-fluid {
        min-height: 65vh;
    }
</style>

<div class="container-fluid mb-2">
    <div class="row row-cols-2 row-cols-md-5 justify-content-center pt-4">
        <div class="col">
            <div class="card mb-3 shadow-lg border-0 card-custom" style="background: linear-gradient(135deg, #00b09b, #96c93d);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0 fw-bold"><i class="bi bi-person-vcard-fill me-2"></i>user</h5>
                            <p class="small mt-2">Total user available</p>
                        </div>
                        <div>
                            <span class="badge rounded-pill bg-white text-success fs-2 shadow-sm"><?php echo $lenght_user; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col">
            <div class="card mb-3 shadow-lg border-0 card-custom" style="background: linear-gradient(135deg, #ff5f6d, #ffc371);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0 fw-bold"><i class="bi bi-newspaper me-2"></i>Article</h5>
                            <p class="small mt-2">Total articles available</p>
                        </div>
                        <div>
                            <span class="badge rounded-pill bg-white text-danger fs-2 shadow-sm"><?php echo $lenght_article; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col">
            <div class="card mb-3 shadow-lg border-0 card-custom" style="background: linear-gradient(135deg, #36d1dc, #5b86e5);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0 fw-bold"><i class="bi bi-camera me-2"></i>Gallery</h5>
                            <p class="small mt-2">Total gallery available</p>
                        </div>
                        <div>
                            <span class="badge rounded-pill bg-white text-primary fs-2 shadow-sm"><?php echo $lenght_gallery; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
