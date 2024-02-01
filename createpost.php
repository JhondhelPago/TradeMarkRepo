<?php
session_start();
$email = isset($_SESSION['valid']) ? $_SESSION['valid'] : 'No email foud';


?>


<?php 

require "php/config.php";
            
    $id = $_SESSION['id'];
    $query = mysqli_query($con,"SELECT*FROM users_information WHERE Id=$id");

    while($result = mysqli_fetch_assoc($query)){
        $res_Uname = $result['_Name'];
        $res_Email = $result['Email'];
        $res_Age = $result['Age'];
        $res_id = $result['Id'];
    }
    
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="createPost.css">
    <title>Create Post</title>
    <link rel="icon" type="image/x-icon" href="PRIMARY_game-icons_cardboard-box-closed.svg">
    <link rel="stylesheet" href="css/createpost_styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img class="logoIcon" src="WHITE_game-icons_cardboard-box-closed.svg" alt="logo"/>
            <div class="logoName">TradeMark</div>
        </div>
        <nav>
            <ul>
                <a href="newhome.php">Home</a>
                <a href="">Status</a>
                <a href=" <?php echo "edit.php?Id=$res_id" ?>">User</a>
            </ul>
        </nav>
        <a href="" class="profileBtn">
            <div class="overlap-group">
                <div class="ellipse"></div>
                <img class="frame" src="profileSvg.svg" />
            </div>
        </a>
    </header>

    <section class="content">
        <h2>Create Post</h2>
        <div class="container">
            <form enctype="multipart/form-data" method="post" action="php/CreatePost_serverscript.php" class="formContent" >
                <div class="chooseMethod">
                    <label for="tradeOnly">
                        <input type="radio" name="method" id="tradeOnly" value="trade only" required>
                        Trade Only
                    </label>
                    <label for="topupTrade">
                        <input type="radio" name="method" id="topupTrade" value="top-up trade" required>
                        Top-up/Trade
                    </label>
                    <label for="tradeCoin">
                        <input type="radio" name="method" id="tradeCoin" value="trade coin" required>
                        Trade Coin
                    </label>
                </div>

                <div class="itemDetails">
                    <input type="text" name="itemName" id="itemName" class="itemName" placeholder="Item Name" required>

                    <input type="text" name="Address" id="Address" class="Address" placeholder="Address" required>

                    <select name="category" id="category" class="select category" required>
                        <option value="" disabled selected>Category</option>
                        <!-- <option value="electDev">Electronic Devices</option> -->
                        <option value="electronic accessories">Electronic Accessories</option>
                        <option value="home app">Home Appliances</option>
                        <!-- <option value="healt">Health & Beauty</option> -->
                        <!-- <option value="kids">Babies & Kids</option> -->
                        <!-- <option value="grocPets">Groceries & Pets</option> -->
                        <!-- <option value="homeLiving">Home & Living</option> -->
                        <option value="women fashion">Women's Fashion & Accessories</option>
                        <option value="men fashion">Men's Fashion & Accessories</option>
                        <option value="toys collection">Toys & Collectibles</option>
                        <option value="sports lifestyle">Sports & Lifestyle</option>
                        <option value="auto motive">Automotive & Motorcycles</option>
                    </select>

                    <select name="location" id="location" class="select location" required>
                        <option value="" disabled selected>City</option>
                        <option value="local">Local</option>
                        <option value="Manila">Manila</option>
                        <option value="Pasay">Pasay</option>
                        <option value="Makati">Makati</option>
                        <option value="Quezon City">Quezon City</option>
                        <option value="Marikina">Marikina</option>
                        <option value="Caloocan">Caloocan</option>
                    </select>

                    <label id="price_label">Price set to 0.00 if method is "trade only"</label required>
                    <input type="number" name="price" id="Address" class="Price" step="0.01" pattern="\d+(\.\d{2})?" placeholder="0.00">

                    <select name="itemCondition" id="itemCondition" class="select itemCondition" required>
                        <option value="" disabled selected>Iterm Condition</option>
                        <option value="new">New</option>
                        <option value="slight">Slightly Used</option>
                        <option value="used">Used</option>
                    </select>
                    
                    <textarea name="itemDescrip" id="itemDetails" class="itemDesc" cols="30" rows="10" placeholder="Item Dectription"></textarea>

                    <input type="file" name="uploadImg[]" id="uploadImg" class="uploadImg" accept=".jpg, .jpeg, .png" multiple required>

                    <input type="submit" name="submit" value="Upload" class="submit">

                </div>
            </form>

            <div class="imgDisplay">

            </div>
        </div>
    </section>
</body>
</html>