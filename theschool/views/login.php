<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">

        <script>
            $(function () {
                $("#loginBtn").click(function () {
                    $.post("../controllers/logincontroller.php", {user_email: $("#login_email").val(), user_password: $("#login_password").val()}, function (data) {
                        if (data == "ok") {
                            window.location.href = "/school";
                        } else {
                            $('#loginerr').html(data);
                            $('#loginerrClass').show();
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"><div class="card">
                        <div class="card-header">
                            Login
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="login_email">User Name:</label>
                                    <input type="text" class="form-control" name="login_email" id="login_email">
                                </div>
                                <div class="form-group">
                                    <label for="login_password">Password:</label>
                                    <input type="text" class="form-control" name="login_password" id="login_password">
                                </div>
                                <button type="button" id="loginBtn">Login</button>
                                <div class="alert alert-danger" role="alert" id="loginerrClass">
                                    <p id="loginerr"></p>
                                </div>
                            </form>
                        </div>
                    </div></div>
                <div class="col-md-4"></div>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>
