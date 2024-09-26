<!DOCTYPE html>
<html>
<head>
    <title>Quiz Question</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div>
        <h2><?php echo $question->question_text; ?></h2>
        <form id="answer_form">
            <?php foreach ($answers as $answer){ ?>
                <div>
                    <input type="radio" name="selected_answer_id" value="<?php echo $answer->id; ?>" required>
                    <?php echo $answer->answer_text; ?>
                </div>
            <?php } ?>
            <input type="hidden" name="quiz_result_id" value="1"> <!-- Set the quiz result ID -->
            <input type="hidden" name="question_id" value="<?php echo $question->id; ?>">
            <input type="hidden" name="question_number" value="<?php echo $question_number; ?>">
            <input type="hidden" name="total_questions" value="<?php echo $total_questions; ?>">
            <input type="button" id="submit_answer" value="Submit Answer">
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#submit_answer').click(function() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('quiz/submit_answer'); ?>",
                    data: $("#answer_form").serialize(),
                    success: function(response) {
                        window.location.href = response.redirect;
                    }
                });
            });
        });
    </script>
</body>
</html>
