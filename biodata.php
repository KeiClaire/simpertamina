<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <script src="js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/modals/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="modals.css" rel="stylesheet">
    <style>
      .modal-dialog {
        max-width: 600px;
        margin: 0 auto;
      }
      .modal-content {
        max-height: calc(100vh - 3.5rem);
        overflow-y: auto;
      }
      .modal-body {
        overflow-y: visible;
      }
      .modal-centered {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
      }
      .preview-img {
        max-width: 100%;
        max-height: 200px;
        margin-top: 10px;
      }
      @media (max-width: 576px) {
            .modal-dialog {
                max-width: 100%; /* Full width on very small screens */
                margin: 0;
            }
            .modal-header, .modal-body {
                padding: 1rem;
            }
            .form-floating {
              display: flex;
              flex-direction: column;
              align-items: center;
              text-align: center; /* Center align text inside the input */
            }
            .form-floating label {
            margin-bottom: 0.5rem; /* Add space between label and input */
            font-size: 0.75rem; /* Ensure the label is appropriately sized for mobile */
            } 
            .form-floating .form-select {
            text-align: center; /* Center align text inside the select */
            }
            .form-select {
            width: 100%; /* Make select full width */
            max-width: 400px; /* Limit maximum width for larger screens */
            }
        }
    </style>
  </head>
  <body>
    <div class="modal-centered">
      <div id="biodata_form" class="modal-dialog modal-dialog-centered mx-auto position-static d-block" tabindex="-1" role="dialog">
        <div class="modal-content rounded-4 shadow">
          <div class="modal-header p-4 pb-3 border-bottom-0">
            <h1 class="fw-bold mb-0 fs-4">Biodata</h1>
          </div>
          <div class="modal-body p-4 pt-0">
            <form action="submit-biodata.php" method="POST" id="biodata_form" enctype="multipart/form-data">
              <div class="row g-3">
                <div class="col-12">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-3" id="nama" name="nama" placeholder="Nama" required>
                    <label for="nama">Nama</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-3" id="pt" name="pt" placeholder="Nama PT" required>
                    <label for="namaPT">Nama PT</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating">
                    <input type="number" class="form-control rounded-3" id="umur" name="umur" placeholder="Umur" required>
                    <label for="umur">Umur</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating">
                    <select class="form-select rounded-3" id="awak" name="awak" aria-label="Select example" required>
                      <option selected>Pilih Awak</option>
                      <option value="Awak 1">Awak 1 (Maximal 50 Tahun)</option>
                      <option value="Awak 2">Awak 2 (Maximal 55 Tahun)</option>
                    </select>
                    <label for="awak">Awak</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating">
                    <select class="form-select rounded-3" id="keperluan" name="keperluan" aria-label="Select example" required>
                      <option selected>Pilih Keperluan</option>
                      <option value="Baru">Baru</option>
                      <option value="Perpanjang">Perpanjang</option>
                    </select>
                    <label for="keperluan">Keperluan</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating">
                    <input type="date" class="form-control rounded-3" id="masa_ktp" name="masa_ktp" placeholder="Masa Berlaku KTP" required>
                    <label for="masa_ktp">Masa Berlaku KTP</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating">
                    <input type="date" class="form-control rounded-3" id="masa_narkoba" name="masa_narkoba" placeholder="Masa Berlaku Bebas Narkoba" required>
                    <label for="masa_narkoba">Masa Berlaku Bebas Narkoba</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating">
                    <input type="date" class="form-control rounded-3" id="masa_kesehatan" name="masa_kesehatan" placeholder="Masa Berlaku Kesehatan" required>
                    <label for="masa_kesehatan">Masa Berlaku Kesehatan</label>
                  </div>
                </div>
              </div>
              <button class="w-100 mt-3 btn btn-lg rounded-3 btn-primary" type="submit">Next</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="b-example-divider"></div>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
  <script>
  document.getElementById('biodata_form').addEventListener('submit', function(event) {
      const umur = parseInt(document.getElementById('umur').value);
      const awak = document.getElementById('awak').value;

      if (awak === 'Awak 1' && umur > 50) {
          alert('Umur untuk Awak 1 tidak boleh lebih dari 50 tahun.');
          event.preventDefault(); // Mencegah form dikirim jika umur melebihi batas untuk Awak 1
      } else if (awak === 'Awak 2' && umur > 55) {
          alert('Umur untuk Awak 2 tidak boleh lebih dari 55 tahun.');
          event.preventDefault(); // Mencegah form dikirim jika umur melebihi batas untuk Awak 2
      }
  });
</script>
</html>


