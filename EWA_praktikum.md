# Ewa Praktikum Dokumentation


# Wichtig 

- index.php ist der zentrale Router
- .htaccess leitet /baker zu index.php?url=baker
- Router.php verarbeitet url und erzeugt einen case 'baker':

This framework follows the basic MVC (Model-View-Controller) architecture.

Controller: Handles logic and user input (e.g. IndexController.php)
Model: Communicates with the database (e.g. ExampleModel.php). This is where you typically implement CRUD operations:
Create – Insert new data
Read – Fetch data
Update – Modify existing data
Delete – Remove data
View: Displays the HTML output (e.g. index.view.php)
Partials: Reusable view components like head.php and footer.php
Assets: Contains static resources like CSS, JavaScript, and images (e.g. assets/css/style.css, assets/js/script.js, assets/images/logo.png)
Create your own pages

To build your own pages, copy the structure and naming convention:

Add your route to the switch in index.php (e.g. case 'product':)
Create a new controller in the Controller folder: {Name}Controller.php
Create a view in the View folder: {name}.view.php
Optional: If your page needs database access, create a model in the Model folder: {Name}Model.php
Optional: Create new partials in the partials folder and add CSS/JS files in the assets/ folder
Route examples: /index, /about or /product (rewritten by .htaccess to index.php?url=...)

Use the navigation above to see how routing works across different endpoints.

DebugHelper example

Make sure to include DebugHelper.php with require_once before using it, then call dump($variable); to output formatted debug info in any file you want.

array(3) {
  ["example_string"]=>
  string(26) "Lorem ipsum dolor sit amet"
  ["example_int"]=>
  int(42)
  ["example_array"]=>
  array(2) {
    [0]=>
    int(1)
    [1]=>
    int(2)
  }
}
Next steps

Use this example as a starting point. Extend it with your own logic, style, views, models, controllers, routes and features by following the same MVC pattern. Enjoy building your project!



# Praktikum Nr.2


- Wo erfolgt der eigentliche Aufruf zur Erstellung einer HTML-Seite?

in der MVC- Architektur erfolgt der eigentliche Aufruf der Erstellung einer HTML-Seite in der View Klasse, welche durch die Controller Klasse initiiert wurde.




- Was tun die Methoden getData(), generateResponse() und processData()? In welcher Reihenfolge werden sie aufgerufen?
     - getData() lädt die benötigten Rohdaten direkt aus der Datenbank, dem Cache oder einer externen API
     - processData() berechnet Werte, filtert Datensätze, prüft Geschäftsregeln oder formatiert die Rohdaten für die interne Logik umgesetzt
     - generateResponse() bereitet die verarbeitenden Model-Daten für den Aufrufer ( den Controller) vor. Das Model erzeugt keine finale HTML- Ansicht, sondern liefert strukturierte Daten

- Was passiert im Controller, Model und View?

"Model" interagiert mit der Datenbank, speichert und verwaltet Anwedungsdaten und implementiert die Geschäftslogik
    - Das Model ist das Gehirn der Anwendung. Es denkt, aber es redet nicht mit dem Nutzer.
    - CRUD wird hier umgesetzt ( Create, Read, Update, Delete)
"View" erzeugt die Darstellung der Daten mit HTML
    - Die View ist das Schaufenster. Sie zeigt, was im Lager (Model) liegt.
    - z.B Darstellung von Daten aus einer Datenbank als HTML-Seite ( z.B Produktliste)
"Controller" verarbeitet Benutzeranfragen ( HTTP-Request), ruft die passenden Model-Methoden auf und wählt die View zur Ausgabe
    - Der Controller ist der Dirigent und sorgt dafür, dass alle zusammen spielen.
    - vermittelt zwischen Model ( Daten + Logik) und View ( Darstellung)
    - nimmt Benutzeranfragen ( HTTP-Requests) entgegen
    - liest Eingaben aus ( GET, POST, Formular-, URL- oder API-Daten)
    - wählt die View aus und übergibt die aufbereiteten Daten

- Was sind Partials?
 Partials sind kleine wiederverwendbare Code-Snippets einer View und enthalten sich wiederholende Layout-Elemente
 z.B Head, Header, Navigation etc
    - das führt zu weniger doppeltem Code 

