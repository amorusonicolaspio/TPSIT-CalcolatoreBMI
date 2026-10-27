<?php
    // Verifica richiesta e reindirizzamento
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        header("Location: form.html");
    } else {
        // Lettura e Controlli input
        $nome = $_POST["nome"];

        if (isset($_POST["peso"])) {
            $peso = $_POST["peso"];
            if ($peso <= 0) {
                $peso = "NOT_VALD";
            }
        } else {
            $peso = "NOT_VALD";
        }

        if (isset($_POST["altezza"])) {
            $altezza = $_POST["altezza"];
            if ($altezza <= 0) {
                $altezza = "NOT_VALD";
            }
        } else {
            $altezza = "NOT_VALD";
        }

        if ($nome == "NOT_VALD" || $peso == "NOT_VALD" || $altezza == "NOT_VALD") {
            $bmi = "NOT_VALD";
            $bmi_formattato = "NOT_VALD";
            $classe = "NOT_VALD";
        } else {
            // Calcolo del BMI: peso / (altezza in metri)^2
            $altezza_metri = $altezza / 100;
            $bmi = $peso / ($altezza_metri * $altezza_metri);
            
            // Arrotondamento a 2 decimali
            $bmi_formattato = round($bmi, 2);


            // Controllo della fascia di peso
            if ($bmi < 18.5) {
                $classe = "sottopeso";
                $fascia = "SOTTOPESO";
            } else if ($bmi < 25) {
                $classe = "normopeso";
                $fascia = "NORMOPESO";
            } else if ($bmi < 30) {
                $classe = "sovrappeso";
                $fascia = "SOVRAPPESO";
            } else {                      // Da 30 in poi
                $classe = "obesita";
                $fascia = "OBESITÀ";
            }
        }


        // Log
        $fileLog = fopen("log.txt", "a");

        $record = "";
        $record .= date("d/m/Y");
        $record .= ",";
        $record .= date ("H:i:s");
        $record .= ",";
        $record .= $_SERVER['REMOTE_ADDR'];
        $record .= ",";
        $record .= $nome;
        $record .= ",";
        $record .= $altezza;
        $record .= ",";
        $record .= $peso;
        $record .= ",";
        $record .= $bmi;
        $record .= ",";
        $record .= $classe;
        $record .= "\n";

        fwrite($fileLog, $record);
        fclose($fileLog);
    }
?>




<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il tuo BMI</title>
    <link rel="stylesheet" href="stile.css">
</head>
<body>

    <!-- Titolo della pagina -->
    <h1>Il tuo BMI</h1>

    <!-- Card con la doppia classe richiesta -->
    <div class="card <?php echo $classe; ?>">
        <h2><?php echo $nome; ?></h2>
        <p class="dati-utente">Peso <?php echo $peso; ?> kg · Altezza <?php echo $altezza; ?> cm</p>
        <p class="valore-bmi"><?php echo $bmi_formattato; ?></p>
        <p class="scritta-fascia"><?php echo $fascia; ?></p>
    </div>

    <a href="form.html" class="link-ritorno">Calcola di nuovo</a>

</body>
</html>