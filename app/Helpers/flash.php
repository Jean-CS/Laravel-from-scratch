<?php

// To load this file and its functions, you need to add
// "files": [
//     "app/helpers.php"
// ]
// to composer.json on "autoload": [...]
// And run '$ composer dump-autoload'
function flash($message, $class = 'info'){
    session()->flash('alert_message', $message);
    session()->flash('alert_class', $class);
}

?>
