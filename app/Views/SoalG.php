<?php
// Assuming $Soal is your array of questions retrieved from the database
$no = 1;
$totalScore = 0; // Initialize total score
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .question-container {
            background-color: #e3f2fd;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .correct-answer {
            background-color: #fff3cd;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .question-sidebar {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            height: 100%;
        }
        .btn-large {
            font-size: 1.5rem;
            padding: 15px 30px;
        }
    </style>
</head>
<body>
 <!-- Display Total Score --><?php
 $userLevel = session()->get('Level');
 $allowedLevels = ['admin', 'guru'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
    <div class="row mt-3">
    <form action="<?= base_url('home/t_soal') ?>" method="post"> <!-- Redirects to 'nilai' upon form submission -->
    <div class="col">
            <p><strong> No :</strong></p>
            <input type="text" class="form-control" id="no" name="no">
        </div>
    <div class="col">
            <p><strong> Soal :</strong></p>
            <input type="text" class="form-control" id="soal" name="soal">
        </div>
        <div class="col">
            <p><strong> JWB :</strong></p>
            <input type="text" class="form-control" id="JWB" name="JWB">
        </div>
        <div class="row mb-3">
            <div class="col">
                <p><strong>Pilihan A:</strong></p>
                <input type="text" class="form-control" id="pilihan_a" name="pilihan_a">
            </div>
            <div class="col">
                <p><strong>Pilihan B:</strong></p>
                <input type="text" class="form-control" id="pilihan_b" name="pilihan_b">
            </div>
            <div class="col">
                <p><strong>Pilihan C:</strong></p>
                <input type="text" class="form-control" id="pilihan_c" name="pilihan_c">
            </div>
            <div class="col">
                <p><strong>Pilihan D:</strong></p>
                <input type="text" class="form-control" id="pilihan_d" name="pilihan_d">
            </div>
            <div class="col">
                <p><strong>Pilihan E:</strong></p>
                <input type="text" class="form-control" id="pilihan_e" name="pilihan_e">
            </div>
        </div>
        <div class="row mb-3">
            <input type="hidden" name="id" value="<?= $pelajaran->id_pelajaran ?>">
            <input type="hidden" name="pelajaran" value="<?= $pelajaran->pelajaran ?>">
            <input type="hidden" name="kelas" value="<?= $pelajaran->Kelas ?>">
            <input type="hidden" name="blok" value="<?= $pelajaran->blok ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<?php } ?>
<div class="container mt-4">
    <?php foreach ($Soal as $soal): ?>
        <?php if ($soal->pelajaran === $pelajaran->pelajaran && $soal->blok === $pelajaran->blok && $soal->kelas === $pelajaran->Kelas): ?>
            <?php
            // Define answer options mapping
            $answerOptions = [
                'a' => $soal->pilihan_A,
                'b' => $soal->pilihan_B,
                'c' => $soal->pilihan_C,
                'd' => $soal->pilihan_D,
                'e' => $soal->pilihan_E
            ];

            // Calculate total score for correct answers
            $isCorrect = isset($answerOptions[$soal->JWB]) && $answerOptions[$soal->JWB] === $soal->JWBenar;
            if ($isCorrect) {
                $totalScore += 5; // Increment total score for each correct answer
            }
            ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="question-sidebar">
                        <p><strong>Question <?= $no++ ?>:</strong></p>
                     
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="question-container">
                        <p><?= $soal->soal ?></p>
                        <?php foreach ($answerOptions as $optionKey => $optionValue): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question<?= $no - 1 ?>" value="<?= $optionKey ?>" <?= $soal->JWB === $optionKey ? 'checked' : '' ?>>
                                <label class="form-check-label"><?= $optionKey ?>. <?= $optionValue ?></label>
                            </div>
                        <?php endforeach; ?>
                        <div class="correct-answer">
                            <p><strong>The correct answer is:</strong> <?= $soal->JWBenar ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    
   
</div>

</div>

</body>
</html>