<?php

require "../php/EssentialClasses.php";

$proposal_column = null;


echo Proposal_Formatter::add_id_to_proposal(20, $proposal_column);



// function add_id_to_proposal($id, $proposal_array){

//     if($proposal_array == null){
//         return StringManipulate::wrap_square_bracket($id);
    
//     }else{
//         $id_array = explode(',' , StringManipulate::unwrap_square_bracket($proposal_array));

//         $id_array[] = $id;

//         $new_id_array_string = "";

//         for($i = 0; $i < count($id_array); $i++){

//             $new_id_array_string = $new_id_array_string . strval($id_array[$i]) . ",";
//         }

//         $new_string = substr($new_id_array_string, 0, strlen($new_id_array_string)-1);

//         return StringManipulate::wrap_square_bracket($new_string);



//     }
// }














?>