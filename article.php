<link rel="stylesheet" href="css/adminContent.css?v=<?php echo time(); ?>">

<div class="container-fluid mb-3">
    <div class="row">
        <div class="d-flex p-0">
            <form class="d-flex" role="search">
                <input class="form-control me-2" id="getArticle" type="text" placeholder="Search" aria-label="Search">
            </form>
            <button type="button" class="ms-auto btn btn-success mb-2 fw-bold py-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-journal-plus me-1 fs-5"></i> Tambah Article
            </button>
        </div>
        <div class="table-responsive" id="article_data">

        </div>

        <!-- Awal Modal Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Article</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Artikel" required>
                            </div>
                            <div class="mb-3">
                                <label for="floatingTextarea2">Isi</label>
                                <textarea class="form-control" placeholder="Tuliskan Isi Artikel" name="isi" required></textarea>
                            </div>
                            <div 
                                class="mb-3 custom-input"     
                                id="dropZone"
                                ondragover="event.preventDefault()" 
                                ondrop="handleDrop(event)"
                                onclick="document.getElementById('fileInput').click();"
                            >
                                <label for="formGroupExampleInput2" class="form-label py-2">
                                    <div id="container-icon">
                                        <i class="bi bi-images" style="font-size: 3rem; color: cornflowerblue;"></i>
                                    </div>
                                    <div id="container-image" style="display: none;">
                                        <img
                                            id="imagePreview"
                                            alt="Preview"
                                            class="image-preview mb-2"
                                        />
                                    </div>
                                    <p>Drag & drop your image here, or click to select:</p>
                                    <span class="warning-input-file"> JPG, JPEG, PNG up to 5mb</span>
                                </label>
                                <input
                                    type="file"
                                    id="fileInput"
                                    class="form-control"
                                    name="gambar"
                                    style="display: none;"
                                    onchange="previewImage(event)"
                                    accept="image/jpeg, image/png, image/jpg"
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="Save" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Tambah-->

        <div class="modal fade" id="alertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">Informasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="alertModalMessage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const previewImageEdit = (event, id, file = null) => {
        let imageContainer = document.getElementById(`container-image-edit-${id}`)
        const iconContainer = document.getElementById(`container-icon-edit-${id}`)
        const fileInput = document.getElementById(`fileInputEdit${id}`)
        const parentElement = document.getElementById(`dropZoneEdit-${id}`)
        const warningContainer = document.getElementById(`container-warning-${id}`)

        const selectedFile = file || event.target.files[0];

        if (selectedFile && selectedFile.type.startsWith('image/')) {
            if (!imageContainer && warningContainer) {
                warningContainer.remove()
            }

            if (!imageContainer) {
                imageContainer = document.createElement("div");
                imageContainer.id = `container-image-edit-${id}`;
                imageContainer.className = "mb-2"

                const preview = document.createElement("img");
                preview.id = `imagePreviewEdit-${id}`;
                preview.alt = "Preview";
                preview.className = "image-preview";
                imageContainer.appendChild(preview);

                imageContainer.onclick = () => fileInput.click();
                parentElement.appendChild(imageContainer)
            }

            const preview = document.getElementById(`imagePreviewEdit-${id}`);
            const reader = new FileReader()
            reader.onload = function (e) {
                preview.src = e.target.result
                imageContainer.style.display = "block"
                if (iconContainer) iconContainer.style.display = "none"
            }
            reader.readAsDataURL(selectedFile)

            if (file) {
                const dataTransfer = new DataTransfer()
                dataTransfer.items.add(file)
                fileInput.files = dataTransfer.files
            }

            if (imageContainer && !warningContainer) {
                warningContainer = document.createElement("div")
                warningContainer.id = `container-warning-${id}`
                warningContainer.innerHTML = `
                    <p class="mt-2">Drag & drop your image here, or click to select:</p>
                    <span class="warning-input-file">JPG, JPEG, PNG up to 5MB</span>
                `
                parentElement.appendChild(warningContainer)
            }

            // // Debugging
            // console.log("Parent Element:", parentElement)
            // console.log("Icon Container:", iconContainer)
            // console.log("Image Container Exists:", document.getElementById(`container-image-edit-${id}`))
            // console.log("Warning Container Exists:", warningContainer);


        } else {
            alert("Please select a valid image file (JPG, JPEG, PNG).")
        }
    };


    function previewImage(event, file = null) {
        const imageContainer = document.getElementById('container-image')
        const iconContainer = document.getElementById('container-icon')
        const preview = document.getElementById('imagePreview')
        const fileInput = document.getElementById('fileInput')

        const selectedFile = file || event.target.files[0]

        if (selectedFile && selectedFile.type.startsWith('image/')) {
            const reader = new FileReader()
            reader.onload = function (e) {
                preview.src = e.target.result
                imageContainer.style.display = "block"
                iconContainer.style.display = "none"
            }
            reader.readAsDataURL(selectedFile)

            if (file) {
                const dataTransfer = new DataTransfer()
                dataTransfer.items.add(file)
                fileInput.files = dataTransfer.files
            }
        }
    }

    function handleDrop(event) {
        event.preventDefault()
        const file = event.dataTransfer.files[0]
        if (file) {
            previewImage(null, file)
        }
    }

    function handleDropEdit(event, id) {
        event.preventDefault();
        const file = event.dataTransfer.files[0];
        if (file) {
            previewImageEdit(null, id, file);
        }
    }

    $(document).ready(function(){
        load_data();
        function load_data(hlm){
            $.ajax({
                url : "article_data.php",
                method : "POST",
                data : {
                    hlm: hlm
                },
                success : function(data){
                    $('#article_data').html(data)
                }
            })
        }

        function search(getArticle) {
            $.ajax({
                url : "article_data.php",
                method : "POST",
                data : {
                    name: getArticle 
                },
                success : function(response){
                    $('#article_data').html(response)
                }
            })
        }
        
        $(document).on('click', '.halaman', function(){
            var hlm = $(this).attr("id")
            load_data(hlm)
        })

        $('#getArticle').on('keyup', function(){
            let getArticle = $(this).val()
            search(getArticle)
        })
    })
