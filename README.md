Airbnb

Introduzione
Airbnb è una web app che permette di trovare e gestire l’affitto di appartamenti.

I proprietari di appartamenti, registrandosi a Airbnb, possono inserire le informazioni delle loro proprietà e decidere se sponsorizzarle per avere una posizione evidenziata nelle ricerche e in home page.

Gli utenti interessati ad affittare, senza registrazione, possono cercare e visualizzare gli appartamenti. Una volta scelto l’appartamento di interesse, possono inviare un messaggio al proprietario tramite la piattaforma, per chiedere maggiori dettagli.


Tipi di Utenti

Definiamo i seguenti tipi di utente che possono utilizzare Airbnb:
- Utente registrato (UR): un utente che ha effettuato la registrazione;
- Utente registrato con appartamento (URA): un utente che ha effettuato la registrazione e ha inserito nel sistema almeno un appartamento;
- Utente interessato (UI): un qualsiasi utente del sito, non registrato;


Lista delle pagine 

Homepage: 
Offre la possibilità di ricercare gli appartamenti. 
Inoltre permette un accesso veloce alle pagine dettaglio degli appartamenti in evidenza.

Pagina di Ricerca Avanzata:
Permette di visualizzare i risultati di ricerca, ogni risultato permetterà l’accesso alla pagina di dettaglio dell’appartamento.
Inoltre è possibile raffinare la ricerca senza il refresh della pagina, applicando dei filtri.

Pagina Dettaglio Appartamento Pubblica: 
Permette di visualizzare tutti i dettagli disponibili per un appartamento e permette l’invio di un messaggio al proprietario.

Dashboard Utente Registrato:
Permette l’inserimento di un nuovo appartamento e l’accesso ai propri appartamenti.

Pagina Lista Appartamenti:
Da qui è possibile accedere alla modifica e cancellazione dei propri appartamenti, e accedere ai relativi messaggi e statistiche.

Pagina Lista Messaggi Singolo Appartamento.

Pagina Sponsorizzazione: 
Tramite questo pannello è possibile sponsorizzare un singolo appartamento alla volta, selezionando il tipo di promozione desiderata e inserendo i dettagli della carta di credito.

Pagina Statistiche Singolo Appartamento: 
Permette di visualizzare le statistiche dell’appartamento selezionato. 
Nello specifico i grafici mostrano il numero di visualizzazioni e il numero di messaggi relativi all’appartamento per mesi/anni.


Requisiti Tecnici

- (RT1) Client-side Validation:
Tutti gli input inseriti dall’utente sono controllati client-side (oltre che server-side) per un controllo di veridicità (es. il numero di stanze di un appartamento deve essere positivo).

- (RT2) Salvataggio di informazioni geografiche:
I dati riguardanti l’ubicazione degli appartamenti sono salvati sul database con latitudine e longitudine. 
Per ottenere latitudine e longitudine a partire da un indirizzo e allo stesso modo visualizzare il punto sulla mappa, è utilizzato TomTom: https://developer.tomtom.com/

-(RT3) Sistema di Pagamento:
Il sistema di pagamento utilizzato è Braintree: https://www.braintreepayments.com/ 
Il sistema permette agli sviluppatori di simulare pagamenti senza essere approvati formalmente e senza utilizzare vere carte di credito.

- (RT4) Il sito è responsive:
Il sito è correttamente visibile da desktop e da smartphone.

- (RT5) La ricerca degli appartamenti nella pagina dedicata e l’applicazione dei filtri avvengono senza il refresh della pagina.


Requisiti Funzionali
La piattaforma soddisfa i seguenti requisiti funzionali (RF) che vengono dettagliati nelle pagine successive:

(RF1) Permettere ai proprietari di appartamento di registrarsi alla piattaforma
(RF2) Permettere ai proprietari di appartamento registrati di aggiungere un appartamento alla piattaforma
(RF3) Permette ai visitatori di ricercare una appartamento
(RF4) Permettere ai visitatori di vedere i dettagli di un appartamento
(RF5) Permettere ai visitatori di scrivere al proprietario di un appartamento per chiedere informazioni
(RF6) Permettere ai proprietari di appartamento registrati di vedere i messaggi ricevuti
(RF8) Permettere ai proprietari di appartamento registrati di sponsorizzare un appartamento
(RF7) Permettere ai proprietari di appartamento registrati di vedere statistiche dei propri appartamenti


(RF1) Permettere ai proprietari di appartamento di registrarsi alla piattaforma

Visibilità: UI
Descrizione: 
L’applicazione permette ai proprietari di appartamento di registrarsi alla piattaforma e creare un profilo.
Le informazioni che l’utente può inserire sono:
- Email *
- Password *
- Nome
- Cognome
- Data di Nascita
Sono contrassegnati con * i dati obbligatori.

Email e password sono utilizzati dall’utente per fare il login alla piattaforma.
Non è previsto un pannello per modificare le informazioni inserite una volta registrato.
I form devono rispettare RT1.

Risultato: Un nuovo utente viene creato nel sistema
Eccezioni: Esiste già nel sistema un utente con l’email inserita


