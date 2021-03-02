<!-- This is the index page.
Author: MD Kafil Uddin
Created: 21 Oct
Last updated: 28 Oct -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Assignment 1" />
	<meta name="keywords" content="html,css,dns" />
	<meta name="author" content="MD Kafil Uddin" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Domain Name System</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
</head>
<body id="index">
	<?php
		// include the header and navigation bar.
		include ('header.inc');
		include ('menu.inc');
	?>
	<div id="body">
	<article>
		<h2>Domain Name System is my assignment</h2>
		<section id="index_s1">
			<h3>My assignment</h3>
			<p>Basically, my assignment includes four html files and a css file.</p>
				<ul id="index_ls">
					<li>the index.html</li> 
					<li>topic.html</li> 
					<li>quiz.html</li>
					<li>enhancements.html</li>
					<li>styles.css</li>
				</ul>
		</section>
		<section id="index_s2">
			<h3>Introduction</h3>
			<p>The index page is the home page. I will introduce the DNS in the topic page. Then there is a quiz page related to the DNS. Meanwhile, the enhancements page will list any enhancements I have made. Last, I use the CSS to style my website.</p>
		</section>
		<section id="index_s3">
			<h3 id="image">DNS Image</h3>
			<p>It is insteresting to explore what the DNS is!</p>
			<figure>
				<img src="styles/images/dns.jpg" alt="Domain Name System" height="246" width="512" id="index_img" />
				<figcaption>Domain Name System</figcaption>
			</figure>
		</section>
	</article>
	<aside id="index_aside">
		<h3>Assignemnt details</h3>
		<p>The assignment one should be submitted to ESP by 8am of my week 5 tutorial (Wednesday) and be demonstrated in the tuorial.</p>
		<p id="map">Here is the location of Swinburne University of Technology:
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.6295099445074!2d145.0367659150542!3d-37.82214614229566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642326bae5aaf%3A0x75e96bbd4988f769!2sSwinburne%20University%20of%20Technology!5e0!3m2!1sen!2sau!4v1567490538333!5m2!1sen!2sau" width="400" height="250" allowfullscreen=""></iframe></p>
	</aside>
	<footer>
		<hr />
		<p><i class="material-icons">attachment</i>Reference:</p>
		<ol>
			<li>the image is from https://cdome.comodo.com/what-is-dns.php.</li>
			<li>https://www.google.com/maps</li>
		</ol>
	</footer>
	<hr />
	<?php
		// include the common footer.
		include ('footer.inc');
	?>
	</div>
</body>
</html>