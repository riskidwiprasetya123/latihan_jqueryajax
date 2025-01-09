<div class="container">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
    <i class="bi bi-plus-lg"></i> Tambah Gallery
</button>
    <div class="row">
        <div class="table-responsive" id="gallery_data">
            
        </div>

<!-- Awal Modal Tambah-->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Foto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar">
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
<!-- Akhir Modal Tambah-->
    </div>
</div>

<script>
$(document).ready(function(){
    load_data();
    function load_data(hlm){
        $.ajax({
            url : "gallery_data.php",
            method : "POST",
            data : {
					            hlm: hlm
				           },
            success : function(data){
                    $('#gallery_data').html(data);
            }
        })
    } 
    $(document).on('click', '.halaman', function(){
    var hlm = $(this).attr("id");
    load_data(hlm);
});
});
</script>

<?php
include "upload_foto.php";

// Jika tombol simpan diklik
if (isset($_POST['simpan'])) {

    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    // Jika ada file yang dikirim
    if ($nama_gambar != '') {
        // Panggil function upload_foto untuk cek spesifikasi file yang dikirimkan user
        // Function ini memiliki 2 keluaran yaitu status dan message
        $cek_upload = upload_foto($_FILES["gambar"]);

        // Cek status true/false
        if ($cek_upload['status']) {
            // Jika true maka message berisi nama file gambar
            $gambar = $cek_upload['message'];
        } else {
            // Jika gagal, tampilkan pesan error
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }

    // Cek apakah gambar baru diupload
    if ($gambar != '') {
        // Tambahkan gambar baru ke database
        $stmt = $conn->prepare("INSERT INTO gallery (gambar, tanggal, username) 
                                VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $gambar, $tanggal, $username);

        // Eksekusi query
        $simpan = $stmt->execute();

        if ($simpan) {
            echo "<script>
                alert('Data berhasil disimpan');
                document.location='admin.php?page=gallery';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menyimpan data');
                document.location='admin.php?page=gallery';
            </script>";
        }
    } else {
        // Jika tidak ada gambar baru yang diupload, tampilkan error
        echo "<script>
            alert('Tidak ada gambar yang diupload');
            document.location='admin.php?page=gallery';
        </script>";
        die;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}

// Jika tombol edit diklik
if (isset($_POST['update'])) {
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    // Validasi dan upload gambar
    if ($nama_gambar != '') {
        // Panggil fungsi upload_foto untuk memvalidasi file
        $cek_upload = upload_foto($_FILES["gambar"]);

        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    } else {
        echo "<script>
            alert('Tidak ada gambar yang dipilih');
            document.location='admin.php?page=gallery';
        </script>";
        die;
    }

    // Cek apakah gambar ada dalam database (untuk mengupdate gambar)
    $stmt = $conn->prepare("SELECT gambar FROM gallery ORDER BY id DESC LIMIT 1"); // Ambil gambar terbaru
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika ada gambar lama, hapus gambar lama sebelum mengupdate
        $row = $result->fetch_assoc();
        $gambar_lama = $row['gambar'];

        // Hapus gambar lama jika ada gambar baru
        if ($nama_gambar != '' && file_exists("img/" . $gambar_lama)) {
            unlink("img/" . $gambar_lama);
        }

        // Update gambar terbaru
        $stmt = $conn->prepare("UPDATE gallery 
                                SET gambar = ?, 
                                    tanggal = ?, 
                                    username = ? 
                                WHERE gambar = ?");
        $stmt->bind_param("ssss", $gambar, $tanggal, $username, $gambar_lama);
    } else {
        // Jika tidak ada gambar sebelumnya, tambahkan gambar baru
        $stmt = $conn->prepare("INSERT INTO gallery (gambar, tanggal, username) 
                                VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $gambar, $tanggal, $username);
    }

    $update = $stmt->execute();

    if ($update) {
        echo "<script>
            alert('Data berhasil disimpan');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menyimpan data');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

//jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        //hapus file gambar
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id =?");

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