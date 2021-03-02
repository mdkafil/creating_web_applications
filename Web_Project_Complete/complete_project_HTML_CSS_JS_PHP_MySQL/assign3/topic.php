<!-- This is the topic page.
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
	<script src="script/topic.js"></script>
</head>
<body>
	<?php
		//include the header and navigation bar.
		include ('header.inc');
		include ('menu.inc');
	?>
	<article id="topic_article">
		<h2 class="topic_h2">Domain Name System</h2>
		<div id="video">
			<h3>Here is a video to explain the DNS:</h3>
			<iframe width="560" height="315" src="https://www.youtube.com/embed/72snZctFFtA" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
		</div>
	<div id="topic_section">
		<section id="topic_s1">
			<h3>What is Donmain Name System?</h3>
			<p>The Domain Name System was born in the early 1980s when Paul Mockapetris came up with a system that automatically mapped <a href="topic.html#IP_address">IP addresses</a> to domain names. This system still serves as the backbone of the modern Internet and lasts in the future. DNS is one of the application layer protocols of TCP/IP protocol suite. The main function of DNS is to translate domain names, such as www.swin.edu.au, into IP address. Therefore, DNS severs eliminate the need for human to memeorize IP address.</p>
			<figure>
				<img src="styles/images/what-is-dns.png" alt="What is DNS?" width="217" height="175" />
				<figcaption>What is DNS?</figcaption>
			</figure>
		</section>
		<section id="topic_s2">
			<h3>DNS Servers</h3>
			<dl>
				<dt>Recursive Resolver</dt>
					<dd>The DNS recurive resolver receives the query from Internet Service Provider(ISP) and knows which oter DNS server to answer the query.</dd>
				<dt>Root Server</dt>
					<dd>The root server is the first server for the query to translate the top level domain such as .com into IP address.</dd>
				<dt>TLD Name Server</dt>
					<dd>The top level domain name server (TLD) stores the information for second level domains with the top level domain (google.com) and passes it to the authoritative nameserver.</dd>
				<dt>Authoritative Name Server</dt>
					<dd>With the help of domain's register, the authoritative name server can return the IP address for the requested hostname back to the recursive resovler.</dd>
			</dl>
		</section>
		<section id="topic_s3">
			<h3>DNS lookup</h3>
			<ol>
				<li>The user type the URL, such as www.google.com in the web browser.</li>
				<li>It will translate into the query,which is received by a DNS recursive resolver.</li>
				<li>The resolver takes the query to the root nameserver.</li>
				<li>The root nameserver receives the query and responds to the resolver with the address of a TLD nameserver.</li>
				<li>The resolver then makes a request to the .com TLD.</li>
				<li>The TLD server takes the query to the authoritative namesever.</li>
				<li>The authoritative nameserver translates the query into the IP address.</li>
				<li>Lastly, the resovler will respond  to the web browser with the IP address for www.google.com.</li>
			</ol>
		</section>
		<section id="topic_s4">
			<h3>DNS queries</h3>
			<table>
				<caption>The types of DNS queries</caption>
				<thead>
					<tr>
						<th scope="col">Type</th>
						<th scope="col">Definiton</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">Recursive query</th>
						<td>A DNS client requires that the DNS resolver responds to the client with either the requested resource record or an error message if the resolver can't be found, starting from the root server until the authoritative name server.</td>
					</tr>
					<tr>
						<th scope="row">Iterative query</th>
						<td>The DNS client provides a hostname and allows the DNS resovler to return the best answer it can. If the queried DNS server does not have a match for the query name, it will return a referral to a authoritative name server. The DNS client must make a query to the referral address.</td>
					</tr>
					<tr>
						<th scope="row">Non-recursive query</th>
						<td>The DNS resolver either returns a DNS record immdiately or query the DNS name server, because it has access to either it's authoritative for the record or the record exists in its local cache. </td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th scope="row">Result</th>
						<td>By using a combination of these queries, an optimized process for DNS resolution can result in a reduction of distance travel. </td>
					</tr>
				</tfoot>
			</table>
		</section>
		<section id="topic_s5">
			<h3>DNS caching</h3>
			<p>Users' Internet Service Provider (ISP) can operate the recursive resolver and cach the DNS records. Therefore, if a IP address is cached in the DNS server, it will be returned immidiately, which avoids the further DNS lookup chain. However, these records only survive for a short period. Users could set an amount of time for living (Time to live, TTL), which ranges from 30 seconds to a week.</p>
		</section>
	</div>
	</article>
	<aside id="topic_aside">
		<section id="IP_address">
			<h3 >IP address</h3>
			<blockquote cite="https://en.wikipedia.org/wiki/IP_address">An Internet Protocol address (IP address) is a numerical label assigned to each device connected to a computer network that uses the Internet Protocol for communication. An IP address serves two main functions: host or network interface identification and location addressing.</blockquote> 
			<p>For more information, click <a href="https://en.wikipedia.org/wiki/IP_address">here</a>.</p>
		</section>
		<section id="svg">
			<h3>Link</h3>
			<svg width="400" height="150">
				<defs>
					<filter x="0" y="0" width="200%" height="200%" id="rec">
						<feOffset result="offOut" in="SourceGraphic" dx="25" dy="25" />
						<feBlend in="SourceGraphic" in2="offOut" mode="normal" />
					</filter>
				</defs>
				<rect width="90" height="110" stroke="black" stroke-width="3" fill="lightgray" filter="url(#rec)" />
				<text x="130" y="75" fill="darkred">Click the button to take a short quiz!</text>
			</svg>
			<button type="button" id="link_quiz">To Quiz</button>
		</section>
	</aside>
	<footer>
		<hr />
		<p><i class="material-icons">attachment</i>Reference:</p>
		<ol>
			<li>https://www.cloudflare.com/learning/dns/what-is-dns/</li>
			<li>https://dnsmadeeasy.com/support/what-is-dns/</li>
			<li>https://www.verisign.com/en_US/website-presence/online/how-dns-works/index.xhtml</li>
			<li>https://en.wikipedia.org/wiki/Domain_Name_System</li>
			<li>https://en.wikipedia.org/wiki/IP_address</li>
			<li>https://www.youtube.com/watch?v=72snZctFFtA</li>
		</ol>
	</footer>
	<hr />
	<?php
		// include the footer.
		include ('footer.inc');
	?>
</body>
</html>