<?php

class ActionPage{

    public static function PageToDirect($method){

        $actionPage = null;

        switch($method){
            case "trade only":

                $actionPage = "new_trade_only_action.php";
                break;

            case "top-up trade":

                $actionPage = "new_topup_action.php";
                break;

            case "trade coin":

                $actionPage = "new_tradecoin_action.php";
                break;

            default:

                return $actionPage;
        }


        return $actionPage;

    }


}

class MyDateTime {
    public static function DateNow(){
        date_default_timezone_set('Asia/Manila');

        return date('m-d-Y');
    }

    public static function TimeNow(){
        date_default_timezone_set('Asia/Manila');

        return date("H:i:s");
    }

    public static function hello(){
        return "helloworld";
    }
}


class StarBadge{
    public static function ReturnBadge($rating){

        do{
        
            if($rating >= 1){
                StarBadge::fullstar();
            }elseif($rating >= 0.5 && $rating <= 1 ){
                StarBadge::halfstar();
            }

            $rating-= 1;

        }while($rating > 0);

    }
    private static function fullstar(){
        echo "<img src=\"assets/star_icon.png\" style=\"width:40px; height:40px; margin-left:3px; margin-right:3px;\" >";
    }
    private static function halfstar(){
        echo "<img src=\"assets/star_icon_half.png\" style=\"width:40px; height:40px; margin-left:3px; margin-right:3px;\" >";
    }
}


?>