@extends('layouts.shared.master')

@section('title')
	Contact Us
@endsection

@section('assets')
	<link href='https://fonts.googleapis.com/css?family=Roboto:700,500' rel='stylesheet' type='text/css'>
@endsection
    
@section('header')
		<div class="contact-banner">
		</div>
@endsection

@section('body')

	<div class="contact-detail">
		<div class="contact-part">
			<img src="images/contact-phone.png" alt="">
			<p>+47 22 666 999</p>
		</div>
		<div class="contact-part">
			<img src="images/contact-location.png" alt="">
			<p>Velkommen till oss for henting eller utkjoring! Pizza Mix, Konowsgate 75, 0196 osio</p>
		</div>
		<div class="contact-part">
			<img src="images/contact-social.png" alt="">
			<a href="#"><img src="images/fb.jpg" alt=""></a>
			<a href="#"><img src="images/tweet.jpg" alt=""></a>
		</div>
		<div class="cb"></div>
	</div>
	<div class="contact-form-part">
		<h1>Contact</h1>
		<p>We love to hear from you, please send your feedback and quiries you may also email at <span><a href="mailto:hello@pizzamix.com">hello@pizzamix.com</a></span></p>
		<form action="" method="post">
			<input type="text" placeholder="First Name">
			<input type="text" placeholder="Last Name">
			<input type="email" placeholder="Email">
			<input type="text" placeholder="Subject">
			<textarea name="message" placeholder="Message"></textarea>
			<input  class="submit-form" type="submit" value="SUBMIT">
		</form>
	</div>
			

@endsection

@section('footer')

@endsection