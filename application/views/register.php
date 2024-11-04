<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="registerForm">
        <h4>Register Here...</h4>
        <input type="text" name="name" required placeholder="Name">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <input type="address" name="address" required placeholder="Address">
        <input type="phone" name="phone" required placeholder="Phone">
        <input type="designation" name="designation" required placeholder="Designation">
        
        <br></br>
        <button type="submit">Register</button>
        <!-- <button type="submit">Login</button> -->
    </form>
    <script>
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url("user/register_action") ?>',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === "success") {
                        alert("Registration successful!");
                        window.location.href = '<?= site_url("user/login") ?>';
                    }else{
                        alert("Failed");
                    }
                    $("email").val('');
                    $("password").val('');
                    $("name").val('');
                }
            });
        });
    </script>
</body>
</html>
