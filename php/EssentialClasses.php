<?php


// NEW CLASSES

use function PHPSTORM_META\map;

class DistanceDuration{

    public static function  calculateDistanceDuration($OriginCity, $DistinationCity) {

        $Distance_Duration = array();

        $openRouteServiceApiKey = '5b3ce3597851110001cf62482d63e1d674184ffeaf70166c4c846223';

        // Replace OPENCAGE_API_KEY with your OpenCage Geocoding API key
        $openCageApiKey = '88accf2c52d04a86bfecfacfcac45fbe';
        
        // Replace originCity, originCountry, destinationCity, destinationCountry with your city and country names
        $originCity = $OriginCity;
        $originCountry = 'Philippines';
        $destinationCity = $DistinationCity;
        $destinationCountry = 'Philippines';
        
        // Function to get coordinates using OpenCage Geocoding API
        function getCoordinates($city, $country, $apiKey) {
            $cityCountry = urlencode($city . ', ' . $country);
            $geocodingUrl = "https://api.opencagedata.com/geocode/v1/json?q=$cityCountry&key=$apiKey";
            $response = file_get_contents($geocodingUrl);
            $data = json_decode($response, true);
            return [
                'lat' => $data['results'][0]['geometry']['lat'],
                'lng' => $data['results'][0]['geometry']['lng']
            ];
        }
        
        // Get coordinates for origin and destination
        $originCoordinates = getCoordinates($originCity, $originCountry, $openCageApiKey);
        $destinationCoordinates = getCoordinates($destinationCity, $destinationCountry, $openCageApiKey);
        
        // Build the OpenRouteService API request URL
        $requestUrl = "https://api.openrouteservice.org/v2/directions/driving-car?api_key=$openRouteServiceApiKey&start=${originCoordinates['lng']},${originCoordinates['lat']}&end=${destinationCoordinates['lng']},${destinationCoordinates['lat']}";
        
        // Make the API request
        $response = file_get_contents($requestUrl);
        
        // Decode the JSON response
        $data = json_decode($response, true);
        
        // Check if the request was successful
        if (isset($data['features'][0]['properties']['segments'][0]['distance'])) {
            // Extract distance information
            $distance = $data['features'][0]['properties']['segments'][0]['distance'];
            $duration = $data['features'][0]['properties']['segments'][0]['duration'];
        
            // Output the distance
            // echo "Distance: $distance meters\n";
            // echo "Duration: $duration duration\n";

            $duration_seconds = $duration;

            // Calculate hours, minutes, and seconds
            $hours = floor($duration_seconds / 3600);
            $minutes = floor(($duration_seconds % 3600) / 60);
            $seconds = $duration_seconds % 60;

            // Format the result
            $time_format = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);


            $time_duration =  $time_format;


            $Distance_Duration[] = $distance;
            $Distance_Duration[] = $time_duration;


            
        } else {
            // Handle API error
            echo "Error: Unable to retrieve distance\n";
        }


        return $Distance_Duration;
    
    }

}


class SERVER {
    private $host = "localhost"; // 127.0.0.1
    private $username = "root";
    private $password = "NewphpMyAdmin2307";
    private $database = null;
    private $table = null;


    private $ServerConnection = null;


    public function __construct($database_name, $table_name)
    {
        $this->database = $database_name;
        $this->table = $table_name;
    }

    public function get_localhost(){
        return $this->host;
    }

    public function get_username(){
        return $this->username;
    }

    public function get_password(){
        return $this->password;
    }

    public function get_database(){
        return $this->database;
    }
    
    public function get_table(){
        return $this->table;
    }

    public function get_ServerConnection(){
        return $this->ServerConnection;
    }

    public function Server_Conn(){
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);


        if($conn->connect_error){
            die("Connection Failed." . $conn->connect_error); 
        }
        else{
            $this->ServerConnection = $conn;
        }

    }

}


class Post{

