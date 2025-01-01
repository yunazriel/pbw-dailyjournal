<table class="table table-hover table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th class="w-50">detail</th>
            <th class="w-50">Gambar</th>
            <th class="w-25">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "connect.php";
        $hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
        $limit = 3;
        $limit_start = ($hlm - 1) * $limit;
        $no = $limit_start + 1;

        $sql = "SELECT * FROM gallery ORDER BY created_at DESC LIMIT $limit_start, $limit";
        $hasil = $conn->query($sql);
        while ($row = $hasil->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <strong class="fs-5" ><?= htmlspecialchars($row["judul"]) ?></strong>
                    <br><small class="text-muted">dibuat oleh : <?= htmlspecialchars($row["created_by"]) ?></small>
                    <br><small class="text-muted">pada : <?= htmlspecialchars($row["created_at"]) ?></small>
                </td>
                <td>
                    <?php if ($row["gambar"] && file_exists('img/gallery/' . $row["gambar"])) { ?>
                        <img class="img_article" src="img/gallery/<?= htmlspecialchars($row["gambar"]) ?>" width="100">
                    <?php } else { ?>
                        <span class="text-muted">gambar tidak tersedia</span>
                    <?php } ?>
                </td>
                <td>
                    <div class="action-buttons d-flex">
                        <button class="btn btn-edit btn-sm d-flex gap-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <button class="btn btn-delete btn-sm d-flex gap-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                    <!-- Awal Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Gallery</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body ">
                                        <div class="mb-3 text-start">
                                            <label for="formGroupExampleInput" class="form-label">Judul</label>
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Artikel" value="<?= $row["judul"] ?>" required>
                                        </div>
                                        <div 
                                            class="mb-3 custom-input" 
                                            id="dropZoneEdit-<?= $row['id'] ?>" 
                                            ondragover="event.preventDefault()" 
                                            ondrop="handleDropEdit(event, '<?= $row['id'] ?>')" 
                                        >
                                            <label for="fileInputEdit<?= $row['id'] ?>" class="form-label">
                                                <?php if (!empty($row["gambar"]) && file_exists('img/gallery/' . $row["gambar"])): ?>
                                                    <div id="container-image-edit-<?= $row['id'] ?>">
                                                        <img
                                                            src="img/gallery/<?= htmlspecialchars($row["gambar"], ENT_QUOTES, 'UTF-8') ?>" 
                                                            id="imagePreviewEdit-<?= $row['id'] ?>"
                                                            alt="Preview"
                                                            class="image-preview mb-2"
                                                        />
                                                    </div>
                                                <?php else: ?>
                                                    <div id="container-icon-edit-<?= $row['id'] ?>">
                                                        <i class="bi bi-images" style="font-size: 3rem; color: cornflowerblue;" aria-hidden="true"></i>
                                                    </div>  
                                                <?php endif; ?>
                                                <div id="container-warning-<?= $row['id'] ?>">
                                                    <p class="mt-2">Drag & drop your image here, or click to select:</p>
                                                    <span class="warning-input-file">JPG, JPEG, PNG up to 5MB</span>
                                                </div>
                                            </label>
                                            <input 
                                                type="file" 
                                                id="fileInputEdit<?= $row['id'] ?>" 
                                                class="form-control d-none" 
                                                name="gambar" 
                                                accept="image/jpeg, image/png, image/jpg"
                                                onchange="previewImageEdit(event, <?= $row['id'] ?>)"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Edit -->
                    <!-- Awal Modal Hapus -->
                    <div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Article</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="formGroupExampleInput" class="form-label">Yakin akan menghapus gallery "<strong><?= $row["judul"] ?></strong>"?</label>
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                                        <input type="submit" value="hapus" name="hapus" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Hapus -->
                </td>
            </tr>
        <?php } ?> 
    </tbody>
</table>

<?php 
    $query_gallery = "SELECT * FROM gallery";
    $hasil1 = $conn->query($query_gallery); 
    $total_records = $hasil1->num_rows;
?>
<div class="d-flex justify-content-between align-items-center mt-2 ">
    <p class="bg-info p-2 text-light rounded text-capitalize fw-bold" style="cursor: default;">
        <i class="bi bi-newspaper"></i> Total gallery : <?php echo $total_records; ?>
    </p>
    <nav class="">
        <ul class="pagination p-2">
        <?php
            $jumlah_page = ceil($total_records / $limit);
            $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
            $start_number = ($hlm > $jumlah_number)? $hlm - $jumlah_number : 1;
            $end_number = ($hlm < ($jumlah_page - $jumlah_number))? $hlm + $jumlah_number : $jumlah_page;

            if($hlm == 1){
                echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
            } else {
                $link_prev = ($hlm > 1)? $hlm - 1 : 1;
                echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
            }

            for($i = $start_number; $i <= $end_number; $i++){
                $link_active = ($hlm == $i)? ' active' : '';
                echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
            }

            if($hlm == $jumlah_page){
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
            } else {
            $link_next = ($hlm < $jumlah_page)? $hlm + 1 : $jumlah_page;
                echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link" href="#">Last</a></li>';
            }
        ?>
        </ul>
    </nav>

</div>