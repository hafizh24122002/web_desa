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
					<div class="chart-container"></div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')
<script>
	var staf = @json($staf);
	var stafMap = {};
	
	staf.forEach(function (item) {
		stafMap[item.jabatan] = item.nama;
	});

	var datasource = [
		{
			'id': 0,
			'parentId': '',
			'name': stafMap['Kepala Desa'],
			'title': 'Kepala Desa',
		},
		{
			'id': 1,
			'parentId': 0,
			'name': stafMap['Sekretaris Desa'],
			'title': 'Sekretaris Desa',
		},
		{
			'id': 2,
			'name': stafMap['Kasi Kesejahteraan'],
			'title': 'Kasi Kesejahteraan',
			'parentId': 1,
		},
		{
			'id': 3,
			'name': stafMap['Kasi Pelayanan'],
			'title': 'Kasi Pelayanan',
			'parentId': 1,
		},
		{
			'id': 4,
			'name': stafMap['Kasi Pemerintahan'],
			'title': 'Kasi Pemerintahan',
			'parentId': 1,
		},
		{
			'id': 5,
			'name': stafMap['Kepala Dusun 1'],
			'title': 'Kepala Dusun I',
			'parentId': 1,
		},
		{
			'id': 6,
			'name': stafMap['Kepala Dusun 2'],
			'title': 'Kepala Dusun II',
			'parentId': 1,
		},
		{
			'id': 7,
			'name': stafMap['Kasi TU dan Umum'],
			'title': 'Kasi TU dan Umum',
			'parentId': 1,
		},
		{
			'id': 8,
			'name': stafMap['Kaur Perencanaan'],
			'title': 'Kaur Perencanaan',
			'parentId': 1,
		},
		{
			'id': 9,
			'name': stafMap['Kaur Keuangan'],
			'title': 'Kaur Keuangan',
			'parentId': 1,
		},
	];

	const chart = new d3.OrgChart().compact(false);

	chart.layoutBindings().top.linkY = (n) => n.y - 24;

	chart
		.nodeContent(function (d, i, arr, state) {
			if (d.data.title === 'Kepala Desa') {
				return `
					<div class="card bg-primary text-light shadow rounded">
						<div class="card-body">
							<h5 class="card-title fw-bold">${ d.data.name }</h5>
							<p class="card-subtitle"><em>${ d.data.title }</em></p>
						</div>
					</div>
				`;
			}
			return `
				<div class="card shadow rounded">
					<div class="card-body">
						<h5 class="card-title fw-bold">${ d.data.name }</h5>
						<p class="card-subtitle text-muted"><em>${ d.data.title }</em></p>
					</div>
				</div>
			`;
		})
		.container('.chart-container')
		.data(datasource)
		.expandAll()
		.render()
		.fit();
</script>

{{-- <script type="text/javascript">
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
	});
</script> --}}

@endsection