<?php
require "../php/EssentialClasses.php";

$proposals = "[25,27,29]";

$formated_proposals = explode(',',  StringManipulate::unwrap_square_bracket($proposals));

$item_remove = array(27);

$formated_proposals = array_diff($formated_proposals, $item_remove);



print_r($proposals);

echo "<br>";

print_r($formated_proposals);

echo "<br>";

$imploded_ids = implode(",",$formated_proposals);

echo $imploded_ids;


?>