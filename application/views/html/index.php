<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
 
    <meta content="width=device-width, initial-scale=1" name="viewport" />
  
    <title>Main Website</title>
  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/vendor/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/vendor/css/mdb.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/vendor/css/compiled.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/vendor/css/custom.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/plugins/vendor/js/jquery-3.2.1.min.js"></script>
	
</head>
<!-- END HEAD -->
<header>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-indigo scrolling-navbar">
        <a class="navbar-brand" href="#"><strong>Website Name (logo)</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="nav navbar-nav  ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#aboutus">About us</a>
                </li> 
				<li class="nav-item">
                    <a class="nav-link" href="#features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faq">FAQ's</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact Us</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin'); ?>">Admin Login</a>
                </li>
            </ul>
          
        </div>
    </nav>

</header>
<!--Main Navigation-->
                
            
<body style="padding-top:65px;" >

   <!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
        <!--First slide-->
        <div class="carousel-item active">
            <img class="d-block w-100" src="<?php echo base_url(); ?>assets/vendor/img/mainsite/b2.jpg" alt="First slide">
        </div>
        <!--/First slide-->
        <!--Second slide-->
        <div class="carousel-item">
            <img class="d-block w-100" src="<?php echo base_url(); ?>assets/vendor/img/mainsite/b3.jpg" alt="Second slide">
        </div>
        <!--/Second slide-->
        <!--Third slide-->
        <div class="carousel-item">
            <img class="d-block w-100" src="<?php echo base_url(); ?>assets/vendor/img/mainsite/b1.jpg" alt="Third slide">
        </div>
        <!--/Third slide-->
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
 <!--Section: Features v.4-->
 <div class="bacimgl" >
	<div class="clearfix" id="aboutus">&nbsp;</div>
 <div class="container-main card">
	<section>

    <!--Section heading-->
    <h1 class="py-5 font-bold text-center">About US</h1>
    <!--Section description-->
    <p class="px-5 mb-5 pb-3 lead grey-text text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
    aliqua. Ut enim ad minim veniam.</p>

    <!--Grid row-->
    <div class="row pt-2">

    <!--Grid column-->
    <div class="col-lg-5 mb-r center-on-small-only">
        <img src="<?php echo base_url(); ?>assets/vendor/img/mainsite/aboutus.png" alt="" class="img-fluid z-depth-0">
    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-7">

        <!--Grid row-->
        <div class="row pb-3">
        <div class="col-2 col-md-1">
            <i class="fa fa-mail-forward fa-lg indigo-text"></i>
        </div>
        <div class="col-10">
            <h5 class="font-bold text-left mb-3 dark-grey-text">Step-1</h5>
            <p class="grey-text text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
            .</p>
        </div>
        </div>
        <!--Grid row-->   <!--Grid row-->
        <div class="row pb-3">
        <div class="col-2 col-md-1">
            <i class="fa fa-mail-forward fa-lg indigo-text"></i>
        </div>
        <div class="col-10">
            <h5 class="font-bold text-left mb-3 dark-grey-text">Step-2</h5>
            <p class="grey-text text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
            .</p>
        </div>
        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row pb-3">
        <div class="col-2 col-md-1">
            <i class="fa fa-mail-forward fa-lg indigo-text"></i>
        </div>
        <div class="col-10">
            <h5 class="font-bold text-left mb-3 dark-grey-text">Step-3</h5>
            <p class="grey-text text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
            .</p>
        </div>
        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row pb-3">
        <div class="col-2 col-md-1">
            <i class="fa fa-mail-forward fa-lg indigo-text"></i>
        </div>
        <div class="col-10">
            <h5 class="font-bold text-left mb-3 dark-grey-text">Step-4</h5>
            <p class="grey-text text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
            .</p>
        </div>
        </div>
        <!--Grid row-->
		<!--Grid row-->
        <div class="row pb-3">
        <div class="col-2 col-md-1">
            <i class="fa fa-mail-forward fa-lg indigo-text"></i>
        </div>
        <div class="col-10">
            <h5 class="font-bold text-left mb-3 dark-grey-text">Step-5</h5>
            <p class="grey-text text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
            .</p>
        </div>
        </div>
        <!--Grid row-->

    </div>
    <!--Grid column-->

    </div>
    <!--Grid row-->

</section>
<!--Section: Features v.3-->
            
