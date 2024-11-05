<?php
$no = 1;
$totalScore = 0;
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

<div class="container mt-4">
    <?php foreach ($Soal as $soal): ?>
        <?php if ($soal->pelajaran === $pelajaran->pelajaran && $soal->blok === $pelajaran->blok && $soal->kelas === $pelajaran->Kelas): ?>
            <?php
            $answerOptions = [
                'a' => $soal->pilihan_A,
                'b' => $soal->pilihan_B,
                'c' => $soal->pilihan_C,
                'd' => $soal->pilihan_D,
                'e' => $soal->pilihan_E
            ];

            $isCorrect = isset($answerOptions[$soal->JWB]) && $answerOptions[$soal->JWB] === $soal->JWBenar;
            if ($isCorrect) {
                $totalScore += 5;
            }
            ?>
            
            <!-- Start of Form for Each Question -->
            <form action="<?= base_url('home/jawaban')?>" method="post">
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
                                    <input class="form-check-input" type="radio" name="answer" value="<?= $optionKey ?>" <?= $soal->JWB === $optionKey ? 'checked' : '' ?>>
                                    <label class="form-check-label"><?= $optionKey ?>. <?= $optionValue ?></label>
                                </div>
                            <?php endforeach; ?>

                            <!-- Hidden Inputs to Send Question ID -->
                            <input type="hidden" name="ids" value="<?= $pelajaran->id_pelajaran ?>">
                            <input type="hidden" name="id" value="<?= $soal->id_soal ?>">
                            

                            <!-- Submit Button for Each Question -->
                            <button type="submit" class="btn btn-primary mt-3">Submit Answer</button>
                        </div>
                    </div>
                </div>
             
            </form>
            <!-- End of Form for Each Question -->
            
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="row mt-3">
    <form action="<?= base_url('home/selesai') ?>" method="post"> <!-- Redirects to 'nilai' upon form submission -->
        
        <div class="row mb-3">
            <input type="hidden" name="id" value="<?= $pelajaran->id_pelajaran ?>">
            <button type="submit" class="btn btn-primary">finish</button>
        </div>
    </form>
</div>
</div>

</body>
</html>
