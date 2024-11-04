<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="resetForm">
        <h4>Reset Password...</h4>
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="new_password" required placeholder="New Password">
        <br></br>
        <button type="submit">Login</button>
    </form>
    <script>
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url("user/reset_password_action") ?>',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === "success") {
                        alert("Success!");
                    }else{
                        alert("Failed");
                    }
                    $("email").val('');
                    $("new_password").val('');
                }
            });
        });
    </script>
</body>
</html>
