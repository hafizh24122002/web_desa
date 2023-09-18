@extends('layouts/adminMain')

@section('main-content')
<style type="text/css">
	.orgchart {
		background: unset;
	}

	.orgchart .node .title {
		background-color: #343a40;
	}
</style>
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
					<div id="pohonStaf"></div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')
<script type="text/javascript">
	$(function() {
		var staf = @json($staf);
		var stafMap = {};
		staf.forEach(function (item) {
			stafMap[item.jabatan] = item.nama;
		});

		var datasource = {
			'name': stafMap['Kepala Desa'],
			'title': 'Kepala Desa',
			'children': [{
					'name': stafMap['Sekretaris Desa'],
					'title': 'Sekretaris Desa',
				},
				{
					'name': stafMap['Kasi Kesejahteraan'],
					'title': 'Kasi Kesejahteraan',
					'levelOffset': 1,
				},
				{
					'name': stafMap['Kasi Pelayanan'],
					'title': 'Kasi Pelayanan',
					'levelOffset': 1,
				},
				{
					'name': stafMap['Kasi Pemerintahan'],
					'title': 'Kasi Pemerintahan',
					'levelOffset': 1,
				},
				{
					'name': stafMap['Kepala Dusun 1'],
					'title': 'Kepala Dusun I',
					'levelOffset': 2
				},
				{
					'name': stafMap['Kepala Dusun 2'],
					'title': 'Kepala Dusun II',
					'levelOffset': 2
				},
				{
					'name': stafMap['Kasi TU dan Umum'],
					'title': 'Kasi TU dan Umum',
					'levelOffset': 1,
				},
				{
					'name': stafMap['Kaur Perencanaan'],
					'title': 'Kaur Perencanaan',
					'levelOffset': 1,
				},
				{
					'name': stafMap['Kaur Keuangan'],
					'title': 'Kaur Keuangan',
					'levelOffset': 1,
				},
			]
		};

		$('#pohonStaf').orgchart({
			'data': datasource,
			'nodeTitle': 'title',
			'nodeContent': 'name',
			'createNode': function(node, data) {
				if (data.levelOffset) {
					node.css({
						'margin-top': (data.levelOffset * 70) + 'px',
						'--top': (-11 - data.levelOffset * 70) + 'px',
						'--height': (9 + data.levelOffset * 70) + 'px',
						'--top-cross-point': (-13 - data.levelOffset * 70) + 'px',
						'--height-cross-point': (11 + data.levelOffset * 70) + 'px'
					});
				}
			}
		});

	});
</script>

@endsection