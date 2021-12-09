@extends('frontend.layout')

@section('page_title')
Home
@endsection

@section('banner')
    <div class="intro" style="background: url({{ asset('images/settings/95953_banner.jpg') }}) #F7F7F7 center top;">
        <div class="container">
            <div class="units-row">
                <div class="unit-10">
                    <img class="img-intro" src="{{ asset('images/settings/68109_profile.jpg') }}" alt="">
                </div>
                <div class="unit-90">
                    <p class="p-intro">Hello, I’m Saturn. I’m proud to be a part of milky way.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main')
    <!-- Post -->
    <div class="post">
        <!-- Heading -->
        <a href="#"><h1>Galaxy is on your hand</h1></a>
        <hr>
        <div class="in-content">
            <p>
                Saturn has a prominent ring system that consists of nine continuous main rings and three discontinuous arcs, composed mostly of ice particles with a smaller amount of rocky debris and dust. Sixty-two known moons orbit the planet, of which fifty-three are officially named. This does not include the hundreds of "moonlets" comprising the rings.
            </p>
            <a class="read-more" href="#">Read more</a>
        </div>
        <div class="foot-post">
            <div class="units-row">
                <div class="unit-100">
                    <strong>Tags:</strong>
                    <a href="#">Galaxy</a>,
                    <a href="#">Human</a>,
                    <a href="#">World</a>,
                </div>
                <div class="unit-100">
                    <strong>COMMENTS:</strong> 
                    <a href="#">3</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /post -->

    <!-- Post -->
    <div class="post">
        <!-- Heading -->
        <a href="#"><h1>The moon will pass above or below Saturn in the sky</h1></a>
        <hr>
        <div class="in-content">
            <img src="img/bluhh.jpg" alt="">
            <p>
                Saturn has a prominent ring system that consists of nine continuous main rings and three discontinuous arcs, composed mostly afn of ice particles with a smaller amount of rocky debris and dust.
            </p>
        </div>
        <div class="foot-post">
            <div class="units-row">
                <div class="unit-100">
                    <strong>Tags:</strong>
                    <a href="#">Saturn</a>,
                    <a href="#">Sky</a>,
                    <a href="#">Moon</a>,
                </div>
                <div class="unit-100">
                    <strong>COMMENTS:</strong> 
                    <a href="#">3</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /post -->

    <!-- Post -->
    <div class="post">
        <!-- Heading -->
        <a href="#"><h1>Moon’s orbit around the Earth </h1></a>
        <hr>
        <div class="in-content">
            <p>
                Tilted to the orbit of the Earth around the Sun – and so most of the time, the moon will pass above or below Saturn in the sky, and no occultation will occur. It is only when Saturn lies near the point that the moon’s orbit crosses the “plane of the ecliptic” that occultations can happen.
            </p>
            <a class="read-more" href="#">Read more</a>
        </div>
        <div class="foot-post">
            <div class="units-row">
                <div class="unit-100">
                    <strong>Tags:</strong>
                    <a href="#">Moon</a>,
                    <a href="#">Orbit</a>,
                    <a href="#">Earth</a>,
                </div>
                <div class="unit-100">
                    <strong>COMMENTS:</strong> 
                    <a href="#">221</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /post -->    
@endsection

@section('main_pagination')
<div class="units-row">
    <div class="unit-50">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item "><a class="page-link" href="#">1</a></li>
              <li class="page-item active"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>
    </div>
</div>
@endsection