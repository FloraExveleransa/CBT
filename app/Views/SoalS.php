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
                        <p><?= $isCorrect ? 'Correct' : 'Incorrect' ?></p>
                        <p><?= $isCorrect ? '5/5' : '0/5' ?></p>
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
    
    <!-- Display Total Score --><?php
 $userLevel = session()->get('Level');
 $allowedLevels = ['admin', 'guru'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
    <div class="row mt-3">
    <form action="<?= base_url('home/nilai') ?>" method="post"> <!-- Redirects to 'nilai' upon form submission -->
        <div class="correct-answer">
            <p><strong>The total score:</strong></p>
            <input type="text" class="form-control" id="nilai" name="nilai" value="<?= $totalScore ?>" readonly>
        </div>
        <div class="row mb-3">
            <input type="hidden" name="id" value="<?= $pelajaran->id_pelajaran ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<?php } ?>
</div>

</div>

</body>
</html>