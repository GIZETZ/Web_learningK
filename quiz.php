<?php
session_start();
require 'db_connection.php'; // Connexion à la base de données

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirection vers la page de connexion si non connecté
    exit();
}

// Récupérer les questions du quiz depuis la base de données :
$questions = [
    [
        "question" => "Que signifie HTML ?",
        "answers" => [
            ["text" => "HyperText Markup Language", "correct" => true],
            ["text" => "HighText Machine Language", "correct" => false],
            ["text" => "HyperTool Multi Language", "correct" => false],
            ["text" => "HyperText Multi Language", "correct" => false]
        ]
    ],

    [
        "question" => "Quelle propriété CSS est utilisée pour changer la couleur de fond d'un élément ?",
        "answers" => [
            ["text" => "background-color", "correct" => true],
            ["text" => "color", "correct" => false],
            ["text" => "bgcolor", "correct" => false],
            ["text" => "background-style", "correct" => false]
        ]
    ],
    [
        "question" => "Quelle méthode JavaScript est utilisée pour sélectionner un élément par son ID ?",
        "answers" => [
            ["text" => "document.getElementById()", "correct" => true],
            ["text" => "document.querySelector()", "correct" => false],
            ["text" => "document.getElement()", "correct" => false],
            ["text" => "document.selectById()", "correct" => false]
        ]
    ],
    [
        "question" => "En PHP, quelle fonction est utilisée pour afficher du contenu sur la page ?",
        "answers" => [
            ["text" => "echo", "correct" => true],
            ["text" => "print_r", "correct" => false],
            ["text" => "display", "correct" => false],
            ["text" => "output", "correct" => false]
        ]
    ],
    [
        "question" => "Quel type de base de données utilise SQL pour gérer les données ?",
        "answers" => [
            ["text" => "Relationnelle", "correct" => true],
            ["text" => "Non relationnelle", "correct" => false],
            ["text" => "Documentaire", "correct" => false],
            ["text" => "Graphique", "correct" => false]
        ]
    ],
    [
        "question" => "Quelle propriété CSS est utilisée pour rendre un texte en gras ?",
        "answers" => [
            ["text" => "font-weight", "correct" => true],
            ["text" => "text-style", "correct" => false],
            ["text" => "font-bold", "correct" => false],
            ["text" => "text-weight", "correct" => false]
        ]
    ],
    [
        "question" => "Que fait la méthode JavaScript `alert()` ?",
        "answers" => [
            ["text" => "Elle affiche un message d'alerte", "correct" => true],
            ["text" => "Elle demande une confirmation", "correct" => false],
            ["text" => "Elle ouvre une nouvelle fenêtre", "correct" => false],
            ["text" => "Elle enregistre des données", "correct" => false]
        ]
    ],
    [
        "question" => "En SQL, quelle commande est utilisée pour extraire des données d'une table ?",
        "answers" => [
            ["text" => "SELECT", "correct" => true],
            ["text" => "EXTRACT", "correct" => false],
            ["text" => "GET", "correct" => false],
            ["text" => "FETCH", "correct" => false]
        ]
    ],
    [
        "question" => "En PHP, comment démarre-t-on une session ?",
        "answers" => [
            ["text" => "session_start()", "correct" => true],
            ["text" => "start_session()", "correct" => false],
            ["text" => "begin_session()", "correct" => false],
            ["text" => "session_begin()", "correct" => false]
        ]
    ]

];


