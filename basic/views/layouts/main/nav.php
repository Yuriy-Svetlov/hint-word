<?php 
use yii\helpers\Html;


?>


<nav>
	<div id="navbar"> 
		<ul>
		  	<li>
			  	<a id="navbar__BUT_1" href="/">
			  		JQuery
			  	</a>
		  	</li>

			<li>
			  	<a id="navbar__BUT_2" href="/reactjs">
			  		ReactJs
			  	</a>
			</li>

			<li>
			  	<a id="navbar__BUT_3" href="/about">
			  		About
			  	</a>
			</li>
		</ul>
	</div> 
</nav>


<script>
	setNavbar__Active(window.location.pathname)

	function setNavbar__Active(pathname){
		if(pathname === "/"){
			document.getElementById("navbar__BUT_1").classList.add("navbar_active");
		}else if (pathname == "/reactjs"){
			document.getElementById("navbar__BUT_2").classList.add("navbar_active");
		}else 
		if (pathname == "/about"){
			document.getElementById("navbar__BUT_3").classList.add("navbar_active");
		}		
	}
</script>



