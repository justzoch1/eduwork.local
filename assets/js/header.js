function showContent(section) {
    var sections = ['home', 'news', 'groups', 'teachers', 'students'];
    sections.forEach(function (sec) {
        $('#' + sec).css('display', (sec === section) ? 'block' : 'none')
    });
}

$(document).ready(function () {
    showContent('home');
})