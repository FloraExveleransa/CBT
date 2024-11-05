<html>
<head>
    <title>Bahasa Indonesia RPL XII A - B2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F5F5F7; /* Light gray background */
        }
        .title-box {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            margin-top: 20px;
            text-align: center;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            margin: 0; /* Remove default margin */
        }
        .breadcrumb {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .content {
            margin-top: 20px;
        }
        .box {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .icon {
            margin-right: 8px;
        }
        .item {
            margin-bottom: 10px;
        }
        .progress-section {
            text-align: right;
            font-size: 14px;
            margin-left: auto; /* Align to right */
        }
        .topic {
            padding: 10px 0;
            font-size: 18px;
            margin-top: 10px;
        }
        a {
            text-decoration: none;
            color: inherit; /* Makes the link color the same as normal text */
        }
        .divider {
            border-top: 1px solid #E0E0E0;
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Title Box -->
        <div class="title-box">
            <h1 class="title"><?= $pelajaran->pelajaran ?> <?= $pelajaran->Kelas ?> <?= $pelajaran->blok ?></h1>
        </div>
        
        <!-- Breadcrumb Navigation -->
    
        <!-- Content Section -->
        <div class="content">
            <!-- Combined Box for FINAL BLOK 2, Bahasa Indonesia, Progress, and Topics -->
            <div class="box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column">
                    <?php
 $userLevel = session()->get('Level');
 $allowedLevels = ['Siswa'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
                    <?php if ($pelajaran->Selesai === 'Selesai'): ?>
                        <div class="nilai-score mb-2">
                        <strong>Nilai : <?= $pelajaran->nilai ?></strong>
                    </div>
    <div class="item d-flex align-items-center">
        <i class="fas fa-folder icon"></i>
        <a href="<?= base_url('home/PageUjian/' . $pelajaran->id_pelajaran) ?>">FINAL <?= $pelajaran->blok ?></a>
    </div>
    <div class="item d-flex align-items-center">
        <i class="fas fa-file-alt icon"></i>
        <a href="<?= base_url('home/PageUjian/' . $pelajaran->id_pelajaran) ?>"><?= $pelajaran->pelajaran ?></a>
    </div>
<?php else: ?>
    <div class="item d-flex align-items-center">
        <i class="fas fa-folder icon"></i>
        <a href="<?= base_url('home/PageUjianB/' . $pelajaran->id_pelajaran) ?>">FINAL <?= $pelajaran->blok ?></a>
    </div>
    <div class="item d-flex align-items-center">
        <i class="fas fa-file-alt icon"></i>
        <a href="<?= base_url('home/PageUjianB/' . $pelajaran->id_pelajaran) ?>"><?= $pelajaran->pelajaran ?></a>
    </div>
<?php endif; ?>
 <?php } ?>
 <?php
 $userLevel = session()->get('Level');
 $allowedLevels = ['guru'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
                    <?php if ($pelajaran->Selesai === 'Selesai'): ?>
                        <div class="nilai-score mb-2">
                        <strong>Nilai : <?= $pelajaran->nilai ?></strong>
                    </div>
    <div class="item d-flex align-items-center">
        <i class="fas fa-folder icon"></i>
        <a href="<?= base_url('home/PageUjian/' . $pelajaran->id_pelajaran) ?>">FINAL <?= $pelajaran->blok ?></a>
    </div>
    <div class="item d-flex align-items-center">
        <i class="fas fa-file-alt icon"></i>
        <a href="<?= base_url('home/PageUjian/' . $pelajaran->id_pelajaran) ?>"><?= $pelajaran->pelajaran ?></a>
    </div>
<?php else: ?>
    <div class="item d-flex align-items-center">
        <i class="fas fa-folder icon"></i>
        <a href="<?= base_url('home/PageUjianG/' . $pelajaran->id_pelajaran) ?>">FINAL <?= $pelajaran->blok ?></a>
    </div>
    <div class="item d-flex align-items-center">
        <i class="fas fa-file-alt icon"></i>
        <a href="<?= base_url('home/PageUjianG/' . $pelajaran->id_pelajaran) ?>"><?= $pelajaran->pelajaran ?></a>
    </div>
<?php endif; ?>
 <?php } ?>
                    </div>
                    
                    <!-- Progress Section -->
                    <div class="progress-section d-flex align-items-center">
                       
                    </div>
                </div>

                <!-- Divider -->
                <div class="divider"></div>

                <!-- Topics List -->
                <div class="d-flex flex-column">
                    <div class="topic"><a href="#">Topic 1</a></div>
                    <div class="divider"></div>
                    <div class="topic"><a href="#">Topic 2</a></div>
                    <div class="divider"></div>
                    <div class="topic"><a href="#">Topic 3</a></div>
                    <div class="divider"></div>
                    <div class="topic"><a href="#">Topic 4</a></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIqj5zjxbNucup0Nb4DzIBxUO/JTfwlW8hrgfjFSwoHdj3Xhpvo" crossorigin="anonymous"></script>
    
    <script>
        // Initialize tooltips when the document is ready
        document.addEventListener("DOMContentLoaded", function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
</body>
</html>