</div>
 

 <div class="container-main card" id="features" >
 <section class="" >
    <!--Section heading-->
    <h1 class="py-5 font-bold text-center">Our Features</h1>
    <!--Section description-->
    <p class="px-5 mb-5 pb-3 lead grey-text text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
    aliqua. Ut enim ad minim veniam.</p>

    <!--Grid row-->
    <div class="row">

    <!--Grid column-->
    <div class="col-md-4">

        <!--Grid row-->
        <div class="row mb-2">
        <div class="col-2">
            <i class="fa fa-2x fa-flag-checkered indigo-text"></i>
        </div>
        <div class="col-10 text-left">
            <h5 class="font-bold">Feature-1</h5>
            <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
           <a href="#"><span class="read-m">Read more</span></a></p>
        </div>
        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row mb-2">
        <div class="col-2">
            <i class="fa fa-2x fa-flask indigo-text"></i>
        </div>
        <div class="col-10 text-left">
            <h5 class="font-bold">Feature-2</h5>
            <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
            <a href="#"><span class="read-m">Read more</span></a>.</p>
        </div>
        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row mb-2">
        <div class="col-2">
            <i class="fa fa-2x fa-glass indigo-text"></i>
        </div>
        <div class="col-10 text-left">
            <h5 class="font-bold">Feature-3</h5>
            <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
            <a href="#"><span class="read-m">Read more</span></a>.</p>
        </div>
        </div>
        <!--Grid row-->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-4 mb-2 center-on-small-only flex-center">
        <img class="img-fluid" src="<?php echo base_url(); ?>assets/vendor/img/mainsite/features.png" alt="" class="z-depth-0">
    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-4">

        <!--Grid row-->
        <div class="row mb-2">
        <div class="col-2">
            <i class="fa fa-2x fa-heart indigo-text"></i>
        </div>
        <div class="col-10 text-left">
            <h5 class="font-bold">Feature-4</h5>
            <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
            <a href="#"><span class="read-m">Read more</span></a>.</p>
        </div>
        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row mb-2">
        <div class="col-2">
            <i class="fa fa-2x fa-flash indigo-text"></i>
        </div>
        <div class="col-10 text-left">
            <h5 class="font-bold">Feature-5</h5>
            <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
            <a href="#"><span class="read-m">Read more</span></a>.</p>
        </div>
        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row mb-2">
        <div class="col-2">
            <i class="fa fa-2x fa-magic indigo-text"></i>
        </div>
        <div class="col-10 text-left">
            <h5 class="font-bold">Feature-6</h5>
            <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda
            <a href="#"><span class="read-m">Read more</span></a>.</p>
        </div>
        </div>
        <!--Grid row-->

    </div>
    <!--Grid column-->

    </div>
    <!--Grid row-->

</section>
</div>
<div class="container-main card" id="faq" >
 <section class="" >
    <!--Section heading-->
    <h1 class="py-5 font-bold text-center">FAQ's</h1>
    <!--Section description-->
    <p class="px-5 mb-5 pb-3 lead grey-text text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
    aliqua. Ut enim ad minim veniam.</p>

	<div class="row">
	<div class="col-lg-4 center-on-small-only card" style="margin-left:40px;">
        <img src="<?php echo base_url(); ?>assets/vendor/img/mainsite/faq.png" alt="" class="img-fluid z-depth-0">
    </div>
    <!--Grid column-->

    <!--Grid column-->
	
    <div class="col-lg-7 card" style="margin-left:20px;">			
<!--Accordion wrapper-->
<div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

    <!-- Accordion card -->
    <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingOne">
            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h5 class="mb-0">
                    FAQ Heading  #1 <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>
        </div>

        <!-- Card body -->
        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
            <div class="card-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
    </div>
    <!-- Accordion card -->

    <!-- Accordion card -->
    <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingTwo">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h5 class="mb-0">
                    FAQ Heading  #2 <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>
        </div>

        <!-- Card body -->
        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
    </div>
    <!-- Accordion card -->
    
    <!-- Accordion card -->
    <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingThree">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <h5 class="mb-0">
                    FAQ Heading  #3 <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>
        </div>

        <!-- Card body -->
        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="card-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
    </div>
	 <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingFour">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <h5 class="mb-0">
                    FAQ Heading  #4 <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>
        </div>

        <!-- Card body -->
        <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
            <div class="card-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
    </div>
	<div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingFive">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <h5 class="mb-0">
                    FAQ Heading  #5 <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>
        </div>

        <!-- Card body -->
        <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive">
            <div class="card-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
    </div>
    <!-- Accordion card -->
</div>
<!--/.Accordion wrapper-->
</div>
</div>
                
				

