# Toastr
#### A virtual toaster with a distinguished taste and trendy name.

Chris Samperisi
12/23/2014 Version 0.1


### Getting Started

To get toasting, initialize the ````Toaster```` and ````Plate```` classes.

````php
$toaster = new Toaster();
$plate = new Plate();
````

Use Toaster's ````toast()```` method, which uses an array of bread and a plate instance as parameters.

````php
$toaster->toast(array(
    new Bread("roll", "rye"),
    new Bread("roll","sourdough"),
    new Bread("pumpernickel", "roll")
), $plate);
````

The plate's ````countToast() ```` method displays a breakdown of the toast on the plate.

````php
$plate->countToast();
````

Will display:

````Toasted: 1 Untoasted: 1````

### Changing the Rules

To change what types and flavors of toast are allowed, change the toaster's ````$allowed_types```` and ````$allowed_flavors```` array.

For example: if we wanted to add a bagel as an allowed type of bread, we would add "bagel" to the ````$allowed_types```` array.

````php
private $allowed_types = array(
    'slice',
    'bun',
    'roll',
    'bagel'
);
````

You can add more specific validation rules in the ````Toaster::_validate()```` method.