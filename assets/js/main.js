
   (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);


// var min = new Date().getFullYear(),
//     max = min + 9,
    select = document.getElementById('year');

for (var i = 2018; i<=2020; i++){
    var opt = document.createElement('option');
    opt.value = i;
    opt.innerHTML = i;
    select.appendChild(opt);
}


select = document.getElementById('month');

for (var i = 1; i<=12; i++){
    var opt = document.createElement('option');
    opt.value = i;
    opt.innerHTML = i;
    select.appendChild(opt);
}


var getValue = function(){
var year = document.getElementById('year').value;
var month = document.getElementById('month').value;
window.location.href = 'dashboard.php?year='+ year +'&month=' + month;

}

// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable();
  });
  