    //data fields from post_img table
    private $post_ID = null;
    private $User_Id = null;
    private $email = null;
    public $itemName = null;
    public $imageArray = null;
    public $item_condition = null;
    public $category = null;
    public $description = null;
    public $payment_method = null;   //create a function to handle the transaction method, this will trigger the logic flow of the Post
    public $price = null;
    public $proposals_ids_array = null;
    public $exchange_method = null;
    public $date = null;
    public $time = null;
    public $transaction_id;
    public $tableOrientation = "post_img";

    // this variable holds the array of object in instance of the offer table in database
    


    //object that contains the data from users_information table
    public $userInformation = null;


    //constructor for class attributes

    public function __construct($postID, $user_Id, $email, $itemName, $imageArray, $item_condition, $category, $description, $payment_method, $price, $proposals_ids_array, $exchange_method, $date, $time, $transaction_id)
    {
        $this->post_ID = $postID;
        $this->User_Id = $user_Id;
        $this->email = $email;
        $this->itemName = $itemName;
        $this->imageArray = $imageArray;
        $this->item_condition = $item_condition;
        $this->category = $category;
        $this->description = $description;
        $this->payment_method = $payment_method;
        $this->price = $price;
        $this->proposals_ids_array = $proposals_ids_array;
        $this->exchange_method = $exchange_method;
        $this->date = $date;
        $this->time = $time;
        $this->transaction_id = $transaction_id;
        


        //this function process the imagaArray attribute for formatting the imagenames ready for displaying
        $this->set_imageArray_format_ready();

        
    }

    public function get_post_id(){
        return $this->post_ID;
    }
    
    public function get_email(){
        return $this->email;
    }

    public function set_UserInformation($userInforamation)
    {
        $this->userInformation = $userInforamation;
    }

    public function get_UserInformation(){
        return $this->userInformation;
    }

    public function set_imageArray_format_ready(){

        $this->imageArray = StringManipulate::format_String_ImageArray_To_ArrayString($this->imageArray);

    }

    public function Dispay_Item_Images($img_class_value){

        for($i = 0; $i < count($this->imageArray); $i++){
            echo "<img class=\"\"" . $img_class_value . "src="."image-files/" . $this->imageArray[$i] ." style="."max-width:550px; max-height: 300px;>";
        }
    }

    public function Display_Item_Thumbnail(){
        
        return $this->imageArray[0];
    }

    public function NumberOfItemImages(){
        return count($this->imageArray);
    }


    public function shortening_description(){
     if($this->description == null){
        return "No description";
     }
     else{

        if(strlen($this->description)  <= 80){
                return $this->description;
        }
        else{
             return substr($this->description, 0, 100) . "..." ;   
        }


     }


    }

 
}


class UserInformation {
    private $user_Id = null;
    public $Email = null;
    public $UserName = null;
    public $Address = null;
    public $City = null;
    public $Mobile_number = null;
    public $Rating = null;

    public function __construct($user_Id, $Email, $Username, $Address, $City, $Mobile_number, $Rating)
    {   
        $this->user_Id = $user_Id;
        $this->Email = $Email;
        $this->UserName = $Username;
        $this->Address = $Address;
        $this->City = $City;
        $this->Mobile_number = "+63 " . $Mobile_number;
        $this->Rating = $Rating;
    }

    public function user_Id(){
        return $this->user_Id;
    }

    public function get_UserName(){
        return $this->UserName;
    }

    public function get_City(){
        return $this->City;
    }

}

class TransactionDetails{
    public $id;
    public $sender_id;
    public $receiver_id;
    public $transaction_mode;
    public $date_of_shipment;
    public $arrival_date;
    public $shipping_time;
    public $arrival_time;
    public $status;
    public $chat;

    public function __construct($row)
    {
        $this->id = $row['id'];
        $this->sender_id = $row['sender_id'];
        $this->receiver_id = $row['receiver_id'];
        $this->transaction_mode = $row['transaction_mode'];
        $this->date_of_shipment = $row['date_of_shipment'];
        $this->arrival_date = $row['arrival_date'];
        $this->shipping_time = $row['shipping_time'];
        $this->arrival_time = $row['arrival_time'];
        $this->status = $row['status'];
        $this->chat = $row['chat'];

    }


}


