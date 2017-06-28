<?php
/***********************
*Author: Shane Workman
        -made while watching Lynda.com Ray Villalobos course. Released 8/26/2015
*Date: 06/27/2017
*Purpose: landing page for testing bootstrap.
**************************/
$page_title = 'Shane\'s Bootstrap Home';
include_once ('_include/header.php');
?>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a href="#" class="navbar-brand">
        Home </a>
      <buton type="button"
        class="navbar-toggle collapsed"
        data-toggle="collapse"
        data-target="#menu"
        aria-expanded="false">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
         </button>
    </div>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="nav navbar-nav">
          <li><a href="#">Home</a></li>
          <li><a href="#">Mission</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Staff</a></li>
          <li><a href="#">Testimonials</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class ="container content">
  <h1 class="">Fun With Bootstrap 4.0</h1>
</div>
<hr>
<div class="container">
<div class="container-fluid">
  <div class="row">
    <section class="col-md-4 col-xs-12">
      <h1>What is Lorem Ipsum?</h1>
        <p><b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry.
          Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
          an unknown printer took a galley of type and scrambled it to make a type specimen book.
          It has survived not only five centuries, but also the leap into electronic typesetting,
          remaining essentially unchanged. <blockquote><p>It was popularised in the 1960s with the release
          of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
          like Aldus PageMaker including versions of Lorem Ipsum.</p><footer>Shane Workman</footer></blockquote>
        </p>
        <button class="btn btn-large btn-block btn-danger">Button</block>
    </section>
    <section class="col-md-4 col-xs-12">
      <h1>Second Headline</h1>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est ante, suscipit nec fringilla non,
          finibus non tortor. Nulla elementum ornare elit non eleifend. Proin tortor libero, dictum sed magna at,
           tristique pretium erat. Duis feugiat feugiat orci, euismod mattis dolor tristique in. Suspendisse quis
           est finibus ex congue consequat vitae nec magna. Quisque commodo orci porta, rutrum nisl vitae, tincidunt
            felis. Vivamus tincidunt nunc sit amet nisl sodales fringilla. Etiam vulputate dapibus sapien, ac
            aliquet ipsum aliquet ac. Fusce at bibendum urna. Ut fermentum convallis lobortis. In tempor accumsan
            feugiat. Donec mi tellus, porttitor at tristique vitae, blandit et lorem. Pellentesque lacinia tortor
            ligula, eu gravida libero venenatis a.
        </p>
        <a class="btn btn-large btn-block btn-info" role="button" href"#">Link</a>
    </section>
    <section class="col-md-4 col-xs-12">
      <h1>Third Headline</h1>
        <p>
          Nullam rutrum pulvinar scelerisque. Nunc ac neque sit amet ex mollis commodo. Maecenas et dictum justo,
          ut vulputate ipsum. Sed mollis urna nulla, a fringilla odio interdum eget. Suspendisse hendrerit dapibus
          viverra. Etiam efficitur sapien nisl, nec pharetra nibh venenatis nec. Maecenas imperdiet felis at arcu
          convallis, sit amet aliquet odio accumsan.
        </p>
        <input class="btn btn-large btn-block btn-success" type="submit" value="Input">
    </section>
  </div>
</div>
<hr>
<h1>Tables</h1>
<div class="container">
  <div class="row">
    <section class="col-xs-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Class</th>
              <th>Color</th>
              <th>Description</th>
            <tr>
          </thead>
          <tbody>
            <tr>
                <th scope="row">Normal</th>
                <td class="active" >Default</td>
                <td>Default color to a particular row or cell</td>
            </tr>
            <tr class="active">
                <th scope="row">active</th>
                <td>Gray</td>
                <td>Active color to a particular row or cell</td>
            </tr>
            <tr>
                <th scope="row">success</th>
                <td>Green</td>
                <td>A successful or positive action</td>
            </tr>
            <tr>
                <th scope="row">info</th>
                <td>Blue</td>
                <td>A neutral informative change or action</td>
            </tr>
            <tr>
                <th scope="row">warning</th>
                <td>Yellow</td>
                <td>A warning that might need attention, but not too scary</td>
            </tr>
            <tr>
                <th scope="row">danger</th>
                <td>Red</td>
                <td>Dangerous or potentially negative action</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
</div>
<?php
include_once ('_include/footer.php');
?>
