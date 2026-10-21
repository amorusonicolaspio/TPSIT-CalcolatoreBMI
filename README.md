# Calcolatore BMI in PHP - TPSIT

Progetto scolastico per la materia TPSIT.  
L'applicazione web calcola l'Indice di Massa Corporea (BMI) a partire dai dati inseriti dall'utente e restituisce una card dinamica con colore e classificazione in base al risultato ottenuto.

---

## 📁 Struttura del Progetto

- `form.html`: Interfaccia utente contenente il form di input (Nome, Peso in kg, Altezza in cm).
- `bmi.php`: Script backend in PHP che riceve i dati via `$_POST`, esegue il calcolo matematico, determina la categoria e genera dinamicamente la card.
- `stile.css`: Foglio di stile CSS centralizzato con layout responsive centrato e le 4 classi per le fasce di peso.
- `PROMPT.md`: Documentazione completa del prompt iniziale utilizzato con l'AI.

---

## 🎨 Logica delle Fasce BMI

| Range BMI | Fascia | Classe CSS | Colore Sfondo | Colore Bordo / Testo |
| :--- | :--- | :--- | :--- | :--- |
| `< 18.5` | Sottopeso | `.sottopeso` | `#E3EEF9` | `#2F6FB3` |
| `18.5 - 24.9` | Normopeso | `.normopeso` | `#E3F4E6` | `#256D34` |
| `25.0 - 29.9` | Sovrappeso | `.sovrappeso` | `#FCEBD7` | `#9A4F06` |
| `≥ 30.0` | Obesità | `.obesita` | `#FBE2E2` | `#B32D2D` |

---

## 🤖 Documentazione sull'Uso dell'AI

Come richiesto dalla consegna, per la realizzazione di questo elaborato è stato utilizzato un assistente AI.

### Informazioni sullo strumento
- **Modello AI:** Google Gemini 3.8 Flash (Thinking Level High) tramite Google AI Studio.
- **Prompt iniziale:** Consultabile integralmente nel file `PROMPT.md`.

### Metodologia e Revisione Umana dello Studente:
1. **Generazione e Separazione:** È stato fornito all'AI il layout dell'artefatto del docente; gli stili sono stati estratti dal codice inline e centralizzati nel foglio `stile.css`.
2. **Revisione Umana:** Il codice è stato ripulito, controllato da costrutti per fare in modo che non ci siano errori nè funzioni non studiate.
3. **Debug Logico dei Casi Limite (Edge Cases):**  
   Durante la fase di testing con dati reali (es. *Peso: 72 kg, Altezza: 170 cm* -> BMI: 24.91) è emerso che applicare rigidamente le condizioni da slide (`<= 24.9` e `>= 25`) lasciava un "vuoto" per i valori compresi tra 24.90 e 25.00, facendo ricadere erroneamente l'utente nella fascia di obesità.  
   La logica è stata quindi corretta usando le soglie matematiche continue (`$bmi < 25` e `$bmi < 30`), garantendo la corretta classificazione per qualsiasi valore decimale.