class OfferPool{
    private $id = null;
    public $selectedpost_id = null;
    public $Email = null;
    public $User_Id = null;
    public $ItemName = null;
    public $Category = null;
    public $item_Condition = null;
    public $Method = null;
    public $Price = null;
    public $Description = null;
    public $images = null;
    public $Date = null;
    public $Time = null;
    public $Status = null;
    public $tableOrientation = "offer_pool";


    public function __construct($id, $selectedpost_id, $User_Id, $Email, $ItemName, $Category, $item_Condition, $Method, $Price, $Description, $images, $Date, $Time, $Status)
    {
        $this->id = $id;
        $this->selectedpost_id = $selectedpost_id;
        $this->User_Id = $User_Id;
        $this->Email = $Email;
        $this->ItemName = $ItemName;
        $this->Category = $Category;
        $this->item_Condition = $item_Condition;
        $this->Method = $Method;
        $this->Price = $Price;
        $this->Description = $Description;
        $this->images = $images;
        $this->Date = $Date;
        $this->Time = $Time;
        $this->Status = $Status;
        

        //this fucntion makes the images as array of images names
        $this->set_images_format_ready();
        
    }

    public function get_offer_id(){
        return $this->id;
    }

    public function set_images_format_ready(){
        $this->images = StringManipulate::format_String_ImageArray_To_ArrayString($this->images);
    }

    public function Display_Item_Thumbnail(){
        
        return $this->images[0];
    }

}

class StatusTradeCoinArray{
    public $trade_coin_offer = array();
    public function add_Offer($Object){
        $this->trade_coin_offer[] = $Object;
    }

    public function size(){
        return count($this->trade_coin_offer);
    }

    public function get_OfferObject_at_index($i){
        return $this->trade_coin_offer[$i];
    }
}


class TradeCoinOffer {
    public $index;
    public $Offer_Object;
    
    public function __construct($index, $Object)
    {
        $this->index = $index;
        $this->Offer_Object = $Object;
        
    }

}


class TopUpOffer{
    public $index;
    public $Offer_Object;
    
    public function __construct($index, $Object)
    {
        $this->index = $index;
        $this->Offer_Object = $Object;
        
    }

}





class Account_Balance {
    private $id;
    public $balance;

    public function __construct($id, $balance)
    {
        $this->id = $id;
        $this->balance = $balance;
        
    }

    public function get_balance(){
        return $this->balance;
    }


}


class CoinBalance{
    private $id = null;
    private $current_balance = null;

    public function __construct($id)
    {
        $this->id = $id;
        
        $this->accountBalance();

    }

    public function accountBalance(){

        $MyServer = new SERVER("projectdb", "account_balance");
        $MyServer->Server_Conn();
        $sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE = " . $this->id ;

        $result = $MyServer->get_ServerConnection()->query($sql);

        $this->current_balance = PostObjectTools::AccountBalanceRows_to_AccountBalanceObjectArray($result)[0]->get_balance();

    }

    public function get_CurrentBalance(){
        return $this->current_balance;
    }

}

class BalanceChecker{
    private $balance_availability;
    private $Email;
    private $itemAmount;
    private $currentBalance;

    public function __construct($email, $itemAmount)
    {
        $this->Email = $email;
        $this->itemAmount = $itemAmount;

        $this->validate_balance();
        
    }

    private function validate_balance(){
        $MyServer = new SERVER("projectdb", "account_balance");
        $MyServer->Server_Conn();
        $sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE  `Email` =" . StringManipulate::wrap_string_qoutation($this->Email) ;

        $result = $MyServer->get_ServerConnection()->query($sql);

        $this->currentBalance = PostObjectTools::AccountBalanceRows_to_AccountBalanceObjectArray($result)[0]->get_balance();

        if($this->currentBalance >= $this->itemAmount){
            $this->balance_availability = true;
        }else{
            $this->balance_availability = false;
        }

    }

    public function get_balance_validation(){
        return $this->balance_availability;
    }

