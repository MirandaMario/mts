@extends('online.master')
@section('title','ENVIOS')
@section('content')

<section class="feature_product_area section_gap_bottom_custom mt-50">
	<div class="container" style="max-width: 1125px; margin-top:50px !important;">
    {!!$confonline->envios!!}
    </div>
</section>
        
@endsection