</section>
</div>
<div class="container-main card" id="contact" >
 <section class="" >
    <!--Section heading-->
    <h1 class="py-5 font-bold text-center">Contact US</h1>
    <!--Section description-->
    <p class="px-5 mb-5 pb-3 lead grey-text text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
    aliqua. Ut enim ad minim veniam.</p>


		<div class="row text-left">

            <!--First column-->
            <div class="col-md-6 card" style="overfolw:hidden">
			
                <h5 class="title-footer mb-4 mt-3 font-bold">Loaction</h5>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d951.3149890282297!2d78.38789067916152!3d17.495099878319962!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb91f4f553e453%3A0x912891756062ff71!2sSri+Vani+Nilayam%2C+Sardar+Patel+Nagar%2C+Bhagat+Singh+Nagar%2C+Kukatpally+Housing+Board+Colony%2C+Kukatpally%2C+Hyderabad%2C+Telangana+500085!5e0!3m2!1sen!2sin!4v1518178461008" width="auto" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
               
            </div>
            <!--/.First column-->

            <hr class="clearfix w-100 d-md-none">

            <!--/.Second column-->

            <hr class="clearfix w-100 d-md-none">

            <!--Third column-->
            <div class="col-md-4 mx-auto">
                <h5 class="title-footer mb-4 mt-3 font-bold">Address</h5>
				 <form><div class="md-form">
							<i class="fa fa-user prefix grey-text"></i>
							<input type="text" id="form3" class="form-control">
							<label for="form3">Your name</label>
						</div>

						<div class="md-form">
							<i class="fa fa-envelope prefix grey-text"></i>
							<input type="text" id="form2" class="form-control">
							<label for="form2">Your email</label>
						</div>

						<div class="md-form">
							<i class="fa fa-tag prefix grey-text"></i>
							<input type="text" id="form32" class="form-control">
							<label for="form34">Subject</label>
						</div>

						<div class="md-form">
							<i class="fa fa-pencil prefix grey-text"></i>
							<textarea type="text" id="form8" class="md-textarea" style="height: 100px"></textarea>
							<label for="form8">Your message</label>
						</div>

						<div class="text-center">
							<button class="btn btn-unique">Send <i class="fa fa-paper-plane-o ml-1"></i></button>
						</div>

					</form>
            </div>
            <!--/.Third column-->

            <hr class="clearfix w-100 d-md-none">

           
        </div>
	
                
				

</section>
</div>
 <div class="clearfix">&nbsp;</div>
</div>
<!--/footer strat -->
<footer class="page-footer center-on-small-only stylish-color-dark sm-hide"  style="margin-top:0px">

    <!--Footer Links-->
    <div class="container">
        <div class="row text-left">

            <!--First column-->
            <div class="col-md-4">
			
                <h5 class="title-footer mb-4 mt-3 font-bold">Address</h5>
				<p>Plot No. 177, Sri Vani Nilayam, 1st floor,Beside Sri Chaitanya High School, Sardar Patel Nagar, Nizampet Road,  Hyderabad, Telangana, 500072</p>
               
            </div>
            <!--/.First column-->

            <hr class="clearfix w-100 d-md-none">

            <!--/.Second column-->

            <hr class="clearfix w-100 d-md-none">

            <!--Third column-->
            <div class="col-md-4 mx-auto">
                <h5 class="title-footer mb-4 mt-3 font-bold">Contact</h5>
				 <label>Mobile No : 9439xxxxxx</label>
				
				 <label>Email ID &nbsp;&nbsp;&nbsp; : supportxxx@dummy.com</label>
				 <br>
				 <br>
				 
            </div>
            <!--/.Third column-->

            <hr class="clearfix w-100 d-md-none">

            <!--Fourth column-->
            <div class="col-md-2 mx-auto">
                <h5 class="title-footer mb-4 mt-3 font-bold ">Qucik Links</h5>
                <ul>
					<li><a href="" >Home</a></li>
					<li><a href="#aboutus">About Us</a></li>
					<li><a href="#features">features</a></li>
                    <li><a href="#faq">FAQ's</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                   
                </ul>
            </div>
            <!--/.Fourth column-->
        </div>
    </div>
    <!--/.Footer Links-->

    <hr>

 

    <!--Social buttons-->
    <div class="social-section text-center footer-copyright">
        <ul>

            <li><a class="btn-floating btn-sm btn-fb"><i class="fa fa-facebook"> </i></a></li>
            <li><a class="btn-floating btn-sm btn-tw"><i class="fa fa-twitter"> </i></a></li>
            <li><a class="btn-floating btn-sm btn-gplus"><i class="fa fa-google-plus"> </i></a></li>
            <li><a class="btn-floating btn-sm btn-li"><i class="fa fa-linkedin"> </i></a></li>
            <li><a class="btn-floating btn-sm btn-dribbble"><i class="fa fa-dribbble"> </i></a></li>

        </ul>
    </div>
 

</footer>
<!--/footer end -->
            
    <!-- start js include path -->
   <script type="text/javascript" src="<?php echo base_url(); ?>>assets/vendor/plugins/vendor/js/bootstrap.min.js"></script>
	
    
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/plugins/vendor/js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/plugins/vendor/js/compiled.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/plugins/vendor/js/mdb.min.js"></script>
	<script>
$(document).ready(function(){
  // Add scrollspy to <body>
  $('body').scrollspy({target: ".navbar", offset: 50});   

  // Add smooth scrolling on all links inside the navbar
  $("#navbarSupportedContent a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }  // End if
  });
});
</script>
	<script>
$('.scrolltotop').on('click', function() {
          $('html, body').animate({ scrollTop: 0 }, 800);
          return false;
      });

      $(document).scroll(function() {
          var y = $(this).scrollTop();
          if (y > 300) {
              $('.scrolltotop').fadeIn();
          } else {
              $('.scrolltotop').fadeOut();
          }
      });
</script>
</body>

</html>

