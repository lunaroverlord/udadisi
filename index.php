<!DOCTYPE html>

<html lang="en">

   <head>
	  <meta charset="utf-8">

	  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>

      <title>Udadisi</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="udadisi.css">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	  <script src="date.format.js"></script>
	  <script src="js/libs/d3.js"></script>
	<script type="text/javascript" src="udadisi.js"> </script>
   </head>

   <body>
            <nav class="navbar navbar-default">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>                        
               </button>
               <br/>
               <img src="logo.jpg" style="width:90px;height:90px;margin-left:50px;">
               <br/>
            </div>
            <br/>

            <br/>
            <div class="collapse navbar-collapse" id="myNavbar" style="float:left">
               <ul class="nav navbar-nav">
                  <li class="active"><a>Home</a></li>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Contacts</a></li>
               </ul>
            </div>
            <div>
               <ul class="nav navbar-nav navbar-right">
<br/>
                  <input type="text" id="search" style="width:550px;margin-right:50px;float:right"/>
                  <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                     <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
               </ul>
            </div>
         </div>
         <br/>
      </nav>

	  <div id="main" role="main">
	      <div id="view_selection" class="btn-group">
		<a href="#" id="all" class="btn active">All Items</a>
		<a href="#" id="year" class="btn">Items By Year</a>
		<a href="#" id="cat" class="btn">Items By Category</a>
		<a href="#" id="time" class="btn">Timeline</a>
	      </div>
		<div id="bubbles_block">
			<div id="strip_categories"></div>
			<div id="strip_years"></div>
			<div id="vis"></div>
		</div>
		<div id="timeline_block">
		 <div id="timeline"></div>
		</div>
	</div>
      <!-- <nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>                     
               </button>
                <a class="navbar-brand" href="#">Udadisi</a>
             </div>
           <div class="collapse navbar-collapse" id="myNavbar">
               <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Contact</a></li>
               </ul>
                  <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><span class="glyphicon glyphicon-icon-twitter-t"></span> Sign Up</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-icon-facebook"></span> Login</a></li>
                  </ul> 
            </div>
         </div>
         </nav>
         <h2 class="logo"> 
         <img src="http://s1.postimg.org/c6gfcsinz/dcrr.jpg" style="width:150px;height:150px;margin-left:50px;">
         </h2>-->
      <div class="container">
         <!-- <center><img src="http://flowingdata.com/wp-content/uploads/2012/09/His-and-Hers-Colors-by-Stephen-Von-Worley-620x454.png" style="width:90%;height:90%;"></center> -->
      </div>
      <br/>
      <div class="row">
         <div class="col-md-4">
            <p style="margin-left:30px;margin-right:30px;"> As part of SmartDataHack 2015, we have formed a team to respond to Practical Action's Challenge: how can data from social media and news media sources build a picture of innovation in and around Nairobi, Kenya? </p>
         </div>
         <div class="col-md-4">
            <p>Udadisi, meaning "curiosity" in the Swahili language, is a diverse team of innovators, tackling technology justice issues in East Africa.</p>
         </div>
         <div class="col-md-4">
            <p style="margin-left:30px;margin-right:30px;" >Our goal: to visualize the data in a way that is informative and tells a story about various types of emerging technology trends in this dynamic and vibrant city.</p>
         </div>
      </div>
      </div>
<!--
      <iframe src='http://cdn.knightlab.com/libs/timeline/latest/embed/index.html?source=0Agl_Dv6iEbDadHdKcHlHcTB5bzhvbF9iTWwyMmJHdkE&font=Bevan-PotanoSans&maptype=toner&lang=en&height=550' width='95%' height='550' frameborder='0' style="margin-right:30px;margin-left:30px"></iframe> -->
      </div>
      <div class="wrapper">
         <div class="push"></div>
      </div>
      <div class="footer">
         <br/>
         <p class="text-center"> <font size="2" color="white">&copy Udadisi 2015</font></p>
         <br/>
      </div>

   </body>

	  <script src="js/CustomTooltip.js"></script>
	  <script src="viz.js"></script>
	<script type="text/javascript" src="http://cdn.knightlab.com/libs/timeline/latest/js/storyjs-embed.js"></script>
</html>