    public function get_CurrentBalance(){
        return $this->currentBalance;
    }

}


class StringManipulate{
    public static function wrap_string_qoutation($String){

        return "\"" . $String . "\"";

    }

    public static function unwarpped_string_qoutation($String){
        return str_replace('"', '', $String);

    }

    public static function wrap_string_single_quatation($String){
        return "\'" . $String . "\'" ;
    }

    public static function wrap_string_backticks($String){
        return "`" . $String . "`";
    }

    public static function unwrap_square_bracket($String){
        
        $new_string = str_replace('[', "", $String);

        $new_string = str_replace(']', "", $new_string);

        return $new_string;


    }

    public static function wrap_square_bracket($String){
        return "[" . $String . "]";
    }

    public static function wrap_OpenClose_paranthesis($String){
        return "(" . $String . ")";
    }

    public static function unwarpped_OpenClose_parenthesis($String){
        $new_string = str_replace('(', "", $String);

        $new_string = str_replace(')', "", $new_string);

        return $new_string;
    }
    

    //takes an array argument of image names from the database
    public static function format_String_ImageArray_To_ArrayString($original_ImageArray){
        
        $original_ImageArray = str_replace("[", "", $original_ImageArray);
        $original_ImageArray = str_replace("]", "", $original_ImageArray);

        $imageNamesArray = explode(",",$original_ImageArray);

        for($i = 0; $i < count($imageNamesArray); $i++){

            $imageNamesArray[$i] = self::unwarpped_string_qoutation($imageNamesArray[$i]);
            
        }

        return $imageNamesArray;

    }
}





class PostObjectTools{
    public static function PostRows_to_PostObjectArray($result){
        $PostObjectArray = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                //turning the rows data into PostObjectArray that holds tha data from post_img table

                $PostObjectArray[] = new Post($row['id'], $row['User_Id'], $row['Email'], $row['name'], $row['image'], $row['Item_Condition'], $row['category'], $row['description'], $row['payment_method'], $row['price'], $row['Proposals'], $row['exchange_method'], $row['Date'], $row['Time'], $row['transaction_id']);
            }
        
            return $PostObjectArray;

        }else{
            return $PostObjectArray = null;
        }

    }

    
    public static function UserInfoRows_to_UserInfoObjectArray($result){
        $UserInfoObjectArray = array();
        

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                $UserInfoObjectArray[] = new UserInformation($row['Id'], $row['Email'], $row['_Name'], $row['_Address'], $row['City'], $row['Mobile_number'], $row['Rating']);

            }

            return $UserInfoObjectArray;
        }else{
            return $UserInfoObjectArray = null;
        }
    }

    public static function OfferPoolRows_to_OfferPoolObjectArray($result){
        $OfferPoolObjectArray = array();


        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                $OfferPoolObjectArray[] = new OfferPool($row['id'], $row['selectedpost_id'], $row['User_Id'],  $row['Email'], $row['ItemName'], $row['Category'], $row['item_Condition'], $row['Method'], $row['Price'], $row['Description'], $row['images'], $row['Date'], $row['Time'], $row['status']);
                

            }

            return $OfferPoolObjectArray;
            
        }else{
            return $OfferPoolObjectArray = null;
        }

    }

    public static function TransactionDetailsRows_to_TransactionDetailsObjectArray($result){
        $TransactionDetailsArray = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                $TransactionDetailsArray[] = new TransactionDetails($row);
            }
            
            return $TransactionDetailsArray;

        }else{
            return $TransactionDetailsArray = null;
        }
    }

    public static function AccountBalanceRows_to_AccountBalanceObjectArray($result){

        $AccountBalanceObjectArray = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                $AccountBalanceObjectArray[] = new Account_Balance($row['id'], $row['balance']);

            }

            return $AccountBalanceObjectArray;

        }else{
            return $AccountBalanceObjectArray = null;
        }

    }

}


//this class handles the possible combination of filter parameters 

class CustomizedQuery{

    private $boolean_filters;
    private $FILTER_FORM;

