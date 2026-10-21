Agisci come uno sviluppatore web e insegnante di TPSIT per una quinta superiore.
Crea una web application per il calcolo del BMI (Indice di Massa Corporea) composta da tre file:
1. `form.html` (interfaccia di input)
2. `bmi.php` (elaborazione e output)
3. `stile.css` (foglio di stile condiviso)

Rispetta rigorosamente i seguenti requisiti tecnici e stilistici:

### Stile comune (`stile.css`)
- Sfondo pagina: #F1F3F5, colore del testo: #1F2328
- Font sans-serif ('IBM Plex Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif)
- Layout a singola colonna centrato verticalmente e orizzontalmente nella viewport
- Card/Box: larghezza fissa 360px (responsive con max-width), padding 24px, border-radius 12px, ombra leggera: `box-shadow: 0 2px 8px rgba(0,0,0,0.08)`
- Input: altezza 44px, padding 0 12px, border-radius 8px, bordo 1px solid #C9CED4
- Pulsante: larghezza 100%, altezza 44px, sfondo #1F2328, testo bianco, border-radius 8px, no border, cursore pointer

### Pagina 1: `form.html`
- Titolo `<h1>`: "Calcolatore BMI" (dimensione 28px/32px, centrato)
- Form HTML con `method="post"` e `action="bmi.php"`
- Tre campi obbligatori (`required`), ciascuno con la propria `<label>` su riga separata:
  1. Nome (input text, placeholder "Luca")
  2. Peso in kg (input number, decimali ammessi con step="0.01", min="1", placeholder "70")
  3. Altezza in cm (input number, interi ammessi con min="30", placeholder "178")
- Pulsante di submit con etichetta "Calcola"

### Pagina 2: `bmi.php`
- Titolo `<h1>`: "Il tuo BMI"
- Ricezione dei dati via `$_POST`, sanitizzazione e controllo validità
- Formula: BMI = peso_kg / (altezza_m)^2  [altezza in metri = altezza_cm / 100]
- Arrotondamento del BMI a 2 cifre decimali
- Determinazione della fascia con logica if-elseif-else:
  * BMI < 18.5        -> Classe card: `sottopeso`  | Sfondo #E3EEF9 | Bordo e testo #2F6FB3 | Testo: "SOTTOPESO"
  * 18.5 <= BMI <= 24.9 -> Classe card: `normopeso`   | Sfondo #E3F4E6 | Bordo e testo #256D34 | Testo: "NORMOPESO"
  * 25.0 <= BMI <= 29.9 -> Classe card: `sovrappeso`  | Sfondo #FCEBD7 | Bordo e testo #9A4F06 | Testo: "SOVRAPPESO"
  * BMI >= 30.0       -> Classe card: `obesita`     | Sfondo #FBE2E2 | Bordo e testo #B32D2D | Testo: "OBESITÀ"
- La card deve avere classe multipla: `class="card [classe_fascia]"`
- Bordo della card: 3px solid con il rispettivo colore della fascia
- Struttura interna della card:
  * `<h2>`: Nome inserito
  * `<p>`: "Peso {X} kg · Altezza {Y} cm"
  * `<p>` per il valore del BMI: font-size 48px, grassetto
  * `<p>` per la fascia: maiuscolo, grassetto, spaziatura lettere 0.06em, con colore corrispondente alla fascia
- Sotto la card: link `<a>` "Calcola di nuovo" che rimanda a `form.html`