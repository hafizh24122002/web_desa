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
			if (typeof $this.attr('href') !== 'undefined') {
				href = $this.attr('href').split("/");
			}

			// if the current path is like this link, make it active
			if (href[2] === cleaned[2]) {
				if (typeof cleaned[3] === 'undefined') {
					$this.addClass('active');
				} else {
					if (href[3] === cleaned[3]) {
						$this.addClass('active');
					}
				}
			}	
		})

		// var parent = $('#penduduk');
		// console.log(parent);

		// if (parent.children.classList.contains('active')) {
		// 	parent.addClass('text-light');
		// }
		
	})
		
	// Your code to run since DOM is loaded and ready
});