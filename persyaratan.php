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
      .preview-pdf {
        margin-top: 10px;
      }
    
      @media (max-width: 768px) {
        .modal-dialog {
          max-width: 100%;
          margin: 20px;
        }
        .modal-header h1 {
          font-size: 1.5rem;
        }
        .form-floating label {
          font-size: 0.875rem;
        }
        .form-control {
          font-size: 0.875rem;
        }
        .preview-img {
          max-height: 150px;
        }
        .btn {
          font-size: 0.875rem;
        }
      }
      
      @media (max-width: 576px) {
        .modal-dialog {
          margin: 10px;
        }
        .preview-img {
          max-height: 100px;
        }
        .btn {
          font-size: 0.75rem;
        }
        
      }
    </style>
  </head>
  <body>
    <div class="modal-centered">
      <div id="form2" class="modal-dialog modal-dialog-centered mx-auto position-static d-block" tabindex="-1" role="dialog">
        <div class="modal-content rounded-4 shadow">
          <div class="modal-header p-4 pb-3 border-bottom-0">
            <h1 class="fw-bold mb-0 fs-4">Persyaratan</h1>
          </div>
          <div class="modal-body p-4 pt-0">
            <form id="persyaratan_form" method="POST" action="submit-persyaratan.php" enctype="multipart/form-data">
              <div class="row g-3">
                <div class="col-12">
                  <div class="form-floating">
                    <input type="file" class="form-control rounded-3" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required onchange="previewFile('ktp', 'ktpPreview', 'ktpPdfLink')">
                    <label for="ktp">KTP</label>
                    <img id="ktpPreview" class="preview-img d-none" alt="KTP Preview">
                    <a id="ktpPdfLink" class="preview-pdf d-none" target="_blank">View PDF</a>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input type="file" class="form-control rounded-3" id="foto" name="foto" accept=".jpg,.jpeg,.png,.pdf" required onchange="previewFile('foto', 'pasFotoPreview', 'fotoPdfLink')">
                    <label for="foto">Pas Foto</label>
                    <img id="pasFotoPreview" class="preview-img d-none" alt="Pas Foto Preview">
                    <a id="fotoPdfLink" class="preview-pdf d-none" target="_blank">View PDF</a>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input type="file" class="form-control rounded-3" id="surat_permohonan_pt" name="surat_permohonan_pt" accept=".jpg,.jpeg,.png,.pdf" required onchange="previewFile('surat_permohonan_pt', 'suratPermohonanPreview', 'suratPermohonanPdfLink')">
                    <label for="surat_permohonan_pt">Surat Permohonan PT</label>
                    <img id="suratPermohonanPreview" class="preview-img d-none" alt="Surat Permohonan PT Preview">
                    <a id="suratPermohonanPdfLink" class="preview-pdf d-none" target="_blank">View PDF</a>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input type="file" class="form-control rounded-3" id="skck" name="skck" accept=".jpg,.jpeg,.png,.pdf" required onchange="previewFile('skck', 'skckPreview', 'skckPdfLink')">
                    <label for="skck">SKCK</label>
                    <img id="skckPreview" class="preview-img d-none" alt="SKCK Preview">
                    <a id="skckPdfLink" class="preview-pdf d-none" target="_blank">View PDF</a>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input type="file" class="form-control rounded-3" id="sim" name="sim" accept=".jpg,.jpeg,.png,.pdf" required onchange="previewFile('sim', 'simPreview', 'simPdfLink')">
                    <label for="sim">SIM B2</label>
                    <img id="simPreview" class="preview-img d-none" alt="SIM B2 Preview">
                    <a id="simPdfLink" class="preview-pdf d-none" target="_blank">View PDF</a>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input type="file" class="form-control rounded-3" id="surat_kesehatan" name="surat_kesehatan" accept=".jpg,.jpeg,.png,.pdf" required onchange="previewFile('surat_kesehatan', 'suratKesehatanPreview', 'suratKesehatanPdfLink')">
                    <label for="surat_kesehatan">Surat Kesehatan</label>
                    <img id="suratKesehatanPreview" class="preview-img d-none" alt="Surat Kesehatan Preview">
                    <a id="suratKesehatanPdfLink" class="preview-pdf d-none" target="_blank">View PDF</a>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input type="file" class="form-control rounded-3" id="mcu" name="mcu" accept=".jpg,.jpeg,.png,.pdf" required onchange="previewFile('mcu', 'mcuPreview', 'mcuPdfLink')">
                    <label for="mcu">MCU</label>
                    <img id="mcuPreview" class="preview-img d-none" alt="MCU Preview">
                    <a id="mcuPdfLink" class="preview-pdf d-none" target="_blank">View PDF</a>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input type="file" class="form-control rounded-3" id="bebas_narkoba" name="bebas_narkoba" accept=".jpg,.jpeg,.png,.pdf" required onchange="previewFile('bebas_narkoba', 'bebasNarkobaPreview', 'bebasNarkobaPdfLink')">
                    <label for="bebas_narkoba">Bebas Narkoba</label>
                    <img id="bebasNarkobaPreview" class="preview-img d-none" alt="Bebas Narkoba Preview">
                    <a id="bebasNarkobaPdfLink" class="preview-pdf d-none" target="_blank">View PDF</a>
                  </div>
                </div>
                <div class="col-12">
                  <button class="w-100 mt-3 btn btn-lg rounded-3 btn-primary" type="submit">Submit All</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="b-example-divider"></div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
      function previewFile(inputId, imgPreviewId, pdfPreviewId) {
        const fileInput = document.getElementById(inputId);
        const imgPreview = document.getElementById(imgPreviewId);
        const pdfPreview = document.getElementById(pdfPreviewId);
        
        const file = fileInput.files[0];
        if (file) {
          const reader = new FileReader();
          
          reader.onload = function (e) {
            if (file.type.startsWith('image/')) {
              imgPreview.src = e.target.result;
              imgPreview.classList.remove('d-none');
              pdfPreview.classList.add('d-none');
            } else if (file.type === 'application/pdf') {
              imgPreview.src = '';
              imgPreview.classList.add('d-none');
              pdfPreview.href = e.target.result;
              pdfPreview.classList.remove('d-none');
            } else {
              imgPreview.src = '';
              imgPreview.classList.add('d-none');
              pdfPreview.classList.add('d-none');
              alert('Please upload an image or PDF file.');
            }
          }
          
          reader.readAsDataURL(file);
        } else {
          imgPreview.src = '';
          imgPreview.classList.add('d-none');
          pdfPreview.classList.add('d-none');
        }
      }
    </script>
  </body>
</html>
