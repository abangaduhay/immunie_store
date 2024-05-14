@extends('layout.home')

@section('title', 'About Us')

@section('content')
    
      <!-- Intro -->
      <section class="section-wrap intro pb-0">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 mb-50">
              <h2 class="intro-heading">Tentang {{$about->judul_website}}</h2>
              <p>{{$about->deskripsi}}</p>
            </div>
            <div class="col-md-3 col-md-offset-1 col-sm-5 mb-40">
              <div class="contact-item">
                <h6>Address</h6>
                <address>{{$about->judul_website}}<br>
                  {{$about->alamat}}</address>
              </div> <!-- end address -->
      
              <div class="contact-item">
                <h6>Information</h6>
                <ul>
                  <li>
                    <i class="fa fa-envelope"></i><a href="mailto:{{$about->email}}">{{$about->email}}</a>
                  </li>
                  <li>
                    <i class="fa fa-phone"></i><span>{{$about->telepon}}</span>
                  </li>
                </ul>               
              </div> <!-- end information -->
            </div>
          </div>
          <hr class="mb-0">
        </div>
      </section> <!-- end intro -->

      
      

      <!-- Promo Section -->
      <section class="section-wrap promo-bg" style="background-image:url(/front/img/promo_bg.jpg); height: 500px" >
        <div class="container text-center">
          <div class="table-box">
            <h2 class="heading-frame white">Immunie Store</h2>
          </div>
        </div>
      </section> <!-- end promo section -->

      <!-- Testimonials -->
      <section class="section-wrap testimonials">
        <div class="container">

          <div class="row heading-row mb-20">
            <div class="col-md-6 col-md-offset-3 text-center">
              <span class="subheading">Kata Pembeli</span>
              <h2 class="heading bottom-line">Testimoni Pembeli</h2>
            </div>
          </div>

          <div id="owl-testimonials" class="owl-carousel owl-theme owl-dark-dots text-center">
            @foreach ($testimonies as $testimoni)
            <div class="item">
              <div class="testimonial">
                <p class="testimonial-text">{{$testimoni->deskripsi}}</p>
                <span>{{$testimoni->nama_testimoni}}</span>
              </div>
            </div>
            @endforeach
          </div>
        </div>

      </section> <!-- end testimonials -->



@endsection