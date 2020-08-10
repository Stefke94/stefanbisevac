<?php
	require_once APP_ROOT.'/views/includes/header.php';
?>
	<main>
		<section class="main_heading">
			<h1>About Me</h1>
		</section>
		<section id="details_section">
			<article id="basic_info">
				<section id="img_section">
					<figure>
						<img src="<?php echo URL_ROOT; ?>/images/stefan/stefan.jpg">
						<figcaption>Stefan & Laki (Lucky)</figcaption>
					</figure>
				</section>
				<section id="info_article">
					<h1 class="headings">Stefan Bisevac</h1>
					<ul>
						<li>April 4<sup>th</sup>, 1994</li>
						<li>Belgrade</li>
						<li>e-mail: biskeyoo@gmail.com</li>
					</ul>
				</section>
			</article>
			<article class="info_article">
				<section class="headings_section">
					<img src="<?php echo URL_ROOT; ?>/images/icons/computer_icon.png">
					<h1 class="headings">Skills</h1>
				</section>
				<section id="skills_section">
					<article class="skills_language_article">
						<img src="<?php echo URL_ROOT;?>/images/logos/php_logo.png">
						<p>PHP</p>
					</article>
					<article class="skills_language_article">
						<img src="<?php echo URL_ROOT;?>/images/logos/mysql_logo.png">
						<p>MySQL</p>
					</article>
					<article class="skills_language_article">
						<img src="<?php echo URL_ROOT;?>/images/logos/javascript_logo.png">
						<p>JavaScript</p>
					</article>
					<article class="skills_language_article">
						<img src="<?php echo URL_ROOT;?>/images/logos/html_logo.png">
						<p>HTML</p>
					</article>
					<article class="skills_language_article">
						<img src="<?php echo URL_ROOT;?>/images/logos/css_logo.png">
						<p>CSS</p>
					</article>
				</section>
			</article>
			<article class="info_article">
				<section class="headings_section">
					<img src="<?php echo URL_ROOT; ?>/images/icons/education_icon.png">
					<h1 class="headings">Education</h1>
				</section>
				<section id="education_table_section">
					<table>
						<caption>Formal Education</caption>
						<thead>
							<th>College/School</th>
							<th>Department</th>
							<th>Start/End</th>
						</thead>
						<tbody>
							<tr>
								<td>IT Academy</td>
								<td>PHP Web Development</td>
								<td>2017-2018</td>
							</tr>
							<tr>
								<td>ICT College of vocational studies</td>
								<td>Telecommunications sector, Belgrade</td>
								<td>2013-2018</td>
							</tr>
							<tr>
								<td>Technical High school PTT</td>
								<td>Electrical engineer of telecommunications</td>
								<td>2009-2013</td>
							</tr>
						</tbody>
					</table>
				</section>
			</article>
			<article class="info_article">
				<section class="headings_section">
					<img src="<?php echo URL_ROOT; ?>/images/icons/user_icon.png">
					<h1 class="headings">About me</h1>
				</section>
				<section id="about_section">
					<p class="about_p"><span>H</span>ello there! I am Stefan Bisevac (junior) Full Stack Web Developer from Serbia. I started learning telecommunications and I found out in third year of college that I love to program, so I started programing.
					</p>
					<p class="about_p"> So here I am, doing what I love and that is programming. But of course, programming isn't only thing I love doing, I love any work on/with computers (fixing/building/maintain them).
					Beside computers I love other things too like animals. Trained many sports, team alike and solo. Like reading books too, whether its Dostoyevski or technical book about Linux or any computer related topic.
					</p>
					<p class="about_p">
						Currently working as system administrator in highschool, before that worked as system administrator and teacher in same school. Fun fact: thats the same school I went to.
					</p>
					<p class="about_p">
					What kind of person I am? Well, that on You to find out. :)
					</p>
				</section>
			</article>
		</section>
	</main>
<?php
	require_once APP_ROOT.'/views/includes/footer.php';