</script>

<?php
include "upload_foto.php";

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];   

    if ($nama_gambar != '') {
        $cek_upload = upload_foto_article($_FILES["gambar"]);

        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=article';
            </script>";
            die;
        }
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            unlink("img/article/" . $_POST['gambar_lama']);
        }

        $stmt = $conn->prepare("UPDATE article SET  judul =?, isi =?, gambar = ?, tanggal = ?, username = ? WHERE id = ?");

        $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $username, $id);
        $simpan = $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO article (judul,isi,gambar,tanggal,username) VALUES (?,?,?,?,?)");

        $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
        $simpan = $stmt->execute();
    }

    if ($simpan) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', () => {
            const message = 'Simpan data berhasil'
            document.getElementById('alertModalMessage').innerText = message
            const myModal = new bootstrap.Modal(document.getElementById('alertModal'))
            myModal.show()

            const modalElement = document.getElementById('alertModal')
            modalElement.addEventListener('hidden.bs.modal', () => {
                window.location.href = 'admin.php?page=article'
            })
        })
        </script>";
    } else {
        echo "<script>
        document.addEventListener('DOMContentLoaded', () => {
            const message = 'Simpan data gagal'
            document.getElementById('alertModalMessage').innerText = message
            const myModal = new bootstrap.Modal(document.getElementById('alertModal'))
            myModal.show()

            const modalElement = document.getElementById('alertModal')
            modalElement.addEventListener('hidden.bs.modal', () => {
                window.location.href = 'admin.php?page=article'
            })
        })
        </script>";
    }

    $stmt->close();
    $conn->close();
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        unlink("img/article/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM article WHERE id =?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            document.location='admin.php?page=article';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>