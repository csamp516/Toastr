<?php
/*
 *
 * Toastr.php
 *
 * @author  Chris Samperisi
 * @date    12/23/2014
 * @version 0.1
 *
 */
class Toaster {
    private $allowed_types = array(
        'slice',
        'bun',
        'roll'
    );
    private $allowed_flavors = array(
        'rye',
        'wheat',
        /*'pumpernickel',*/  // removed because toaster "NEVER toasts" pumpernickel
        'sourdough'
    );
    public function __construct() {
        echo "Toaster online. <br />";
    }
    public function toast(array $bread, Plate $plate) {
        // Remove extra pieces of bread
        $bread = array_slice($bread, 0, 2);
        // Toast the provided bread
        foreach($bread as $key=>$item) {
            echo "Slot ".($key+1)." Toasting Results: ";
            // Verify the type and flavor of bread are allowed
            $result=$this->_validate($item);
            if($result===true) {
                $item->is_toasted=true;
                echo "The ".$item->flavor." ".$item->type." was successfully toasted.";
            } else {
                echo $result;
            }
            $plate->addSlice($item);
            echo "<br />";

        }
    }
    private function _validate($slice) {

        $errors = array();
        // Verify the slice is bread
        if(!is_a($slice, "Bread")) {
             $errors[] = "The slice is not bread.";
        }
        // Verify the type of bread and flavors are allowed
        if(!in_array($slice->type, $this->allowed_types)) {
            $errors[] = "The toaster does not toast ".$slice->type." bread.";
        }
        if(!in_array($slice->flavor, $this->allowed_flavors)) {
            $errors[] = "The toaster does not toast ".$slice->flavor." bread.";
        }

        // Picky toaster validation rules
        if($slice->flavor==="sourdough"&&$slice->type==="roll") {
            $errors[] = "The toaster does not toast sourdough rolls.";
        }

        if(count($errors)===0) {
            return true;
        } else {
            return join(" ", $errors);
        }
    }
}

class Bread {
    public $is_toasted = false;
    public function __construct($type, $flavor) {
        $this->type=$type;
        $this->flavor=$flavor;
    }
}

class Plate {
    private $items = array();

    public function addSlice(Bread $slice) {
        $this->items[] = $slice;
    }
    public function countToast(){
        $toasted_count = 0;
        $untoasted_count =0;
        foreach($this->items as $item) {
            if(is_a($item, "Bread")) {
                if($item->is_toasted) {
                    $toasted_count++;
                } else {
                    $untoasted_count++;
                }
            }
        }
        echo "Toasted: " .$toasted_count. " Untoasted: ".$untoasted_count;
    }
}
// Initialize toaster and plate
$toaster = new Toaster();
$plate = new Plate();
// Toast 3 slices of bread
$toaster->toast(array(
        new Bread("roll", "rye"),
        new Bread("roll","sourdough"),
        new Bread("pumpernickel", "roll")
    ), $plate);
// Display the total toast count
$plate->countToast();