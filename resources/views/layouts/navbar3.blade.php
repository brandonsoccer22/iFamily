<div class="topnav" id="myTopnav">
  <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'iFamily') }}
  </a>
  
  

	@guest
        
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>       
    
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        
    @else
        @if(session()->has('user') && session('user')['is_admin']==false)
		<a class="nav_link" href="/polls">Polls</a>
		<a class="nav_link" href="/view-choirs">Chores</a>
		<a class="nav_link" href="/groceries">Grocery List</a>

		@if(session()->has('user') && session('user')['is_parent']==true)
			<a class="nav_link" href="/addUser">Add Users</a>
			<a class="nav_link" href="/reviewChoirs">Review Chores</a>		
		@endif
        @endif

		@if(session()->has('user') && session('user')['is_admin']==true)
			<a class="nav_link" href="/delete_user">User List</a>
			<a class="nav_link" href="/stats">Statistics</a>
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
