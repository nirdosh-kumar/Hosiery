// Tooltip Js
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

//Menu Left Sidebar
function openNav() {
  document.getElementById("mySidenav").style.width = "280px";
  document.getElementById("myCanvasNav").style.opacity = "0.8";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.body.style.backgroundColor = "white";
}