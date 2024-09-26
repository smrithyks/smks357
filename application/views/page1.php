<!DOCTYPE html>
<html>
<head>
    <title>Online Quiz</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div>
        <h1>Welcome to the Quiz!</h1>
        <form id="start_quiz_form">
            <label for="user_name">Enter your name:</label>
            <input type="text" id="user_name" name="user_name" required>
            <input type="button" id="start_quiz" value="Start Quiz">
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#start_quiz').click(function() {
                var name = $('#user_name').val();
                if (name) {
                    window.location.href = "<?php echo base_url('quiz/questions/1'); ?>";
                }
            });
        });
    </script>
</body>
</html>
