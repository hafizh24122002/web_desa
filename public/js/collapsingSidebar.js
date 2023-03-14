$(document).ready(function() {
	const showNavbar = (toggleId, navId, bodyId, headerId) => {
		const toggle = document.getElementById(toggleId),
		nav = document.getElementById(navId),
		bodypd = document.getElementById(bodyId),
		headerpd = document.getElementById(headerId)
		
		// Validate that all variables exist
		if(toggle && nav && bodypd && headerpd) {
			toggle.addEventListener('click', () => {
				// show navbar
				nav.classList.toggle('show')
				// change icon
				// toggle.classList.toggle('bx-x')
				// add padding to body
				bodypd.classList.toggle('body-pd')
				// add padding to header
				headerpd.classList.toggle('body-pd')
			})
		}
	}
	
	showNavbar('header-toggle','nav-bar','body-pd','header')

	$(function() {
		var current = location.pathname;
		cleaned = current.split("/");
		$('.nav-link').each(function(){
			var $this = $(this);
			// if the current path is like this link, make it active
			if ($this.attr('href').indexOf(cleaned[2]) !== -1) {
				$this.addClass('active');
			}
		})
	})
		
	// Your code to run since DOM is loaded and ready
});