(RF2) Permettere ai proprietari di appartamento registrati di aggiungere un appartamento alla piattaforma.

Visibilità: UR / URA
Descrizione: Un proprietario registrato ha la possibilità di inserire uno o più appartamenti all’interno del sistema. 
Per inserire un nuovo appartamento il proprietario deve inserire le seguenti informazioni:
Titolo riepilogativo che descriva l’appartamento:
- Numero di stanze
- Numero di letti
- Numero di bagni
- Metri quadrati
- Indirizzo completo (con latitudine e longitudine)
- Immagine rappresentativa dell’appartamento
- Uno o più servizi aggiuntivi: WiFi, Posto Macchina, Piscina, Portineria, Sauna, Vista Mare…
- Visibile si/no

È possibile modificare le informazioni inserite
I form devono rispettare RT1.
L’inserimento dell’indirizzo porta al salvataggio sul database di latitudine e longitudine come descritto in RT2.

Risultato: Una stanza è inserita nel sistema e le sue informazioni sono aggiornate


(RF3) Permettere ai visitatori di ricercare un appartamento.

Visibilità: UI / UR / URA
Descrizione: Un qualsiasi utente è in grado di ricercare un appartamento all’interno del database.
Inserendo una città o un indirizzo (anche parziale), il sistema ricerca all’interno del database gli appartamenti nel raggio di 20 km dalla latitudine e longitudine indicata.
Inoltre è possibile raffinare ulteriormente la ricerca impostando uno o più dei seguenti filtri:
- Numero minimo di stanze
- Numero minimo di posti letto
- Modificare il raggio di default di 20km

La presenza obbligatoria di uno o più dei servizi aggiuntivi indicati in RF2
I risultati vengono ordinati per distanza dalla latitudine/longitudine inserita.
La ricerca rispetta il requisito RT5

Risultato: Viene generata una lista di appartamenti che corrispondono alla ricerca che mostra alcuni dettagli della stanza.


(RF4) Permettere ai visitatori di vedere i dettagli di un appartamento.

Visibilità: UI / UR / URA
Descrizione: Selezionando un appartamento dalla sezione in evidenza o in homepage o dai risultati di ricerca, appaiono tutti i dettagli disponibili riguardanti l’appartamento in questione, come specificato in RF2.
In particolare, è mostrata una mappa che indica la posizione dell’appartamento.

Risultato: Viene visualizzata la pagina di dettaglio di un appartamento


(RF5) Permettere ai visitatori di scrivere al proprietario di un appartamento per chiedere informazioni.

Visibilità: UI / UR / URA
Descrizione: Dalla pagina di dettaglio dell’appartamento deve essere possibile inviare un messaggio al proprietario dell’appartamento.
L’utente deve inserire la propria email e un messaggio.
Nel caso in cui l’utente sia un UR o URA registrato, l’email è autocompilata con quella inserita durante la registrazione

Risultato: Il messaggio viene salvato nel database


(RF6) Permettere ai proprietari di appartamento registrati di vedere i messaggi ricevuti.

Visibilità: URA
Descrizione: Un proprietario che ha inserito uno o più appartamenti ha la possibilità di vedere i messaggi di richiesta ricevuti dagli utenti per gli appartamenti.
Non è prevista la possibilità di risposta da parte dell’utente URA (che risponderà direttamente via email fuori dalla piattaforma)

Risultato: L’utente visualizza i messaggi ricevuti, con le informazioni necessarie per poter rispondere all’utente via email.


(RF7) Permettere ai proprietari di appartamento registrati di sponsorizzare il proprio appartamento.

Visibilità: URA
Descrizione: Un proprietario che ha inserito uno o più appartamenti ha la possibilità di pagare per metterli in evidenza in homepage e nella pagina di ricerca.
Entrando in un pannello apposito della sua sezione personale, l’utente URA può selezionare uno dei suoi appartamenti e scegliere uno dei seguenti pacchetti promozionali:
- 2,99 € per 24 ore di sponsorizzazione
- 5.99 € per 72 ore di sponsorizzazione
- 9.99 € per 144 ore di sponsorizzazione
Il pagamento avviene tramite carta di credito seguendo RT3

Un appartamento sponsorizzato ha le seguenti particolarità:
Appare in Homepage nella sezione “Appartamenti in Evidenza”
Nella pagina di ricerca, viene posizionato sempre prima di un appartamento non sponsorizzato che soddisfa le stesse caratteristiche di ricerca.
Terminato il periodo di sponsorizzazione, l’appartamento tornerà ad essere visualizzato normalmente, senza alcuna particolarità.

Risultato: L’appartamento viene sponsorizzato
Eccezioni: Il sistema di pagamento non ha processato correttamente il pagamento / i dati della carta di credito non sono validi


(RF8) Permettere ai proprietari di appartamento registrati di vedere statistiche dei propri appartamenti.

Visibilità: URA
Descrizione: Un proprietario che ha inserito uno o più appartamenti ha la possibilità di vedere le statistiche di visualizzazione per ogni appartamento inserito. 

Risultato: L'utente visualizza le statistiche dell'appartamento selezionato.
