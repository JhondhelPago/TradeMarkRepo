<?php
session_start();
$post_id = isset($_SESSION['post_id']) ? $_SESSION['post_id'] : 'No data found';
echo $post_id;

$email = isset($_SESSION['valid']) ? $_SESSION['valid'] : 'No email foud';
echo $email;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <script>
        function goBack() {
            window.history.back();
        }
</script>

</head>



<body>
    <script>
            function goBack() {
                window.history.back();
            }
    </script>
    <button onclick="goBack()">Back</button>
    <br>

    <form methdo="post" action="home.php">
        <button type="submit">Back using php and form</button>
    </form>

    <p>this is the page for handling the method action</p>
    
    <?php
    echo "this is the id from the last page " . $post_id; 
    ?>



    <?php
    
    
    ?>

    
</body>


</html>