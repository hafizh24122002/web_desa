@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
			{{-- menu yang di atas --}}
			@if ($title === "New User")
				@include('partials.adminTopMenu', [
					'title' => 'Tambah Pengguna Baru',
					'parent_page' => 'User Manager',
					'parent_link' => '/admin/user-manager',
					'current_page' => 'New User',
					])
			@elseif ($title === "Edit User")
				@include('partials.adminTopMenu', [
					'title' => 'Edit Pengguna',
					'parent_page' => 'User Manager',
					'parent_link' => '/admin/user-manager',
					'current_page' => 'Edit User',
					])
			@endif

			{{-- content --}}
			@yield('form')
		</div>
	</div>
</section>

@include('partials.commonScripts')
<script type="text/javascript">
	$(document).ready(function() {
		$("#pamong-input").hide();

		// toggle tampilan input untuk pamong
		$("#grup-input").change(function() {
			if ($("#grup-input").val() == "2") {
				$("#pamong-input").slideDown();
			} else {
				$("#pamong-input").slideUp();
			}
		});
	})
</script>

<script>
	function preview() {
		frame.src = URL.createObjectURL(event.target.files[0]);
	}
	function clearImage() {
		document.getElementById('formFile').value = null;
		frame.src = "";
	}
</script>

@endsection