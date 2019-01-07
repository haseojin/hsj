<div id="page" class="container">
	<div id="header">
		<div id="logo">
			<img src="/images/logo.jpg" alt="" />
			<h1><a href="http://hsj7861.cafe24.com/">HaSeoJin</a></h1>
			<!--<span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a></span>-->
		</div>
		<div id="menu">
			<ul>


				<?php if($title=="about"){ ?>
				<li class="current_page_item">
				<?php }else{ ?>
				<li>
				<?php	} ?>
				<a href="/bbs/about" accesskey="1" title="">About</a></li>


				<?php if($title=="skill"){ ?>
				<li class="current_page_item">
				<?php }else{ ?>
				<li>
				<?php	} ?>
				<a href="/bbs/skill" accesskey="2" title="">skill</a></li>


				<?php if($title=="portfolio"){ ?>
				<li class="current_page_item">
				<?php }else{ ?>
				<li>
				<?php	} ?>
				<a href="/bbs/portfolio" accesskey="3" title="">Portfolio</a></li>


				<?php if($title=="qanda"){ ?>
				<li class="current_page_item">
				<?php }else{ ?>
				<li>
				<?php	} ?>
				<a href="/bbs/qna" accesskey="4" title="">Q&A</a></li>


			</ul>
		</div>
	</div>


	<div id="particles"></div>
