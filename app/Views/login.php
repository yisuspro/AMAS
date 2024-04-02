<html>

<head>
    <link href="<?= base_url('assets/styles/login.css'); ?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?= base_url('vendor/components/jquery/jquery.js'); ?>"></script>
</head>

<body class="body">
    <div class="content">
        <div class="head">
        </div>
        <div class="cart">
            <form method="post" action="<?= base_url('users/login'); ?>" id="frm_login">
                <h3>Usuario:</h3>
                <input type="text" name="USER_username">
                <h3>Contraseña:</h3>
                <input type="password" name="USER_password">
                <button type="submit">seguir</button>
            </form>
        </div>


    </div>
</body>
<script type="text/javascript" src="<?= base_url('assets/scripts/login.js'); ?>"></script>

</html>