// Le reste du code pour afficher le quiz et gérer la logique
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Système d'Exploitation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
    </style>
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            /* Dégradé élégant bleu */
            color: #ffffff;
            font-family: 'nunito';
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .quiz-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 50px auto;
            padding: 20px;
            border-radius: 15px;
            background-color: #2a5298;
            width: 700px;
            max-width: 700px;
            height: 370px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;/
        }

        .question,
        .answers,
        .timer {
            margin: 20px 0;
            text-align: center;
        }


        .question {
            font-size: 20px;
        }

        .answers {

            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* 2 colonnes */
            gap: 20px;
            /* Espacement entre les colonnes */

        }

        .answer {
            background-color: #1e3c72;
            border: none;
            color: #fff;
            padding: 17px;
            margin: 5px 0;
            /* Ajuster la marge pour éviter les débordements */
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 17px;
        }

        .answer:hover {
            background-color: #163a69;
            /* Effet de survol */
        }

        .next-btn {
            margin-top: 500px;
            padding: 10px 20px;
            background-color: #222;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .next-btn:hover {
            background-color: #333;
        }

        /* Style pour le bouton Quitter */
        .quit-btn {
            margin-top: 20px;
            padding: 10px 20px;
            height: 50px;
            width: 190px;
            background-color: #4e7bad;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 20px;
            transition: all 0.3s ease;
            animation: fadeInUp 1.2s ease forwards;
            font-size: 16px;
            margin-left:300px;
        }

        .quit-btn:hover {
        background-color: #68B0AB;
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }

        .quiz-container-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        }
        .progress-bar-wrapper {
            width: 100%;
            height: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            margin: 20px 0;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            width: 0%;
            background-color: #ef233c; 
            transition: width 0.3s ease;
        }


        .hidden {
            display: none;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            /* Empêche les interactions */
            transition: opacity 0.5s ease;
            /* Optionnel : ajout d'une transition */
        }

        .correct {
            background-color: green !important;
        }

        .incorrect {
            background-color: red !important;
        }

        .timer {
            font-size: 18px;
            color: #ffffff;
            margin-top: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0.5;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .quiz-container:hover {
            animation: pulse 0.5s ease-in-out;
        }
        /* From Uiverse.io by javierBarroso */
        /* Level settings */
        .slider {
          /* slider */
          --slider-width: 100%;
          --slider-height: 15px;
          --slider-bg: rgba(82, 82, 82, 0.322);
          --slider-border-radius: 5px;
          /* level */
          --level-color: #ef233c;
          --level-transition-duration: 5s;
          /* icon */
          --icon-margin: 15px;
          --icon-color: var(--slider-bg);
          --icon-size: 30px;
        }
        
        .slider {
          position: relative;
          cursor: pointer;
          display: inline-flex;
          flex-direction: row-reverse;
          align-items: center;
        }
        
        .slider .volume {
          display: inline-block;
          margin-right: var(--icon-margin);
          color: var(--icon-color);
          width: var(--icon-size);
          height: auto;
          position: absolute;
          left: 18px;
          pointer-events: none;
          transition-duration: 0.5s;
        }
        
        .slider .level {
          -webkit-appearance: none;
          appearance: none;
          width: var(--slider-width);
          height: var(--slider-height);
          background: var(--slider-bg);
          overflow: hidden;
          border-radius: var(--slider-border-radius);
          transition: height var(--level-transition-duration);
          cursor: inherit;
          transform: rotate(270deg);
        }
        
        .slider .level::-webkit-slider-thumb {
          -webkit-appearance: none;
          width: 0px;
          height: 0px;
          box-shadow: -100px 0 5px 100px var(--level-color),
                      -100px 0px 20px 100px var(--level-color);
        }
        
        .slider .level:hover ~ .volume {
          color: var(--level-color);
          opacity: 0.6;
        }
        
        .slider .level::-moz-range-thumb {
          width: 0;
          height: 0;
          border-radius: 0;
          border: none;
          box-shadow: -100px 0 5px 100px var(--level-color),
                      -100px 0px 20px 100px var(--level-color);
        }
    </style>
</head>

<body>
    <!-- Ajouter l'audio en arrière-plan -->
    <audio id="background-music" autoplay loop>
        <source src="musique/le son.mp3" type="audio/mpeg">
        Musique
    </audio>
    
    <label class="slider">
        <input type="range" class="level" id="volume" min="0" max="1" step="0.1" value="1">
        <svg class="volume" xmlns="http://www.w3.org/2000/svg" version="1.1" width="512" height="512" viewBox="0 0 24 24">
            <g>
                <path d="M18.36 19.36a1 1 0 0 1-.705-1.71C19.167 16.148 20 14.142 20 12s-.833-4.148-2.345-5.65a1 1 0 1 1 1.41-1.419C20.958 6.812 22 9.322 22 12s-1.042 5.188-2.935 7.069a.997.997 0 0 1-.705.291z" fill="currentColor"></path>
                <path d="M15.53 16.53a.999.999 0 0 1-.703-1.711C15.572 14.082 16 13.054 16 12s-.428-2.082-1.173-2.819a1 1 0 1 1 1.406-1.422A6 6 0 0 1 18 12a6 6 0 0 1-1.767 4.241.996.996 0 0 1-.703.289zM12 22a1 1 0 0 1-.707-.293L6.586 17H4c-1.103 0-2-.897-2-2V9c0-1.103.897-2 2-2h2.586l4.707-4.707A.998.998 0 0 1 13 3v18a1 1 0 0 1-1 1z" fill="currentColor"></path>
            </g>
        </svg>
    </label>
    <div>
       <div class="progress-bar-wrapper">
         <div id="progress-bar" class="progress-bar"></div>
       </div>

        <div class="quiz-container">
            <div id="quiz">
                <!-- Le quiz sera généré ici par JS -->
            </div>
            <div id="timer" class="timer">Temps restant : 20s</div>
            <button id="next-btn" class="next-btn hidden">Suivant</button>
        </div>

        <div id="result" class="hidden">
            <h2>Votre moyenne : <span id="score"></span> / 20</h2>
            <!--
        <button onclick="restartQuiz()">Recommencer</button>
        -->
        </div>
        <button id="next-btn" class="next-btn hidden">Suivant</button>
        <button class="quit-btn" onclick="confirmQuit()">Quitter</button>


    </div>


    <script>
        const questions = <?php echo json_encode($questions); ?>; // Conversion en JSON pour JS

        let currentQuestionIndex = 0;
        let score = 0;
        let timeLeft = 20;
        let timerInterval;

        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        function showQuestion() {
            clearInterval(timerInterval);
            const questionElement = document.getElementById('quiz');
            const currentQuestion = questions[currentQuestionIndex];

            // Mélanger les réponses pour chaque question
            shuffle(currentQuestion.answers);

            questionElement.innerHTML = `
                <div class="question">${currentQuestion.question}</div>
                <div class="answers">
                    ${currentQuestion.answers.map((answer, index) => `
                        <button class="answer" onclick="selectAnswer(${index})">${answer.text}</button>
                    `).join('')}
                </div>
            `;
            timeLeft = 20;
            document.getElementById('timer').innerText = `Temps restant : ${timeLeft}s`;
            timerInterval = setInterval(updateTimer, 1000);
        }
        //++++++++++++++++++++
        //TIMER
        //++++++++++++++++++++
        function updateTimer() {
            timeLeft--;
            document.getElementById('timer').innerText = `Temps restant : ${timeLeft}s`;
            if (timeLeft === 0) {
                clearInterval(timerInterval);
                showNextQuestion();
            }
        }
        //++++++++++++++++++++
        //SELECTIONNER QUESTION
        //+++++++++++++++++++++
        function selectAnswer(selectedIndex) {
            clearInterval(timerInterval);
            const currentQuestion = questions[currentQuestionIndex];
            const answerButtons = document.querySelectorAll('.answer');
            const selectedButton = answerButtons[selectedIndex];
            const correctAnswer = currentQuestion.answers.find(answer => answer.correct);

            if (currentQuestion.answers[selectedIndex].correct) {
                score++;
                selectedButton.classList.add('correct');
            } else {
                selectedButton.classList.add('incorrect');
            }

            answerButtons.forEach((button, index) => {
                button.disabled = true;
                if (currentQuestion.answers[index].correct) {
                    button.classList.add('correct');
                }
            });

            setTimeout(showNextQuestion, 2000);
        }
        //+++++++++++++++++++++++++++
        //confirmQuit
        //+++++++++++++++++++++++
        function confirmQuit() {
            const niveau = currentQuestionIndex + 1; // Niveau actuel (1-indexé pour l’utilisateur)
            const totalQuestions = questions.length;
            const message = ` Vous nous quitter déjà 😭? Vous êtes à la question ${niveau} sur ${totalQuestions}.🚀`;

    if (window.confirm(message)) {
        // Calculer le score final basé sur les questions répondues
        const finalScore = Math.round((score / questions.length) * 20);

        // Créer un formulaire pour soumettre le score
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'quiz_process.php';

        // Ajouter un champ caché pour le score
        const scoreInput = document.createElement('input');
        scoreInput.type = 'hidden';
        scoreInput.name = 'score';
        scoreInput.value = finalScore;
        form.appendChild(scoreInput);

        // Ajouter le formulaire au document et le soumettre
        document.body.appendChild(form);
        form.submit();
    }
}

        //+++++++++++++++++
        //PROGRESS BAR
        //+++++++++++++++++++
        function updateProgressBar() {
              const progressBar = document.getElementById('progress-bar');
              const progressPercentage = ((currentQuestionIndex + 1) / questions.length) * 100; // +1 pour inclure la dernière question
              progressBar.style.width = progressPercentage + '%';
}
        //++++++++++++++++++++++
        //PROCHAINE QUESTION
        //++++++++++++++++++++++
        function showNextQuestion() {
               currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
               showQuestion();
               updateProgressBar(); // Mettre à jour la barre de progression
            } else {
               showResults();
    }
}

        //+++++++++++++++++++++
        //VOIR ES RESULTATS
        //++++++++++++++++++++
        function showResults() {
            document.getElementById('background-music').pause();
            document.getElementById('quiz').classList.add('hidden');
            document.getElementById('result').classList.remove('hidden');
            const finalScore = Math.round((score / questions.length) * 20); // Arrondir le score

            document.getElementById('score').innerText = finalScore.toFixed(2);
            console.log("Score final :", finalScore);
            // Créer un formulaire pour soumettre le score
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'quiz_process.php';

            // Ajouter un champ caché pour le score
            const scoreInput = document.createElement('input');
            scoreInput.type = 'hidden';
            scoreInput.name = 'score';
            scoreInput.value = finalScore;
            form.appendChild(scoreInput);
            document.body.appendChild(form);

            // Soumettre le formulaire
            form.submit();
            
        }
        //++++++++++++++++++++++
        //RESTART
        //+++++++++++++++++++++++
        function restartQuiz() {
            currentQuestionIndex = 0;
            score = 0;

            // Mélanger les questions avant de recommencer
            shuffle(questions);

            document.getElementById('quiz').classList.remove('hidden');
            document.getElementById('result').classList.add('hidden');
            showQuestion();
        }
        //+++++++++++++++
        // VOLUME CONTROL 
        //++++++++++++++++
        const volumeControl = document.getElementById('volume');
        const backgroundMusic = document.getElementById('background-music');

        // Mettre à jour le volume de la musique lorsque l'utilisateur change le curseur
        volumeControl.addEventListener('input', function() {
            backgroundMusic.volume = this.value; // Le volume est compris entre 0 et 1
        });

        // Démarrer la musique au chargement de la page
        window.onload = () => {
            backgroundMusic.play();
        };
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // Mélanger les questions lors du premier chargement de la page
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        shuffle(questions);
        showQuestion();
        updateProgressBar();
    </script>
</body>

</html>