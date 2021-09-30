<?php

if (empty($_POST) === false) {
    $errors = array();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    if (empty($name) === true || empty($email) === true || empty($message) === true) {
        $errors[] = 'Name, email, message are required';
    }
    else {
        if(ctype_alpha($name) === false) {
            $errors[] = 'Name must only contain letters!';
        }
    }

    if(empty($errors) === true){
        // send email
        mail('tanvinkalra@gmail.com', 'Contact Form', $message, 'From: ' . $email);
        // redirect user
        header('Location: index.php?sent');

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
</head>

<body>
    <h1>Contact Us</h1>
    <?php
    if(isset($_GET['sent']) === true){
        echo '<p> Thanks for contacting us! </p>';
    }else {
        if (empty($errors) === false){
            echo '<ul>';
            foreach($errors as $error){
                echo '<li>', $error, '</li>';
            }
            echo '</ul>';
        }
        ?>
        <form action="" method="POST">
            <p>
                <label for="name">Name: </label>
                <input id="name" type="text" placeholder="John Doe" name="name" <?php if(isset($_POST['name']) === true) { echo 'value="', strip_tags($_POST['name']), '"';} ?>>
            </p>
            <p>
                <label for="emailid">Email:</label>
                <input type="email" placeholder="johndoe@website.com" id="emailid" name="email">
            </p>
            <p>
                <label for="message">Message:</label><br>
                <textarea name = "message" id = "message"></textarea>
            </p>
            <input type="submit" value="Send">
        </form>
    <?php
        }
    ?>


</body>

</html>