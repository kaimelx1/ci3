<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

<div align="center" style="margin-top: 200px">
    <h1>Authorization</h1>
    <?php echo form_open('Aleksandr_vashchenko_crud/login', 'class="form-inline"'); ?>
    <div class="form-group">
        <?php echo form_input('email', set_value('email'), 'class="form-control" placeholder="Email"'); ?>
    </div>
    <div class="form-group">
        <?php echo form_password('password', '', 'class="form-control" placeholder="Password"'); ?>
    </div>
    <?php echo form_submit('submit', 'Login', 'class="btn btn-default"'); ?>
    <?php echo form_close(); ?>
    <br>
    <?php echo '<span style="color: red">' . validation_errors() . '</span>'; ?>
    <?php if (isset($credentials)) echo'<span style="color: red">' . $credentials . '</span>';?>
</div>

</body>
</html>