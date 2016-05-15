
@extends('layouts.shared.master')

<!-- title -->
@section('title')
Stats Analytica - Pizzamix
@endsection

<!-- stylesheets and directives -->
@section('head')

@endsection

<!-- header -->
@section('header')

@endsection

<!-- header -->
@section('assets')


@endsection

<!-- body -->

@section('body')

@include('layouts.admin.nav')

<div style="display:block; padding-top: 20px; padding-bottom: 20px; height: 1080px;">

<div class="container">

    <h2>Sales History<legend>w.r.t total billed price</legend></h2>
	<div id="pop_div"></div>
	@areachart('Population', 'pop_div')

	<div id="temps_div"></div>
	@linechart('LineChart', 'temps_div')


    <h2>Order History<legend>w.r.t status</legend></h2>
	<div id="poll_div"></div>
	@barchart('Votes', 'poll_div')		

</div>
</div>


@endsection

<!-- footer -->
@section('footer')

@endsection