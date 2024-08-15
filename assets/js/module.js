
$(document).ready(function () {

    $('#add-group-btn').click(function () {
        $('#group_form').show();
        $(this).hide();
    });

    $('#add-news-btn').click(function () {
        $('#news_form').show();
        $(this).hide();
    });

    $('#add-student-btn').click(function () {
        $('#student_form').show();
        $(this).hide();
    });

    $('#add-teacher-btn').click(function () {
        $('#teacher_form').show();
        $(this).hide();
    });
});

