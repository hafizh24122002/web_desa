@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
				'title' => 'Pohon Staf',
				'current_page' => 'Manajemen Staf'
				])

				{{-- content --}}
				<div class="row mt-3 container">
					<div id="pohonStaf" style="width: 100%; height: 600px;"></div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')
<script type="text/javascript">
	$(function() {

		var datasource = {
			'name': 'RIZA UMAMI',
			'title': 'Kepala Desa',
			'children': [{
					'name': 'HOTIB',
					'title': 'Sekretaris Desa',
					'children': [{
							'name': 'SUFARTA',
							'title': 'Kaur Administrasi',
							'children' : [{
								'name' : 'SILVI FEBRIANTI',
								'title' : 'Staf Administrasi'
							}]
						},
						{
							'name': 'ERLANGGA',
							'title': 'Kaur Keuangan'
						}
					]
				},
				{
					'name': 'ISWANDI',
					'title': 'Kasi Kesejahteraan',
				},
				{
					'name': 'RENDY SANDRA',
					'title': 'Kasi Pelayanan'
				},
				{
					'name': 'ISBIK MIRWANTO',
					'title': 'Kasi Pemerintahan'
				},
				{
					'name': 'DIAH ISMAINI',
					'title': 'Kasi TU dan Umum'
				},
				{
					'name': 'HORMEN',
					'title': 'Kepala Dusun 1'
				},
				{
					'name': 'SUHARDI',
					'title': 'Kepala Dusun 2'
				},
			]
		};

		$('#pohonStaf').orgchart({
			'data': datasource,
			'nodeTitle' : 'title',
			'nodeContent': 'name'
		});

	});
</script>

@endsection