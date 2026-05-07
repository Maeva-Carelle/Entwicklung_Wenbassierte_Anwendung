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