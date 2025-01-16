<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Gambar
    </button>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th class="w-25">Tanggal</th>
                        <th class="w-25">Gambar</th>
                        <th class="w-25">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mendapatkan data gambar dari tabel gallery
                    $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
                    $hasil = $conn->query($sql);

                    $no = 1;
                    while ($row = $hasil->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <br>pada : <?= $row["tanggal"] ?>
                            <br>oleh : admin
                        </td>

                        <td>
                            <?php
                                if ($row["gambar"] != '') {
                                    $image_path = 'img/' . $row["gambar"];
                                    if (file_exists($image_path)) {
                                        echo '<img src="' . $image_path . '" width="100">';
                                    } else {
                                        echo 'Gambar tidak ditemukan';
                                    }
                                }
                                ?>
                        </td>
                        <td>
                            <!-- Tombol aksi Edit dan Hapus -->
                            <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal"
                                data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                            <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal"
                                data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Gambar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="post" action="" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                <div class="mb-3">
                                                    <label for="gambar" class="form-label">Ganti Gambar</label>
                                                    <input type="file" class="form-control" name="gambar">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gambar_lama" class="form-label">Gambar Lama</label>
                                                    <?php
                                                        if ($row["gambar"] != '') {
                                                            echo '<br><img src="img/' . $row["gambar"] . '" width="100">';
                                                        }
                                                        ?>
                                                    <input type="hidden" name="gambar_lama"
                                                        value="<?= $row["gambar"] ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <input type="submit" value="Simpan" name="simpan"
                                                    class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus
                                                Gambar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="post" action="" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <label for="formGroupExampleInput" class="form-label">Yakin akan
                                                    menghapus gambar?</label>
                                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <input type="submit" value="Hapus" name="hapus" class="btn btn-danger">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah Gambar -->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gambar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Pilih Gambar</label>
                                <input type="file" class="form-control" name="gambar" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include "upload_foto.php"; 

if (isset($_POST['simpan'])) {
    $gambar = '';
    $tanggal = date("Y-m-d H:i:s"); 
    $nama_gambar = $_FILES['gambar']['name']; 

    // jika ada file yang dikirimkan
    if ($nama_gambar != '') {
        // panggil fungsi upload_foto untuk cek spesifikasi file yang dikirimkan user
        $cek_upload = upload_foto($_FILES["gambar"]);

        // cek status true/false
        if ($cek_upload['status']) {
            // jika true, maka message berisi nama file gambar
            $gambar = $cek_upload['message'];
        } else {
            // jika error, tampilkan pesan error
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }

    // Cek apakah ada id yang dikirimkan untuk update gambar
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($nama_gambar == '') {
            // jika tidak ganti gambar, gunakan gambar lama
            $gambar = $_POST['gambar_lama'];
        } else {
            // jika ganti gambar, hapus gambar lama
            unlink("img/" . $_POST['gambar_lama']);
        }

        // Update query
        $stmt = $conn->prepare("UPDATE gallery SET gambar = ?, tanggal = ? WHERE id = ?");
        $stmt->bind_param("ssi", $gambar, $tanggal, $id);
        $simpan = $stmt->execute();
    } else {
        // Insert gambar baru ke tabel gallery
        $stmt = $conn->prepare("INSERT INTO gallery (gambar, tanggal) VALUES (?, ?)");
        $stmt->bind_param("ss", $gambar, $tanggal);
        $simpan = $stmt->execute();
    }

    // Menampilkan hasil operasi (sukses atau gagal)
    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

// Jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        // Hapus gambar dari folder assets
        unlink("img/" . $gambar);
    }

    // Hapus data dari tabel gallery
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>