<html>
<body>
    <p>Dear <?php echo($display_name);?>,</p>

    Thank you for registering on the Monitor for Results website. To complete your registration, please click on the link below:

    <p><?php echo(anchor($link, $link)); ?></p>

    <p>Alternatively, copy and paste the confirmation code in the email confirmation page: <strong><?php echo $confirmation_code; ?></strong></p>

    <p>Thank you for registering with us!</p>
</body>
</html>