<div class="topnav" id="myTopnav">
  <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'iFamily') }}
  </a>
  
  

	@guest
        
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>       
    
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        
    @else
        
		<a class="nav_link" href="#choirs">Polls</a>
		<a class="nav_link" href="#polls">Choirs</a>
		<a class="nav_link" href="#grocery_list">Grocery List</a>

		@if(session()->has('user') && session('user')['is_parent']==true)
			<a class="nav_link" href="/addUser">Add Users</a>
			<a class="nav_link" href="/reviewChoirs">Review Choirs</a>		
		@endif

		@if(session()->has('user') && session('user')['is_admin']==true)			
			<a class="nav_link" href="#admin">Admin</a>		
		@endif
           
        
        <a class="nav_link" href="{{ url('/logout') }}"> Logout </a>

        <!--
        <a class="nav_link" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
       -->     
       
    @endguest

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