    public function __construct($FILTER_FORM)
    {
        $this->FILTER_FORM=$FILTER_FORM;
        $binary_filters = array();

        if($FILTER_FORM->Method != null){
            $this->boolean_filters .= "1";
        }
        else{
            $this->boolean_filters .= "0";
        }

        if($FILTER_FORM->Category != null){
            $this->boolean_filters .= "1";
        }
        else{
            $this->boolean_filters .= "0";
        }

        if($FILTER_FORM->Rating != null){
            $this->boolean_filters .= "1";
        }
        else{
            $this->boolean_filters .= "0";
        }
        
    }


    public function get_boolean_filters(){
        return $this->boolean_filters;
    }

    public function auto_query_selection(){

        switch($this->boolean_filters){

            //one filter on
            
            case "100":

                return "SELECT * FROM  `post_img` " . "WHERE `payment_method` =" . StringManipulate::wrap_string_qoutation($this->FILTER_FORM->Method);
                break;

            case "010":

                return "SELECT * FROM `post_img` " . "WHERE `category` =" . StringManipulate::wrap_string_qoutation($this->FILTER_FORM->Category);
                break;

            case "001":

                return "SELECT * FROM `post_img`  INNER JOIN `users_information` ON post_img.Email = users_information.Email " . "WHERE `Rating` >= " . intval($this->FILTER_FORM->Rating) . " AND `Rating` <= " . (intval($this->FILTER_FORM->Rating) + 1);  
                break;



            //two filters on
            case "110":

                return "SELECT * FROM `post_img` WHERE `payment_method` = " . StringManipulate::wrap_string_qoutation($this->FILTER_FORM->Method) . " AND `category` = " . StringManipulate::wrap_string_qoutation($this->FILTER_FORM->Category);
                break;

            case "101":

                return "SELECT * FROM `post_img` INNER JOIN `users_information` ON post_img.Email = users_information.Email WHERE `payment_method` = " . StringManipulate::wrap_string_qoutation($this->FILTER_FORM->Method) . " AND `Rating` >= " . intval($this->FILTER_FORM->Rating) . " AND `Rating` <= " . (intval($this->FILTER_FORM->Rating) + 1);
                break;

            case "011":

                return "SELECT * FROM `post_img` INNER JOIN `users_information` ON post_img.Email = users_information.Email WHERE `category` = " . StringManipulate::wrap_string_qoutation($this->FILTER_FORM->Category) . " AND `Rating` >= " . intval($this->FILTER_FORM->Rating) . " AND `Rating` <= " . (intval($this->FILTER_FORM->Rating) + 1);
                break;


            case "111":

                return "SELECT * FROM `post_img` INNER JOIN `users_information` ON post_img.Email = users_information.Email WHERE `payment_method` = " . StringManipulate::wrap_string_qoutation($this->FILTER_FORM->Method) . " AND `category` = " . StringManipulate::wrap_string_qoutation($this->FILTER_FORM->Category) . " AND `Rating` >= " . intval($this->FILTER_FORM->Rating) . " AND `Rating` <= " . (intval($this->FILTER_FORM->Rating) + 1);
                break;







        }



    }
    
}



class FILTERFORM{

    public $Status = "false";
    public $Method = null;
    public $Category = null;
    public $Rating = null;

    public function Method_check($input_value){

        if($this->Status == "true"){

            if($this->Method == $input_value){
                echo "checked";
            }

        }

    }

    public function Category_check($input_value){
        
        if($this->Status == "true"){

            if($this->Category == $input_value){
                echo "checked";
            }

        }

    }

    public function Rating_check($input_value){

        if($this->Status == "true"){

            if($this->Rating == $input_value){
                echo $input_value;
            }

        }

    }

}




class OfferTradeOnly {
    public $email;
    public $category;
    public $condition;
    public $description;

    public function __construct($email, $category, $condition, $description)
    {
        $this->email = $email;
        $this->category = $category;
        $this->condition = $condition;
        $this->description = $description;
        
    }


}

