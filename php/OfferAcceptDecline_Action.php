<?php
require "EssentialClasses.php";
session_start();

if(isset($_POST['accept_submit'])){
    //control flow for accepted offer


    //getting the proposal_ids of this selectedpost_ids

    $MyPostServer = new SERVER('projectdb', "post_img");
    $MyPostServer->Server_Conn();
    $MyPostServer_sql = "SELECT * FROM " . $MyPostServer->get_table() . " WHERE `id` = " . $_POST['selectedpost_id'];

    $Postresult = $MyPostServer->get_ServerConnection()->query($MyPostServer_sql);

    $PostObject = PostObjectTools::PostRows_to_PostObjectArray($Postresult)[0];

    $proposal_sql_place_offer_id = "UPDATE " . $MyPostServer->get_table() . " SET `Proposals` = " .  
    StringManipulate::wrap_string_qoutation(StringManipulate::wrap_square_bracket($_POST['offer_id'])) .  
    " WHERE `id` = " . $_POST['selectedpost_id'];

    $MyPostServer->get_ServerConnection()->query($proposal_sql_place_offer_id);



    $proposals_id = explode(',',StringManipulate::unwrap_square_bracket($PostObject->proposals_ids_array));

    //this variable holds the values of proposals_ids of the selected id post from the post_img table
    $proposals_id_array_tobe_decline = array_diff($proposals_id, array((int)$_POST['offer_id']));

    

    

    $proposals_id_array_tobe_decline = StringManipulate::wrap_OpenClose_paranthesis(implode(",",  $proposals_id_array_tobe_decline));

    try{
      
        $MyServerDeclining = new SERVER('projectdb', "offer_pool");
        $MyServerDeclining->Server_Conn();
        // $MyServerDeclining_sql = "UPDATE " . $MyServerDeclining->get_table() . " SET `status` = " . StringManipulate::wrap_string_qoutation("DECLINED") ." WHERE `id` IN " . $proposals_id_array_tobe_decline;
        $MyServerDeclining_sql = "UPDATE " . $MyServerDeclining->get_table() . " SET `status` = " . StringManipulate::wrap_string_qoutation("DECLINED") ." WHERE `id` IN " . $proposals_id_array_tobe_decline;
        echo  $MyServerDeclining_sql;
        echo $_POST['selectedpost_id'];
        $MyServerDeclining->get_ServerConnection()->query($MyServerDeclining_sql);
    
    }catch(Exception $e){
        echo "proposals_ids_array_tobe_decline is array with no element, the cause of query error";
    }
    
    




    //Update the status of the offer to ACCEPTED

    $MyServer = new SERVER("projectdb", "offer_pool");
    $MyServer->Server_Conn();
    $MyServer_sql = "UPDATE " . $MyServer->get_table() . " SET `status` = " . StringManipulate::wrap_string_qoutation("ACCEPTED") . " WHERE `id` = " . $_POST['offer_id'];
    
    $MyServer->get_ServerConnection()->query($MyServer_sql);






    


    header("Location: ../status.php");






}elseif(isset($_POST['decline_submit'])){
    //control flow for declined offer







    $MyServer = new SERVER("projectdb", "offer_pool");
    $MyServer->Server_Conn();
    $MyServer_sql = "UPDATE " . $MyServer->get_table() . " SET `status` = " . StringManipulate::wrap_string_qoutation("DECLINED") . " WHERE `id` = " . $_POST['offer_id'];
    
    $MyServer->get_ServerConnection()->query($MyServer_sql);





    header("Location: ../status.php");
}

?>