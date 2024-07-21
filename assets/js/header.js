function showContent(section) {
    var sections = ['home', 'news', 'groups', 'teachers', 'students'];
    sections.forEach(function(sec) {
        document.getElementById(sec).style.display = (sec === section) ? 'block' : 'none';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    showContent('home');
});
