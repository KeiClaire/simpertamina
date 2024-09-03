<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .status-badge {
            display: inline-block;
            padding: 0.5em 1em;
            border-radius: 0.25em;
            font-size: 0.875em;
            color: #fff;
        }
        .status-text {
            font-size: 1em;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }
        .status-diterima {
            color: #198754;
        }
        .status-ditolak {
            color: red;
        }
        .status-placeholder {
            color: #6c757d;
        }
        .text-center {
            text-align: center;
        }
        .table thead th {
            background-color: red;
            color: white;
            vertical-align: middle;
        }
        .btn-logout {
            margin-bottom: 8px;
        }
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
        .search-container .form-control {
            flex: 1;
            max-width: 250px;
        }
        .search-container .btn-group {
            display: flex;
            align-items: center;
        }
        .search-container .btn-group .btn {
            margin-left: 10px;
        }
        .checkbox-delete {
            display: none;
        }
        .show-checkboxes .checkbox-delete {
            display: inline-block;
        }
        .hide-header-checkbox .checkbox-delete {
            visibility: hidden;
            /* Untuk mengubah warna menjadi putih */
            color: white;
        }
        .delete-buttons {
            display: none;
        }
        .show-checkboxes .delete-buttons {
            display: inline-block;
        }
        .btn-logout {
            color: white;
            background-color: red;
            border: 1px solid red;
            padding: 0.5em 1.5em;
            font-size: 1em;
            border-radius: 0.375em;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        .btn-cetak-laporan {
            color: black;
            background-color: white;
            border: 1px solid black;
            padding: 0.5em 1em;
            font-size: 0.875em;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-radius: 0.25em;
        }
        .btn-cetak-laporan:hover {
            background-color: blue;
            color: white;
            border: 1px solid blue;
        }
        .btn-logout:hover {
            background-color: darkred;
            border-color: darkred;
            color: white;
        }
        .hapus {
            text-align: right;
            margin-top: 10px;
        }
        .btn-hapus {
            background-color: transparent;
            border: none;
            padding-right: 0;
            font-size: 1.5rem
        }
        .table {
            text-align: center;
            vertical-align: middle;
        }
        @media (max-width: 576px) {
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }
            .search-container .form-control,
            .search-container .btn {
                width: 100%;
                margin-bottom: 10px;
            }
            .search-container .btn-group .btn {
                margin-left: 0;
            }
            .hapus {
                text-align: center;
            }
        }
    </style>
</head>
<body>
<div class="container mt-5 px-4">
    <h3>Aplikasi SIM Pertamina</h3>
    <div class="alert alert-primary">
        Anda Login Sebagai <b>Reviewer</b> Aplikasi Simper.
    </div>
    <a href="logout.php" class="btn btn-logout"> Logout </a>
    <div class="card mt-2">
        <div class="card-body">
            <h5>Halaman Data Driver</h5>
            <div class="search-container">
                <input type="text" id="search" class="form-control" placeholder="Cari data...">
                <div class="btn-group">
                    <a href="cetak-laporan.php" class="btn btn-cetak-laporan"> Cetak Laporan </a>
                </div>
            </div>
            <hr>
            <div class="hapus">
                <button id="deleteBtn" class="btn-hapus btn-danger"><i class="bi bi-trash"></i></button>
                <button id="confirmDeleteBtn" class="btn btn-danger ms-2 delete-buttons">Hapus Data</button>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered w-100">
                    <thead>
                        <tr class="fw-bold text-center">
                            <th class="checkbox-delete"></th>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pt</th>
                            <th>Umur</th>
                            <th>Awak</th>
                            <th>Keperluan</th>
                            <th>Masa KTP</th>
                            <th>Masa Narkoba</th>
                            <th>Masa Kesehatan</th>
                            <th>Persyaratan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                        <?php
                        // Connect to the database using PDO
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "db_simper";

                        try {
                            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // Fetch data using PDO
                            $sql = "SELECT * FROM data_driver ORDER BY id DESC";
                            $stmt = $pdo->query($sql);
                            $no = 1;

                            foreach ($stmt as $data) { ?>
                                <tr>
                                    <td class="checkbox-delete text-center"><input type="checkbox" class="form-check-input delete-checkbox" value="<?= $data['id'] ?>"></td>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($data['nama']) ?></td>
                                    <td><?= htmlspecialchars($data['pt']) ?></td>
                                    <td><?= htmlspecialchars($data['umur']) ?></td>
                                    <td><?= htmlspecialchars($data['awak']) ?></td>
                                    <td><?= htmlspecialchars($data['keperluan']) ?></td>
                                    <td><?= htmlspecialchars($data['masa_ktp']) ?></td>
                                    <td><?= htmlspecialchars($data['masa_narkoba']) ?></td>
                                    <td><?= htmlspecialchars($data['masa_kesehatan']) ?></td>
                                    <td class="text-center"><a href="data-persyaratan.php?id=<?= $data['id'] ?>" class="btn btn-primary btn-sm">View</a></td>
                                    <td class="text-center" id="status-<?= $data['id'] ?>">
                                        <?php if (isset($data['status']) && $data['status'] !== ''): ?>
                                            <span class="status-badge status-<?= strtolower($data['status']) ?>">
                                                <?= htmlspecialchars($data['status']) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="status-placeholder">Status Belum Dipilih</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php }

                        } catch (PDOException $e) {
                            die("Koneksi ke database gagal: " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Tampilkan checkbox dan tombol hapus saat ikon trash diklik
$('#deleteBtn').on('click', function() {
    $('body').toggleClass('show-checkboxes');
    $('thead tr').toggleClass('hide-header-checkbox');
    if ($('body').hasClass('show-checkboxes')) {
        $('#deleteBtn i').removeClass('bi-trash').addClass('bi-x-circle');
    } else {
        $('#deleteBtn i').removeClass('bi-x-circle').addClass('bi-trash');
    }
});

// Tampilkan modal konfirmasi saat tombol hapus diklik
$('#confirmDeleteBtn').on('click', function() {
    var ids = [];
    $('.delete-checkbox:checked').each(function() {
        ids.push($(this).val());
    });

    if (ids.length > 0) {
        $('#deleteConfirmModal').modal('show'); // Tampilkan modal
        $('#confirmDelete').off('click').on('click', function() {
            $.ajax({
                url: 'delete-data.php',
                type: 'POST',
                data: { ids: ids },
                success: function(response) {
                    location.reload();
                },
                error: function() {
                    alert('Terjadi kesalahan saat menghapus data.');
                }
            });
            $('#deleteConfirmModal').modal('hide'); // Sembunyikan modal setelah konfirmasi
        });
    } else {
        alert('Silakan pilih data yang ingin dihapus.');
    }
});

 // Search function
 $('#search').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#dataTable tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
</script>
</body>
<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmLabel">Konfirmasi Penghapusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus data yang dipilih?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" id="confirmDelete" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>

</html>
