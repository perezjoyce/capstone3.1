@extends('layouts.app')

@section('content')

<div class="row">
    <br>
    <br>
    <div class="col m2 l3"></div>

    <div class="col l3 m4 s12">
      <div class="card">
        <div class="card-image">
          <img src="/images/background1.jpg">
          <span class="card-title">Card Title</span>
        </div>
        <!-- <div class="card-content">
          <p>I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.</p>
        </div> -->
        <div class="card-action">
          <a class='modal-trigger btn' href="#register-modal">Register As Teacher</a>
        </div>
      </div>
    </div>
    
    <div class="col l3 m4 s12">
      <div class="card">
        <div class="card-image">
          <img src="/images/background1.jpg">
          <span class="card-title">Card Title</span>
        </div>
        <!-- <div class="card-content">
          <p>I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.</p>
        </div> -->
        <div class="card-action">
          <a class='modal-trigger btn' href="#register-modal">Register As Student</a>
        </div>
      </div>
    </div>

    <div class="col m2 l3"></div>

</div>
@endsection