class offerTopUpTrade{
    public $email;
    public $category;
    public $condition;
    public $description;
    public $price;

    public function __construct($email, $category, $condition, $description, $price)
    {
        $this->email = $email;
        $this->category = $category;
        $this->condition = $condition;
        $this->description = $description;
        $this->price = $price;
        
    }

}

class offerTradeCoin{
    public $email;
    public $amount_offer;

    public function __construct($email, $amount_offer)
    {
        $this->$email = $email;
        $this->amount_offer = $amount_offer;
    }
}

class Proposal_Formatter{

    public static function add_id_to_proposal($id, $proposal_array){

        if($proposal_array == "None"){
            return StringManipulate::wrap_square_bracket($id);
        
        }else{

            $id_array = explode(',' , StringManipulate::unwrap_square_bracket($proposal_array));
    
            $id_array[] = $id;
    
            $new_id_array_string = "";
    
            for($i = 0; $i < count($id_array); $i++){
    
                $new_id_array_string = $new_id_array_string . strval($id_array[$i]) . ",";
            }
    
            $new_string = substr($new_id_array_string, 0, strlen($new_id_array_string)-1);
    
            return StringManipulate::wrap_square_bracket($new_string);
        }

    }


}



class ActivePost {

    private $user_id;
    public $userActivePostArray;
   
    public function __construct($user_id){

        $this->user_id = $user_id;

        //initiating the data of the post from the user id of this class instance
        $this->preprocess_Post_Retrieval();

        //initiating the indexes of the each method in array format
        // $this->distribute_indexArray();

    }

    public function preprocess_Post_Retrieval(){

        $MyServer = new SERVER("projectdb", "post_img");
        $MyServer->Server_Conn();
        $sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `User_Id` = " . $this->user_id;
        
        $result = $MyServer->get_ServerConnection()->query($sql);

        //this shuold be change to PostWithOffer
        $UserPostArray = PostObjectTools::PostRows_to_PostObjectArray($result);

        $this->userActivePostArray = $UserPostArray;

    }

}

class ActiveOffer {
    private $Email; 
    public $userActiveOfferArray;

    public function __construct($Email)
    {
        $this->Email = $Email;

        //initiating the data of the offer fromtthe Email of this class instance
        $this->preprocess_Offer_Retrieval();
        
    }

    public function preprocess_Offer_Retrieval(){

        $MyServer = new SERVER("projectdb", "offer_pool");
        $MyServer->Server_Conn();
        $sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `Email` = " . StringManipulate::wrap_string_qoutation($this->Email);

        $result = $MyServer->get_ServerConnection()->query($sql);

        $UserOfferArray = PostObjectTools::OfferPoolRows_to_OfferPoolObjectArray($result);

        $this->userActiveOfferArray = $UserOfferArray;


    }

}


class StatusTradeCoin{
    public $PostObject;
    public $OfferObjects;

    public function __construct($PostObject)
    {
        $this->PostObject = $PostObject;

        $this->initiate_OfferObjects();
        
    }


    public function initiate_OfferObjects(){

        if($this->PostObject->proposals_ids_array != "None"){

            $Offer_ids = StringManipulate::unwrap_square_bracket($this->PostObject->proposals_ids_array);
            $Offer_ids = StringManipulate::wrap_OpenClose_paranthesis($Offer_ids);



            $MyServer = new SERVER("projectdb", "offer_pool");
            $MyServer->Server_Conn();

            $MyServer_sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `id` IN " . $Offer_ids;

            $result = $MyServer->get_ServerConnection()->query($MyServer_sql);

            $this->OfferObjects = PostObjectTools::OfferPoolRows_to_OfferPoolObjectArray($result);

        }


    }
}


class StatusTopUpTrade{
    public $PostObject;
    public $OfferObjects;

    public function __construct($PostObject)
    {
        $this->PostObject = $PostObject;


        $this->initiate_OfferObjects();
    }


