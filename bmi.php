<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il tuo BMI</title>
    <link rel="stylesheet" href="stile.css">
</head>
<body>

    <h1>Il tuo BMI</h1>

    <?php
        // 1. Lettura dei dati inviati dal form
        $nome = $_POST["nome"];
        $peso = $_POST["peso"];
        $altezza = $_POST["altezza"];

        // Controlli input
        if ($peso <= 0 || $altezza <= 0) {
        echo "Errore: inserisci un peso e un'altezza validi!";
        echo "<br><br><a href='form.html'>Torna al form</a>";
        exit;
        }

        // 2. Calcolo del BMI: peso / (altezza in metri)^2
        $altezza_metri = $altezza / 100;
        $bmi = $peso / ($altezza_metri * $altezza_metri);
        
        // Arrotondamento a 2 decimali
        $bmi_formattato = round($bmi, 2);

        // 3. Controllo della fascia di peso
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
    ?>

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