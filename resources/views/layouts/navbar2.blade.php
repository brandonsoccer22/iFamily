<div class="topnav" id="myTopnav">
  <a class="nav_link" href="#home" class="active">Home</a>
  <a class="nav_link" href="#choirs">Polls</a>
  <a class="nav_link" href="#polls">Choirs</a>
  <a class="nav_link" href="#grocery_list">Grocery List</a>
  <a href="javascript:void(0);" class="icon" onclick="menuFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>



<script>
function menuFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

// Add active class to the current button (highlight it)
var header = document.getElementById("myTopnav");
var btns = header.getElementsByClassName("nav_link");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    if (current.length > 0) { 
      current[0].className = current[0].className.replace(" active", "");
    }
    this.className += " active";
  });
}
</script>