    public function initiate_OfferObjects(){

        if($this->PostObject->proposals_ids_array != "None"){

            $Offer_ids = StringManipulate::unwrap_square_bracket($this->PostObject->proposals_ids_array);
            $Offer_ids = StringManipulate::wrap_OpenClose_paranthesis($Offer_ids);



            $MyServer = new SERVER("projectdb", "offer_pool");
            $MyServer->Server_Conn();

            $MyServer_sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `id` IN " . $Offer_ids;

            $result = $MyServer->get_ServerConnection()->query($MyServer_sql);

            $this->OfferObjects = PostObjectTools::OfferPoolRows_to_OfferPoolObjectArray($result);

        }


    }
}


class StatusTradeOnly{
    public $PostObject;
    public $OfferObjects;

    public function __construct($PostObject)
    {
        $this->PostObject = $PostObject;


        $this->initiate_OfferObjects();
    }


    public function initiate_OfferObjects(){

        if($this->PostObject->proposals_ids_array != "None"){

            $Offer_ids = StringManipulate::unwrap_square_bracket($this->PostObject->proposals_ids_array);
            $Offer_ids = StringManipulate::wrap_OpenClose_paranthesis($Offer_ids);



            $MyServer = new SERVER("projectdb", "offer_pool");
            $MyServer->Server_Conn();

            $MyServer_sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `id` IN " . $Offer_ids;

            $result = $MyServer->get_ServerConnection()->query($MyServer_sql);

            $this->OfferObjects = PostObjectTools::OfferPoolRows_to_OfferPoolObjectArray($result);

        }


    }
}


class StatusOffer{
    public $PostObject;
    public $OfferObject;
    public $UserInfoObject;

    public function __construct($OfferObject)
    {
        $this->OfferObject = $OfferObject;

        //this function will initiate the PostObject inside of this class instance
        $this->initiatePostObject();
        
    }

    public function initiatePostObject(){

        try{
            $MyServer = new SERVER("projectdb", "post_img");
            $MyServer->Server_Conn();
            $sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `id` = " . $this->OfferObject->selectedpost_id;

            $result = $MyServer->get_ServerConnection()->query($sql);

            $Local_variable_PostObject = PostObjectTools::PostRows_to_PostObjectArray($result)[0];

            if($Local_variable_PostObject != null){
                $this->PostObject = $Local_variable_PostObject;

                $SecondServer = new SERVER("projectdb", "users_information");
                $SecondServer->Server_Conn();
                $second_sql = "SELECT * FROM " . $SecondServer->get_table() . " WHERE `Email` = " . StringManipulate::wrap_string_qoutation($this->PostObject->get_email());
    
                $second_result = $SecondServer->get_ServerConnection()->query($second_sql);
    
                $this->UserInfoObject = PostObjectTools::UserInfoRows_to_UserInfoObjectArray($second_result)[0];

            }

            
          
        }catch(Exception $e){
            //if there is no post it will raise a warning and error that im accessing array offet on valvue null;
            $this->PostObject = null;
        }


       
    }
}

class UserInfoRetriever{
    private $Email;
    public $userInforamation;

    public function __construct($email)
    {
        $this->Email = $email;
        $this->initiateUserInformation();
    }

    public function initiateUserInformation(){
        $MyServer = new SERVER("projectdb", "users_information");
        $MyServer->Server_Conn();
        $MyServer_sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `Email` = " . StringManipulate::wrap_string_qoutation($this->Email);

        $result = $MyServer->get_ServerConnection()->query($MyServer_sql);

        $this->userInforamation = PostObjectTools::UserInfoRows_to_UserInfoObjectArray($result)[0];


    }
}

class CodeGenerator{
    public static function  GenerateRandomCode($length = 6){
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
    }
}



