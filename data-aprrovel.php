<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
       
        .status-text {
            font-size: 1em; /* Besarkan font-size sesuai dengan data-aprrovel.php */
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }
        .status-diterima {
            color: #198754; /* Bootstrap Success color */
        }

        .status-ditolak {
            color: red; /* Bootstrap Danger color */
        }

        .status-placeholder {
            color: #6c757d; /* Gray color for placeholder text */
        }
        .text-center {
            text-align: center; /* Center text within the cell */
        }
        .table{
            text-align: center;
        }
        /* Style for the table header */
        .table thead th {
            background-color: red; /* Light gray background for header */
            color: white; /* Black text */
            font-size: 0.875em;
            font-weight: bold;
            vertical-align: middle;
        }
        /* Style for table rows */
        .table tbody tr {
            border-bottom: 1px solid #dee2e6; /* Light gray border for rows */
        }
        .table tbody td {
            font-size: 0.875em;
            vertical-align: middle; /* Center align text vertically */
        }
        /* Style for buttons */
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 0.5em;
        }
        .search-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }
        .search-container .form-control {
            width: 250px;
            font-size: 0.875em;
        }
        .btn-logout {
            color: white;
            background-color: red;
            border: 1px solid red;
            padding: 0.5em 1.5em;
            font-size: 1em;
            border-radius: 0.375em;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
            margin-bottom: 8px;
        }
        .btn-logout:hover {
            background-color: darkred;
            border-color: darkred;
            color: white;
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
            .search-container .btn {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<div class="container mt-5 px-4">
    <h3>Aplikasi SIM Pertamina</h3>
    <div class="alert alert-primary">
        Anda Login Sebagai <b>Approvel</b> Aplikasi Simper.
    </div>
    <a href="logout.php" class="btn btn-logout btn-primary ">Logout</a>
    <div class="card mt-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Halaman Data Driver</h5>
                <div class="search-container">
                    <input type="text" id="search" class="form-control" placeholder="Cari data...">
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered w-100">
                    <thead>
                        <tr class="text-center">
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
                            <th>Pengajuan</th>
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
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($data['nama']) ?></td>
                                    <td><?= htmlspecialchars($data['pt']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($data['umur']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($data['awak']) ?></td>
                                    <td><?= htmlspecialchars($data['keperluan']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($data['masa_ktp']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($data['masa_narkoba']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($data['masa_kesehatan']) ?></td>
                                    <td class="text-center">
                                        <a href="data-persyaratan.php?id=<?= $data['id'] ?>" class="btn btn-primary btn-sm">View</a>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-container">
                                            <button class="btn btn-success btn-sm" onclick="showConfirmModal(<?= $data['id'] ?>, 'Diterima')">Terima</button>
                                            <button class="btn btn-danger btn-sm" onclick="showConfirmModal(<?= $data['id'] ?>, 'Ditolak')">Tolak</button>
                                        </div>
                                    </td>
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

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin <span id="confirmAction"></span> pengajuan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let currentId;
    let currentAction;

    function showConfirmModal(id, action) {
        currentId = id;
        currentAction = action;
        $('#confirmAction').text(action === 'Diterima' ? 'menerima' : 'menolak');
        $('#confirmModal').modal('show');
    }

    $('#confirmButton').on('click', function() {
        $.ajax({
            url: 'update-status.php',
            type: 'POST',
            data: {
                id: currentId,
                status: currentAction
            },
            success: function(response) {
                // Update the status text on success
                $('#status-' + currentId).html('<span class="status-badge status-' + currentAction.toLowerCase() + '">' + currentAction + '</span>');
                $('#confirmModal').modal('hide');
            },
            error: function() {
                alert('Terjadi kesalahan. Coba lagi nanti.');
            }
        });
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
</html>
