function showContent(section) {
    var sections = ['home', 'news', 'admin-content', 'groups'];
    sections.forEach(function(sec) {
        document.getElementById(sec).style.display = (sec === section) ? 'block' : 'none';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    showContent('home');
    resetUserForm();
});

function resetUserForm() {
    document.getElementById('user_type').selectedIndex = 0;
    document.getElementById('student_form').style.display = 'none';
    document.getElementById('teacher_form').style.display = 'none';
}