
document.getElementById("add-group-btn").addEventListener("click", function() {
  document.getElementById("group_form").style.display = "block";
  this.style.display = "none";
});

document.getElementById("add-news-btn").addEventListener("click", function() {
  document.getElementById("news_form").style.display = "block";
  this.style.display = "none";
});

document.getElementById("add-student-btn").addEventListener("click", function() {
    document.getElementById("student_form").style.display = "block";
    this.style.display = "none";
});
  
document.getElementById("add-teacher-btn").addEventListener("click", function() {
document.getElementById("teacher_form").style.display = "block";
this.style.display = "none";
});

function hideUsersExceptRole(role) {
    var tableRows = document.querySelectorAll('.user-row');
    tableRows.forEach(function(row) {
        var userRole = row.getAttribute('data-role');
        if (userRole !== role) {
            row.style.display = 'none';
        } else {
            row.style.display = '';
        }
    });
}

function showAllUsers() {
    var tableRows = document.querySelectorAll('.user-row');
    tableRows.forEach(function(row) {
        row.style.display = ''; 
    });
}

