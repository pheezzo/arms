<?php //include('sys/connect.php');
//$conf_code = $_GET['conf'];
include('sys/functions.php');
require_once('include/front_header.php');		?>	
    
    
    <div id="contents">
		<div class="clearfix">
			<div class="sidebar">
				<div>
					<h2>Contact Info</h2>
					<ul class="contact">
						
						<li>
							<p class="phone">
								Phone: (+20) 000 222 999
							</p>
						</li>
						<li>
							<p class="fax">
								Fax: (+20) 000 222 988
							</p>
						</li>
						<li>
							<p class="mail">
								Email: info@articlemanager.com
							</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="main">
				<h1>Contact</h1>
				<h2>Send Us a Quick Message</h2>
				<p>
					You can remove any link to our website from this website template, you're free to use this website template without linking back to us.If you're having problems editing this website template, then don't hesitate to ask for help on the Forums.
				</p>
				<form action="index.html" method="post" class="message">
					<label>First Name</label>
					<input type="text" value="">
					<label>Last Name</label>
					<input type="text" value="">
					<label>Email Address</label>
					<input type="text" value="">
					<label>Message</label>
					<textarea></textarea>
					<input type="submit" value="Send Message">
				</form>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="clearfix">
			<div class="section">
				<h4>Latest News</h4>
				<p>
					This website template has been designed by Free Website Templates for you, for free. You can replace all this text with your own text. You can remove any link.
				</p>
			</div>
			<div class="section contact">
				<h4>Contact Us</h4>
				<p>
					<span>Address:</span> the address city, state 1111
				</p>
				<p>
					<span>Phone:</span> (+20) 000 222 999
				</p>
				<p>
					<span>Email:</span> info@freewebsitetemplates.com
				</p>
			</div>
			<div class="section">
				<h4>SEND US A MESSAGE</h4>
				<p>
					If you're having problems editing this website template, then don't hesitate to ask for help on the Forums.
				</p>
				<a href="http://www.freewebsitetemplates.com/misc/contact/" class="subscribe">Click to send us an email</a>
			</div>
		</div>
		  <?php require_once('include/front_footer.php'); ?>