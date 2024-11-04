<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="loginForm">
    <div id="formdiv">
        <input type="email" name="email" required placeholder="Email"><br></br>
        <input type="password" name="password" required placeholder="Password">
        <br></br>
        <button type="submit">Login</button>
        <button type="button" onclick="regview();">Register</button>
        </div>
    </form>
    <script>
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            var email = $("input[name='email']").val();
            console.log(email);
            var password = $("input[name='password']").val();
            $.ajax({
                url: '<?= site_url("user/login_action") ?>',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === "success") {
                        alert("Success!");
                        // window.location.href = '<?= site_url("user/profile") ?>';
                        window.location.href = '<?= site_url("user/profile") ?>?email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password);
                        $('#formdiv').html(response);
                    }else{
                        alert("Failed");
                        window.location.href = '<?= site_url("user/register") ?>';
                    }
                    $("email").val('');
                    $("password").val('');
                }
            });
        });
        function regview() {
            window.location.href = '<?= site_url("user/register") ?>'; 
        }
        
    </script>
</body>
</html>
