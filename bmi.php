<?php
    // Verifica metodo richiesta,se GET reindirizza form
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        header("Location: form.html");
        exit;
    }

    // flag controllo validazione dati
    $dati_validi = true;


    // Validazione Input

    if (isset($_POST["nome"]) && trim($_POST["nome"]) != "") {
        $nome = trim($_POST["nome"]);
    } else {
        $nome = "NOT_VALID";
        $dati_validi = false;
    }

    if (isset($_POST["altezza"]) && is_numeric($_POST["altezza"]) && $_POST["altezza"] > 0) {
        $altezza = $_POST["altezza"];
    } else {
        $altezza = "NOT_VALID";
        $dati_validi = false;
    }

    if (isset($_POST["peso"]) && is_numeric($_POST["peso"]) && $_POST["peso"] > 0) {
        $peso = $_POST["peso"];
    } else {
        $peso = "NOT_VALID";
        $dati_validi = false;
    }

    // controllo validazione input e calcolo se validi
    if ($dati_validi) {
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
        } else {
            $classe = "obesita";
            $fascia = "OBESITÀ";
        }

    } else {
        $bmi = "NOT_VALID";
        $classe = "NOT_VALID";
    }

    // log
    $fileLog = fopen("log.csv", "a");

    $record = "";
    $record .= date("d/m/Y");
    $record .= ",";
    $record .= date("H:i:s");
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

    // avviso errore dati non validi
    if (!$dati_validi) {
        echo "<h1>Errore: Dati non validi!</h1>";
        echo "<p>I dati inseriti non sono corretti. L'operazione &egrave stata registrata nel log e annulata.</p>";
        echo "<br><a href='form.html'>Torna al form</a>";
        exit;
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