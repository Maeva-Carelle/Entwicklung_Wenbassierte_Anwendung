

# Ewa Praktikum Dokumentation

---

# Wichtig

* index.php ist der zentrale Router
* .htaccess leitet /baker zu index.php?url=baker
* Router.php verarbeitet url und erzeugt einen case 'baker':

This framework follows the basic MVC (Model-View-Controller) architecture.

---

## MVC Grundlagen

**Controller:** Handles logic and user input (e.g. IndexController.php)
**Model:** Communicates with the database (e.g. ExampleModel.php). This is where you typically implement CRUD operations:
Create – Insert new data
Read – Fetch data
Update – Modify existing data
Delete – Remove data

**View:** Displays the HTML output (e.g. index.view.php)

**Partials:** Reusable view components like head.php and footer.php

**Assets:** Contains static resources like CSS, JavaScript, and images (e.g. assets/css/style.css, assets/js/script.js, assets/images/logo.png)

---

## Create your own pages

To build your own pages, copy the structure and naming convention:

* Add your route to the switch in index.php (e.g. case 'product':)
* Create a new controller in the Controller folder: {Name}Controller.php
* Create a view in the View folder: {name}.view.php
* Optional: If your page needs database access, create a model in the Model folder: {Name}Model.php
* Optional: Create new partials in the partials folder and add CSS/JS files in the assets/ folder

Route examples: /index, /about or /product (rewritten by .htaccess to index.php?url=...)

Use the navigation above to see how routing works across different endpoints.

---

## DebugHelper example

Make sure to include DebugHelper.php with require_once before using it, then call dump($variable); to output formatted debug info in any file you want.

Example output:

```
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
```

---

# Praktikum Nr.2

---

## Wo erfolgt der eigentliche Aufruf zur Erstellung einer HTML-Seite?

In der MVC-Architektur wird die HTML-Ausgabe in der View erzeugt, aber der Prozess wird durch den Controller gestartet.
Der Controller ruft die View über eine Render-Funktion (z. B. renderHtml()) auf und übergibt die benötigten Daten.

---

## Was tun die Methoden getData(), generateResponse() und processData()? In welcher Reihenfolge werden sie aufgerufen?

* **processData()** verarbeitet POST-Daten, führt Aktionen aus und validiert Eingaben (z. B. Formulare, Statusänderungen)
* **getData()** lädt die benötigten Daten aus der Datenbank, dem Cache oder externen Quellen
* **generateResponse()** übergibt die Daten an die View und rendert die finale HTML-Ausgabe

**Reihenfolge:**

1. processData() → verarbeitet POST/Actions
2. getData() → lädt Daten
3. generateResponse() → rendert View

---

## Was passiert im Controller, Model und View?

**Model:**
Das Model kapselt die gesamte Datenlogik und übernimmt alle Datenbankoperationen (CRUD). Es enthält keine Darstellung und keine HTTP-Logik.

* Create, Read, Update, Delete werden hier umgesetzt
* Das Model ist ausschließlich für Daten und Geschäftslogik zuständig

**View:**
Die View ist ausschließlich für die Darstellung zuständig. Sie enthält HTML und zeigt die vom Controller bereitgestellten Daten an.

* Keine Datenbankzugriffe
* Keine Geschäftslogik

**Controller:**
Der Controller verarbeitet HTTP-Requests, steuert den Ablauf und verbindet Model und View.

* Nimmt Benutzeranfragen entgegen
* Liest GET/POST Daten
* Ruft Model-Methoden auf
* Wählt die passende View aus und übergibt Daten

---

## Was sind Partials?

Partials sind wiederverwendbare View-Bausteine, die wiederkehrende Layout-Elemente enthalten.

Beispiele:

* Header
* Head
* Navigation
* Footer

Vorteil: weniger Code-Duplikation und bessere Struktur.

---

## Wie funktioniert das Routing?

1. **URL-Umschreibung (.htaccess):**
   Aufrufe wie seite.de/about werden intern umgeleitet zu index.php?url=about

2. **Router-Klasse:**
   Die Router-Klasse liest den Parameter $_GET['url'] und bereinigt ihn.
   Beispiel: $route = $router->getRoute();

3. **Dispatcher (switch-case):**
   Der Router entscheidet anhand der Route, welcher Controller geladen wird.

4. **Ausführung:**
   Am Ende wird $controller->handleRequest() aufgerufen und der Controller übernimmt die komplette Verarbeitung.

---

## PRG-Pattern (Post-Redirect-Get)

* Nach einem POST-Request erfolgt eine Weiterleitung (Redirect)
* Danach folgt ein GET-Request
* Verhindert doppelte Formulareinsendungen beim Neuladen
* Trennt Verarbeitung und Darstellung sauber

---

## MVC Zusammenfassung

1. Client sendet Request
2. Controller empfängt Request
3. Controller entscheidet über Ablauf
4. Controller ruft Model auf (optional)
5. Model verarbeitet Daten (CRUD)
6. Model gibt Daten zurück
7. Controller übergibt Daten an View
8. View erzeugt HTML
9. Response wird zurückgesendet

---

## Routing (Detail)

* .htaccess leitet alle Requests an index.php weiter
* schützt interne Ordner wie /App vor direktem Zugriff

1. mod_rewrite aktiviert Apache Routing
2. Zugriff auf /App wird blockiert (403 Forbidden)
3. Dateien und Ordner werden direkt ausgeliefert, wenn sie existieren
4. Alle anderen Requests gehen an index.php

   * QSA sorgt dafür, dass GET-Parameter erhalten bleiben

---

## Datenfluss einer Bestellung

1. Kunde bestellt auf /order
2. Bestellung wird in ordering + ordered_article gespeichert
3. Redirect zu /customer?message=success
4. CustomerController lädt Daten aus DB
5. customer.view zeigt Bestellungen inkl. Status
6. Bäcker ändert Status
7. Fahrer sieht nur „fertige“ Bestellungen
8. Kunde sieht aktualisierte Daten

---

## Status Workflow

1. Kunde bestellt → Status 0 (In Vorbereitung)
2. Bäcker setzt Status → 1 (Fertig)
3. Fahrer sieht Bestellungen (Status >= 2 je nach Logik)
4. Fahrer setzt Status → 3 (Unterwegs / ausgeliefert)
5. Bestellung wird nach Lieferung gelöscht

| Status   | Bedeutung                  | Verantwortlich                 |
| -------- | -------------------------- | ------------------------------ |
| 0        | Bestellt                   | Kunde (beim Bestellen gesetzt) |
| 1        | In Vorbereitung            | Bäcker                         |
| 2        | Fertig                     | Bäcker                         |
| 3        | Unterwegs / Lieferung      | Fahrer                         |
| gelöscht | ausgeliefert               | Fahrer (Delete in DB)          |
