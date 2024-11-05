<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .table thead th {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #e9ecef;
        }
        .table tbody tr:hover {
            background-color: #d6d6d6;
        }
        .no-logs {
            text-align: center;
            color: #6c757d;
            font-style: italic;
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
        }
        /* Make link color inherit from the table cell */
        .table td a {
            color: inherit;  /* Inherit color from the parent td */
            text-decoration: none;  /* Remove underline */
        }
        .table td a:hover {
            text-decoration: underline;  /* Add underline on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="userSelect">Sorting Melalui:</label>
                    <select class="form-control" id="userSelect">
                        <option value="all">Semua</option>
                        
                        <!-- Grouping options for Kelas -->
                        <optgroup label="Kelas">
                            <?php 
                                // Array to track distinct Kelas values
                                $distinctKelas = [];
                                foreach ($s as $key): 
                                    if (!in_array($key->Kelas, $distinctKelas)): 
                                        $distinctKelas[] = $key->Kelas; // Add Kelas to distinct list
                            ?>
                                        <option value="<?= esc($key->Kelas) ?>"><?= esc($key->Kelas) ?></option>
                            <?php 
                                    endif; 
                                endforeach; 
                            ?>
                        </optgroup>
                        
                        <!-- Grouping options for Blok -->
                        <optgroup label="Blok">
                            <?php 
                                // Array to track distinct Blok values
                                $distinctBlok = [];
                                foreach ($s as $key): 
                                    if (!in_array($key->blok, $distinctBlok)): 
                                        $distinctBlok[] = $key->blok; // Add Blok to distinct list
                            ?>
                                        <option value="<?= esc($key->blok) ?>"><?= esc($key->blok) ?></option>
                            <?php 
                                    endif; 
                                endforeach; 
                            ?>
                        </optgroup>

                        <!-- Grouping options for Pelajaran -->
                        <optgroup label="Pelajaran">
                            <?php 
                                // Array to track distinct Pelajaran values
                                $distinctPelajaran = [];
                                foreach ($s as $key): 
                                    if (!in_array($key->pelajaran, $distinctPelajaran)): 
                                        $distinctPelajaran[] = $key->pelajaran; // Add Pelajaran to distinct list
                            ?>
                                        <option value="<?= esc($key->pelajaran) ?>"><?= esc($key->pelajaran) ?></option>
                            <?php 
                                    endif; 
                                endforeach; 
                            ?>
                        </optgroup>
                    </select>
                </div>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr style="font-weight: bold; color: black; font-size: larger;">
                            <td align="center" scope="col">No</td>
                            <td align="center" scope="col">Pelajaran</td>
                            <td align="center" scope="col">Guru</td>
                        </tr>
                    </thead>
                    <tbody id="logTableBody">
                        <?php
                        $no = 1;
                        foreach ($s as $key) {
                        ?>
                            <tr data-kelas="<?= esc($key->Kelas) ?>" data-blok="<?= esc($key->blok) ?>" data-pelajaran="<?= esc($key->pelajaran) ?>">
                                <td align="center" scope="col"><?= $no++ ?></td>
                                <td align="center" scope="col">
                                    <a href="<?= base_url('home/PagePelajaran/'.$key->id_pelajaran) ?>">
                                        <?= esc($key->pelajaran) . ' | ' . esc($key->Kelas) . ' | ' . esc($key->blok) ?>
                                    </a>
                                </td>
                                <td align="center" scope="col"><?= esc($key->Guru) ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 on the user select dropdown
            $('#userSelect').select2({
                placeholder: "Select a value",
                allowClear: true
            });

            // Filter table rows based on selected Kelas, Blok, or Pelajaran
            $('#userSelect').on('change', function() {
                var selectedValue = $(this).val();
                var logRows = $('#logTableBody tr');

                logRows.each(function() {
                    var row = $(this);
                    var rowKelas = row.data('kelas');
                    var rowBlok = row.data('blok');
                    var rowPelajaran = row.data('pelajaran');

                    if (selectedValue === 'all' || rowKelas === selectedValue || rowBlok === selectedValue || rowPelajaran === selectedValue) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
