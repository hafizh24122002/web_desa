$(document).ready(function() {
	const showNavbar = (toggleId, navId, bodyId, headerId, navNameClass, accordionBtnClass, accordionCollapseClass) => {
		const toggle = document.getElementById(toggleId),
		nav = document.getElementById(navId),
		bodypd = document.getElementById(bodyId),
		headerpd = document.getElementById(headerId),
		navnamepd = document.querySelectorAll('.' + navNameClass);
		accordionbtn = document.querySelectorAll('.' + accordionBtnClass);
		accordioncollapse = document.querySelectorAll('.' + accordionCollapseClass);
		
		// Flag to track if nav-bar is hidden
		let isNavHidden = false;

		// Validate that all variables exist
		if (toggle && nav && bodypd && headerpd) {
			toggle.addEventListener('click', () => {
				toggleNav();

				accordioncollapse.forEach(element => {
					if(element.classList.contains('show')) {
						new bootstrap.Collapse(element);
					}
				});
			});
	
			// Add event listener to each accordion-btn element
			accordionbtn.forEach(element => {
				element.addEventListener('click', () => {
					if (isNavHidden) {
						toggleNav();
					}
				});
			});
		}
	
		// Function to toggle nav-bar visibility
		function toggleNav() {
			// Toggle nav-bar visibility
			nav.classList.toggle('show');
	
			// Toggle the flag
			isNavHidden = !isNavHidden;
	
			// Toggle opacity of nav-name elements
			navnamepd.forEach(element => {
				element.style.opacity = isNavHidden ? "0" : "1";
			});
	
			// Other toggles for body and header
			bodypd.classList.toggle('body-pd');
			headerpd.classList.toggle('body-pd');
		}
	}
	
	showNavbar('header-toggle','nav-bar','body-pd','header', 'nav-name', 'accordion-button', 'accordion-collapse')

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