@extends('layouts.header-user.header')

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
      
    @include('seeker.parts.header')

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ asset('images/hero_1.jpg') }});" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">My Calendar</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>My Calendar</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section block__18514" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <span class="text-primary d-block mb-5"><span class="icon-magnet display-1"></span></span>
            <h2 class="mb-4">Graphic Design</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolorum incidunt dolorem facere, officiis placeat consequuntur odit quasi, quam voluptates, deleniti! Neque tenetur in, omnis consectetur molestias expedita nostrum et.</p>
            <p>Sed odio temporibus quaerat laboriosam dicta ipsam eligendi deserunt architecto, aliquam in totam provident praesentium aperiam, id impedit aut delectus mollitia doloribus nostrum numquam tempore ullam reprehenderit nesciunt cumque veniam.</p>
            <p>Officia mollitia deserunt vel expedita deleniti iure eius illum dolor optio tempora! Fuga, voluptates omnis velit neque. Rerum aperiam consequatur vero, nulla dolores a. Sed, non veniam maiores recusandae iure.</p>
            <p>Nobis officia tempore porro incidunt quaerat commodi numquam exercitationem laboriosam deserunt, error excepturi et delectus quis explicabo repellendus obcaecati iusto. Delectus magni ducimus illo! Fugit quaerat debitis deserunt facere reiciendis!</p>
            <p><a href="#" class="btn btn-primary btn-md mt-4">Hire Us, Our Agency</a></p>
          </div>
        </div>
      </div>
    </section>

    @extends('layouts.site.footer')
  
</div>
  
    @extends('layouts.site.script')
   
  </body>
</html>