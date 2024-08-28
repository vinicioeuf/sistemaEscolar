<?php
session_start();
require("conexao.php");

// error_reporting(0);

  if((!isset($_SESSION['num_matricula']) == true) and (!isset($_SESSION['senha']) == true)){// Ele verifica se não há uma sessão com as credenciais num_matricula e senha, se não houver ele destrói a sessão.
      unset($_SESSION['num_matricula']);
      unset($_SESSION['senha']);
      header("Location: index.php");
  }
  $ids = $_SESSION['id'];
    $logado = $_SESSION['num_matricula'];// Caso haja uma sessão, o matricula do usuário é armazenado
    $con = Conexao::getInstance();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>- ITIF: Instituto de Tecnologia e Inovação FuturoTech</title>
    <link rel="stylesheet" href="styles/home.css">
    <link href="https://unpkg.com/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <script src="https://unpkg.com/fullcalendar@5.10.1/locales-all.min.js"></script>
    <style>
        .title-calendar {
            
            font-family: 'Times New Roman', Times, serif;
            font-weight: 700;
            text-align: start;
        }
        .main-calendario{
            margin-top: 100px;
            width: 100%;
            height: 70%;
            margin-left: 120px;
        }

        .calendario-div {
            
            width: 70%;
            height: 100%;
            margin-right: 20px;
            display: flex;
            justify-content: center;
        }

        #calendar {
            width: 100%;
            height: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .fc-toolbar-title {
            font-size: 24px;
            font-weight: bold;
            color: black;
            font-family: 'Times New Roman', Times, serif;
            display: flex;
            flex-wrap: wrap;
        }

        .fc-button
        {
            background-color: #ff8c00 !important; /* Laranja */
            border: none !important;
            color: #fff !important;
            width: 80px;
        }
        .fc-button-primary {
            background-color: #ff8c00 !important; /* Laranja */
            border: none !important;
            color: #fff !important;
            width: 100%;
        }
        .fc-button:hover,
        .fc-button-primary:hover {
            background-color: #e67e00 !important; /* Laranja escuro */
        }

        .fc-col-header-cell-cushion {
            color: black !important;
            font-weight: bold;
            font-family: 'Times New Roman', Times, serif;
        }

        .fc-daygrid-day-number {
            color: black !important;
            text-decoration: none !important;
            z-index: 1;
            position: relative;
        }

        .fc-daygrid-event {
            width: 100%;
            height: 100%;
            position: relative;
            color: transparent !important;
            
            
        }

        .fc-event-title {
            color: black !important; /* Texto do evento preto */
            position: relative;
            z-index: 1;
        }

        .fc-event {
            color: #fff !important; /* Texto do evento branco */
        }

        @media (max-width: 600px) {
            .calendario-div {
            width: 70%;
            height: 60%;
            margin-right: 20px;
            display: flex;
            justify-content: center;
        }

        }

        @media (max-width: 450px) {
            .calendario-div {
            width: 75%;
            height: 45%;
            margin-right: 20px;
            display: flex;
            justify-content: center;
        }

        }
        .legenda{
            margin-top: 15px;
        }
        .legenda span{
            font-weight: 700;
            font-family: 'Times New Roman', Times, serif;
        }
        .legenda-calendar{
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            list-style-type: square;
            justify-content: start;
        }

        .legenda-calendar  li:nth-child(1) {
            color: red;
        }

        .legenda-calendar li:nth-child(2) {
            color: green;
        }

        .legenda-calendar li:nth-child(3) {
            color: blue;
        }

        .legenda-calendar li:nth-child(4) {
            color: purple;
        }
        .legenda-calendar li:nth-child(5) {
            color: black;
        }
    </style>
</head>

<body>
    <?php include_once("main_top.php"); ?>

    <div id="constCalendar" class="main-calendario">
        <h1 class="mb-4 title-calendar">Calendário Acadêmico</h1>
        <div class="calendario-div">
            <div id="calendar"></div>
        </div>
    
        <div class="legenda">
            <span>Legenda:</span><br>
            <br>
            <ul class="legenda-calendar">
                <li>Feriado</li>
                <li>Provas</li>
                <li>Inicio do Semestre</li>
                <li>Fim do Semestre</li>
                <li>Conselho de Classe</li>
            </ul>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://unpkg.com/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'pt-br',
                headerToolbar: {
                    center: '',
                    left: 'title',
                    right: 'prev,next'
                },
                events: [
                    {
                        title: '',
                        start: '2024-07-10',
                        backgroundColor: 'red',
                        
                        
                    },
                    {
                        title: '',
                        start: '2024-07-15',
                        backgroundColor: 'blue',
                        
                    }
                ]
            });
            calendar.render(); 
        });
    </script>
</body>

</html>