class TimeCalcu{
    public static function Arrival_time($timenow, $time_duration){
        $TimenowHour = explode(":", $timenow)[0];
        $TimenowMinute = explode(":", $timenow)[1];

        $TimenowFormatted = (float)$TimenowHour + ((float)$TimenowMinute / 60 );
        
        
        $TimeDurationHour = explode(":", $time_duration)[0];
        $TimeDurationMinute = explode(":", $time_duration)[1];

        $TimeDurationFormatted = (float)$TimeDurationHour + ((float)$TimeDurationMinute / 60);

        $Arrival_time = number_format($TimenowFormatted + $TimeDurationFormatted, 2) ;

        

        if($Arrival_time > 24){
           $Arrival_time =  $Arrival_time - 24;

           $Arrival_time_floor = floor($Arrival_time);


           $Arrival_minute = $Arrival_time - $Arrival_time_floor;  

            return $Arrival_time_floor . ":" . ((int)($Arrival_minute * 60));

        }

        // return $Arrival_time;

        $Arrival_time_floor = floor($Arrival_time);
        $Arrival_minute = $Arrival_time - $Arrival_time_floor;

        return $Arrival_time_floor . ":" . ((int)($Arrival_minute * 60));
        
    }

    public static function CalculateTimeDif($Current_time, $Arrival_Time){

        // $Shipping_time_Hour = explode(":", $Shipping_Time)[0];
        // $Shipping_time_Minute = explode(":", $Shipping_Time)[1];
 
        // $Shipping_time_formmated = (int)$Shipping_time_Hour + ((int)$Shipping_time_Minute / 60);


        $Current_time_Hour = explode(":", $Current_time)[0];
        $Current_time_Minute = explode(":", $Current_time)[1];
        
        $Current_time_formatted = (int)$Current_time_Hour + ((int)$Current_time_Minute / 60);

        $Arrival_Time_Hour = explode(":", $Arrival_Time)[0];
        $Arrival_Time_Minute = explode(":", $Arrival_Time)[1];

        $Arrival_time_formatted = (int)$Arrival_Time_Hour + ((int)$Arrival_Time_Minute / 60);


        $Remaining_time = round(($Arrival_time_formatted - $Current_time_formatted) * 60);
        
        $Remaining_hours = $Remaining_time / 60;
        
        return $Remaining_hours;

    }

    public static function time_percentage($Shipment_Time , $Current_Time, $Arrival_Time){

        $Current_time_success = TimeCalcu::CalculateTimeDif($Current_Time, $Arrival_Time);

        $Duration_Time = TimeCalcu::CalculateTimeDif($Shipment_Time, $Arrival_Time);

        $SuccessPercent = 1 - ($Current_time_success / $Duration_Time); 

        return $SuccessPercent;

    }

    
}

class TransactionCheck{
    public static function TransactionDetailsExist($sender_id, $receiver_id){

        $MyServer = new SERVER("projectdb", "transaction_details");
        $MyServer->Server_Conn();
        $MyServer_sql = "SELECT * FROM " . $MyServer->get_table() . " WHERE `sender_id` = $sender_id AND `receiver_id` = $receiver_id";

        $result = $MyServer->get_ServerConnection()->query($MyServer_sql);

        $TransactionDetailsObject = PostObjectTools::TransactionDetailsRows_to_TransactionDetailsObjectArray($result);
        
        if($TransactionDetailsObject == null){
            return null;
        }else{
            return $TransactionDetailsObject[0];
        }

    }

    public static function ToReceivedStatus($sender_id, $receiver_id){
        $MyServer = new SERVER("projectdb", "transaction_details");
        $MyServer->Server_Conn();
        $MyServer_sql = "UPDATE " . $MyServer->get_table() . " SET status = " . StringManipulate::wrap_string_qoutation("to received") . " WHERE `sender_id` = $sender_id AND `receiver_id` = $receiver_id";
        $MyServer->get_ServerConnection()->query($MyServer_sql);

    }

    public static function ReceivedStatus($receiver_id, $sender_id){
        $MyServer = new SERVER("projectdb", "transaction_details");
        $MyServer->Server_Conn();
        $MyServer_sql = "UPDATE " . $MyServer->get_table() . " SET status = " . StringManipulate::wrap_string_qoutation("received") . " WHERE `sender_id` = $receiver_id AND `receiver_id` = $sender_id";
        $MyServer->get_ServerConnection()->query($MyServer_sql);


    }

    
}






?>