- Wie funktioniert das Routing?
   - 1) URL-Umschreibung (.htaccess): ein Benutzer ruft seite.de/about auf -> Apache Webserver (über die .htacess) leitet diese Anfrage im Hintergrund um zu: index.phph?url=about -> der Benutzer sieht davon nichts, für ihn bleibt die URL "clean"
   - 2) die Router Klasse _ $router= new Router; liest diesen ?url=- Parameter aus ( über $_GET['url]) und bereinigt ihn, $router -> getRoute() gibt genau diesen String ( z.B 'about', 'order' oder einen leeren String für die Startseite) zurück
   - 3) Der Dispatcher ( switch statement):  switch statement prüft das Ergebnis, findet es einen Match lädt es die spezifische Datei ( require once..) und instanziiert den passenden Controller (new AboutController())
   - 4) Die Ausführung: am ende wird $controller->handleRequest(); aufgerufen. Ab diesem Punkt übernimmt der jeweilige Controller die komplette Logik ( Model-Aufrufe, View-Rendering)


- PRG-Pattern ( Post-Redirect-Get)
    - nach dem Absenden eines Formulars (POST) erfolgt keine direkte Ausgabe, sondern eine Weiterleitung 
    - der Browser führt anschließend einen GET-Request zur Zielseite aus.
    - verhindert das erneute Absenden des Formulars beim neu laden oder Zurück-navigieren
    - sorgt für saubere URLs und bessere Benutzerführung
    - wird verwendet bei Formularverarbeitung mit Datenänderung
    - hat den Vorteil, das es eine klare Trennung zwischen Verarbeitung und Anzeige


# MVC Zusammenfassung

1. Client schickt eine Anfrage (Request) an einen Endpunkt
2. Controller empfängt den Request
3. Controller entscheidet, was passieren soll
4. Controller ruft möglicherweise das Model auf
5. Model verarbeitet die Daten und interagiert mit der Datenbank à CRUD
6. Model gibt Daten zurück an den Controller
7. Controller übergibt die Daten an View
8. View rendert die Darstellung à HTML & Partials
9. Response wird an den Client zurückgeschickt




## Routing

- .htaccess Datei : leitet alle Anfragen zentral über eine einzige Datei ( index.php) und schützt gleichzeitig sensible Systemdaten
- 1) Aktivierung des Routing Models, aktiviert die mod_rewrite Engine von Apache, ohne diesen Befehl ignoriert der Server alle nachfolgenden Regeln
- 2) Sicherheits-Sperre für den System Ordner, blockiert jeglichen direkten Aufruf des Ordnders /App über den Browser ( z.B ihredomain.de/App/Models/User.php), [F]: sendet sofort den Fehler 403 Forbitten an den Angreifer oder Besucher, [L]: stoppt die Verarbeitung. Weitere Regeln werden für diesen Aufruf ignoriert. Der Server selbst (PHP) darf intern weiterhin auf diesen Ordner zugreifen
- 3) Ausnahme für existierende Dateien und Bilder: Diese Bedingungen prüfen, ob der eingegebene Pfad eine echte Datei ( !-f) oder ein echter Ordner (!-d) auf dem Server ist -> Wenn jemand eine existierende Bilddatei oder ein echtes CSS Stylesheet aufruft, greift die nächste Regel nicht. Die Datei wird direkt geladen
- 4) das zentrale Routing: wenn die Bedinungen erfüllt sind ( keine echte Datei), wird jede Anfrage im Hintergrund an die index.php übergeben, z.B aus seite.de/profil/bearbeiten wird intern index.php?url=profil/bearbeiten, [QSA] steht für Query String Append und es sorgt dafür, dass zusätzliche Parameter( wie ?id=5) nicht verloren gehen, sondern an das Ende angehängt werden ( index.php?url=profil/bearbeiten&id=5), [L]: beendet die Regelverarbeitung für diesen Durchlauf



# Datenfluss einer Bestellung

1. Kunde bestellt auf /order
   ↓
2. Bestellung wird in Datenbank gespeichert (ordering + ordered_article)
   ↓
3. Redirect zu /customer?message=success
   ↓
4. CustomerController lädt alle Bestellungen aus DB
   ↓
5. customer.view.php zeigt Bestellungen MIT STATUS an
   ↓
6. Bäcker ändert Status auf /baker
   ↓
7. Kunde sieht aktualisierten Status auf /customer 

## Status Workflow

1. Kunde bestellt → Status: 0 (In Vorbereitung)
   ↓
2. Bäcker ändert → Status: 1 (Fertig)
   ↓
3. Fahrer sieht Bestellung (Status >= 1)
   ↓
4. Fahrer ändert → Status: 2 (Unterwegs/Geliefert)
   ↓
5. Fahrer löscht → Bestellung wird aus DB entfernt ✅