@extends('layouts/adminMain')

@section('main-content')

@include('partials.commonScripts')

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

<script type="text/javascript">
	$(document).ready(function() {
		$("#pekerjaan_lainnya_input").hide();

		$(".pekerjaan_input").change(function() {
			if ($(".pekerjaan_input").val() == "84") {
				$("#pekerjaan_lainnya_input").slideDown();
			} else {
				$("#pekerjaan_lainnya_input").slideUp();
			}
		});
	})

    document.addEventListener("DOMContentLoaded", function () {
        var nikKepalaField = document.getElementById("nik_kepala");
        var noKKField = document.getElementById("no_kk");
        var noKKDisplay = document.getElementById("no_kk_display");
        var selectedNik = ''; // Inisialisasi selectedNik di sini
        var nikKepalaData = @json($nik_kepala);

        nikKepalaField.addEventListener("change", function () {
            // Mendapatkan nilai NIK kepala keluarga yang dipilih dari dropdown
            selectedNik = nikKepalaField.value;

            // Cari kepala keluarga yang sesuai dalam daftar $nik_kepalaData
            var kepalaKeluarga = nikKepalaData.find(function(item) {
                return item.nik === selectedNik;
            });

            // Isi nilai "No. KK" dengan nama kepala keluarga
            noKKDisplay.textContent = kepalaKeluarga ? kepalaKeluarga.nama : '';
        });
    });
</script>








@endsection