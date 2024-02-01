<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <form enctype="multipart/form-data" action="php/createpost_action.php" method='post'>

        <input type="text" name="itemname" required>
        <input type ="file" name="fileimg[]" accept= ".jpg, .jpeg, .png" multiple required>
        <br>
        <button type="submit" name="submit">submit</button>

    </form>

    
</body>
</html>