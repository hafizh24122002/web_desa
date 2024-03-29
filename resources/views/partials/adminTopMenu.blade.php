<div class="row">
	<div class="col-xs-12 col-lg-6">
		<section class="content-title">
			<h4>{{ $title }}</h4>
		</section>
	</div>

	<div class="col-xs-12 col-lg-6">
		<section class="content-header">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="/admin/dashboard"><i class="fa fa-home"></i> Home</a>
				</li>

				@if (isset($parent_page))
					<li class="breadcrumb-item" aria-current="page">
						<a href="{{ $parent_link }}"> {{ $parent_page }}</a>
					</li>
				@endif
				
				<li class="breadcrumb-item" aria-current="page">{{ $current_page }}</li>
			</ol>
		</section>
	</div>
</div>