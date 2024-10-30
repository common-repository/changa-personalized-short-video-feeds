<style type="text/css">
	body{
		height: auto;
		background-color : #ffb9b3;
		overflow-x: hidden;
	}
	#wpfooter{
		display: none;
	}
	.main-content-wrapper {
		z-index: 1000;
		flex: 1;  margin: 0;  padding: 3px;
		width: 100%; height: 100%; background-color : #ffb9b3;
		padding-bottom: 20px;
	}
	.title{
		font-family: Poppins, sans-serif; font-size: 4.5rem;font-weight: 300;line-height: 1.2; margin: 0; padding: 1rem 0px 0px 0px;
	}
	.titlehr {
		width: 100px; color: black; width: 200px; height: 1px; background-color: black; border: 0;
	}
	.saying {
		font-weight: 500; font-size:1.5rem; padding: 0; margin: 10px 0px;
		line-height: 1.7rem; text-align: center;
	}
	.saying-by{
		text-align: right; margin: 0; 
	}

	.step{
		margin : 0px 20px 40px;
		display: flex;
		flex-direction: column;
		flex: 0.3 0 200px;
		background-color: white;
		border-width: 1px;
		border-color: #4c4c4c;
		border-radius: 6px;
		padding: 3px;
		align-items: center;
		justify-content: center;
		position: relative;
		padding-bottom: 20px;
	}
	.step>h3{
		text-align: center;
	}
	.stepsWrapper{ 
		width: 100%; 
		display: flex; 
		flex: 1;
		flex-wrap: wrap; 
		flex-direction: row; 
		justify-content: space-around
	}
	.msg_wrapper{
		display: flex; align-items: center; justify-content: center; flex-direction: column;
		margin: 1rem;
	}
	.msg {
		font-weight: 200; font-size: 1.5rem; line-height: 1.9rem; padding: 5px; margin: 0px;
		text-align: center;
	}
	.your-content{
		font-style: italic;
		text-align: center;

	}
	.hashtag{
		font-weight: bold;
	}
	.right-wrong{
		display: flex;
		flex: 0.5;
		flex-direction: row;
	}
	.right{
		margin-right: 10px;
	}
	.right::before{
		content : '✔';
		color : green;
		padding: 3px;
	}
	.wrong::before{
		content : '✖';
		color : red;
		padding: 3px;
	}

	.stepCounter{
		margin : 0;
		padding: 0;
		height: 40px;
		width: 40px;
		border-radius: 20px;
		background-color: black;
		color: white;
		font-weight: bold;
		font-size: 24px;

		position: absolute;
		bottom: -20px;
		display: flex;
		align-items: center;
		justify-content: center;
		align-self : center;
	}
	.changa-setup-container{
		margin-top: 50px;
		display: flex; justify-content: center; align-items: center; flex-direction: column;
	}
	.changa-setup-btn{
		margin: 10px; padding: 10px 22px; background-color: black; border-width:0px; box-shadow: 0px 4px 10px 3px #4c4c4c; color: white; font-family: Poppins, sans-serif; font-size: 2.0rem;font-weight: 300;line-height: 1.2; 
			color: white; 
	}
	.changa-setup-btn:hover{
		cursor: pointer;
	}
	.look-after-integration{
		display: flex; flex: 0.5; padding: 0 10px; flex-direction: column;
	}

	.look-after-integration>h2{
		font-size: 2.5rem; line-height: 1.3; margin : 3px;
	}
	.changa-divMsg-wrapper{
		display: flex; flex: 1; justify-content: space-around; align-items: center; flex-wrap: nowrap;
	}
	.steps-title{
		width: 100%;
		text-align: left;
		margin-top: 20px;
		line-height: normal;
	}
	.steps-note{
		text-align: center;
		margin-top: 40px;
	}

	.changa-feeds-row1{
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-between;
	}
	.changa-feeds-row1  a{
		margin-bottom: 30px;
		text-decoration: none;
	    color: black;
	    font-size: 16px;
	    font-weight: 500;
	}
	.changa-feeds-row1 > p{
		padding: 50px 0px 0px 10px;
		margin: 0;
		font-size: 22px;
		font-weight: bold;
	}
	._btnWrapper{

	}
	._btn{
		margin: 5px;
	    padding: 6px 12px;
	    background-color: #dfeaaf;
	    border-radius: 5px;
	    box-shadow: 5px 2px 16px #dfeaaf;;

	}
	.changa-feeds-container{
		display: flex;
		margin: 0;
		padding : 10px;
		flex-wrap: wrap;
		flex: 1 200px;
		justify-content: center;
	}
	.changa-feeds-container  p{
		margin: 0;
		padding: 0;
	}
	.changa-feed{
		background-color: white;
		border-radius: 6px;
		flex-direction : column;
		padding: 10px;
		margin: 10px;
		display: flex;
		flex : 3 ;
		max-width: 33vw;
		align-items: center;
		justify-content: center;
		position: relative;
		box-sizing: border-box;

	}
	.feed-type{
		margin-top: 10px;
		font-weight: bold;
	}
	.feed-name{
		font-weight: bold;
		font-size: 22px;
		width: 100%;
		text-align: center;
	}
	.feed-type{
		display: flex;
		flex  : 1;
		flex-direction: row;
	}
	.tags-users{

	}
	.onHover{
		display: none;
	}
	.changa-feed:hover {
		box-shadow : 1px 1px 8px 1px black;

	}
	/*.changa-feed:hover .feed-name:before{
		content : '[changa ';
	}
	.changa-feed:hover .feed-name:after{
		content : ']';
	}*/
	.heres-your-short-code{display: none;}
	.changa-feed:hover .heres-your-short-code{
		    position: absolute;
		    top: -15px;
		    display: flex;
		    background-color: white;
		    padding: 6px 12px;
		    border-radius: 6px;
		    box-shadow: 1px -5px 9px -4px black;
	}

	.feed-name-hover{
		width: 100%;
		opacity: 0;
		transform : translateY(-34px);
		height: 34px;
	}
	.changa-feed:hover .feed-name {
		opacity: 0;
	}
	.changa-feed:hover .feed-name-hover {
		opacity: 1;
	}


	/*.changa-feed:hover .onHover{
			position: absolute;
			top: 0; bottom: 0; right: 0; left: 0;
			background-color : rgba(255,255,255,0.6);
			display: flex;
			align-items: center;
			justify-content: center;
		}*/
	.info{
		font-size: 20px;
		color: black;
		border-bottom: solid 1px red;
		font-weight: 500;
		margin: 10px;
		text-align: center;
		width: 100%;
	}
	.block{
		margin: 10px;
		width: auto;
		padding: 12px 24px;
	}
	.btn{
		background-color: #4c4c4c;
		color : white;
		font-weight: 500;
		font-size: 24px;
		align-items: center;
		justify-content: center;
		border-radius: 5px;
		text-align: center;
		line-height: 26px;
		text-decoration: none;
		/*width: 250px;*/
	}
	.btn:hover{
		color: white;
		cursor: pointer;
	}
	.noActive:active{
		color: white;
	}
	.noActive:visited{
		color: white;
	}



	/*Selectors*/
	.generic-wrapper{   
		padding: 10px;
	    width: 70vw;
	    margin: auto;
	    background-color: #e6aba7;
	    border-radius: 6px;
	    box-shadow: 1px 1px 17px 22px #eac3c09c;
	    align-items: center;
	    margin: 20px auto;

        padding: 10px;
	    width: 70vw;
	    margin: auto;
	    background-color: #ffffffe0;
	    border-radius: 6px;
	    box-shadow: 1px 1px 2px 1px #eac3c09c;
	    box-shadow: 1px 1px 19px 5px #080606;
	    align-items: center;
	    margin: 20px auto;
	}
	.generic-msg{
		text-align: center;
	}
	.selectors-wrapper{
		display: flex;
		flex : 1;
		flex-direction: row;
		justify-content: space-around;
		flex-wrap: wrap;
	}
	.para-select , .feed-select{
		text-align: center;
		justify-content: center;
		text-align: center;

	}
	.feed-select{}
	.para-select{}
	.generic-update:hover{
		cursor: pointer;
	}
	.generic-update{
		margin: auto;
		padding: 6px 12px;
		background-color: #5cb85c;
		border : none;
		color: white;
		font-size: 18px;
		border-radius: 5px;

	}

	@media (max-width: 778px){
		.feed-select-title{
			font-size:20px;
			line-height: 22px;
			font-weight: 400;
		}
		.long-text{
			font-size: 1.2rem;
			line-height: 1.5rem;
			padding-bottom: 10px;
		}
		.title {
			font-size: 3rem;
		}
		.changa-divMsg-wrapper{
			flex-wrap: wrap;
		}
	}

</style>

<?php

	$changabizUrl = 'https://business.changa.in';
	// $changabizUrl = 'http://localhost:3000';

	$callbackUrl = admin_url().'admin.php?page=changa_setting_page';
	$changaLoginUrl = $changabizUrl.'/login';
	$fullCallbackUrl =  $changaLoginUrl.'?callbackurl='.$callbackUrl;
	$changaFeedsUrl = $changabizUrl.'/feed';
	$changaCreateFeedUrl = $changabizUrl.'/create/feed';

	$changa_generic_feed_appid = get_option('changa_generic_feed_appid', false);
	$changa_generic_para = get_option('changa_generic_para', false);

		?>

			<div class = "main-content-wrapper">
				<div style =  "display: flex; align-items: center; justify-content: center; flex-direction: column">
					<h3 class="title" > Changa Biz</h3>
					<hr class = "titlehr" /> 
					<div style = "padding: 3px">
						<h3 class = "saying">Content Writing is an art so is Media Content Selection.</h3>
						<p class = "saying-by">- Anonymous </p>
					</div><br/>

					<div class = "msg_wrapper">
						<!-- <h3 class = "msg long-text">We are here to help you find media rich content for your Posts.</h3> -->
						<h3 class = "msg long-text">Changa Plugin makes it easy to embed Media Rich Content.</h3>
						<h3 class = "msg long-text">Improve user engagement with <b> trending, most liked </b>and <b>most relevent </b> media for for content.</h3>
					</div>

					<h1 class = "steps-title">Here's how to integrate Changa </h1>
					<div class = "stepsWrapper" > <!-- steps -->
						<div class = "step" >
							<p class="stepCounter">1</p>
							<h3> Write Down Your Content </h3>
							<p style = "text-align: center">Remember Content is everything</p>
						</div>
						<div class = "step" >
							<p class="stepCounter">2</p>
							<h3>Curate your form feed </h3>
							<p style = "text-align: center">on Changa Admin</p>
						</div>
						<div class = "step">
							<p class="stepCounter">3</p>
							<h3>Add the short-code </h3>
							<div>
								<p class = "your-content"> ... Your Content ...</p>
								<p class = "hashtag" style = "text-align: center;"> [changa feedName]</p>
								<!-- <div style = "flex-direction: row">
									<div class = "right-wrong"> <p class="right">[# food]</p> <p class="wrong">[#food]</p></div>
								</div> -->
								<p class = "your-content"> ... Your Content ... </p>
							</div>
						</div>

						<div class = "step">
							<p class="stepCounter">4</p>
							<h3> Publish Your Content </h3>
						</div>
					</div>
					<!-- <p class = "steps-note"> -->
						<!-- <b>For hashtag</b> shortcode is &nbsp; &nbsp; [#⎵tagname]  <b> "SPACE" </b><br/> -->
						<!-- If you don't add any shortcode changa will automatically embed most trending videos after for first paragraph<br/> -->
						<!-- We advice you to use shortcode <b>[# hashtag]  </b> to serve the most relevant videoes for your content. -->
						<p> <a href = "<php echo $changaCreateFeedUrl ?>"> Create</a> relevant content for posts on changa Admin panel.</p>
						<p><a href = "<?php echo $fullCallbackUrl?>">Refresh </a> and Sync wordpress to changa admin.</p>

					</p>
				</div>

				<div class = "changa-divMsg-wrapper">

					<div class = "look-after-integration"> 
						<h2 > This is how it will look after integration </h2>
						<hr class = "titlehr" /> 
					</div>

					<div style = "display: flex;min-width: 60%; width: 100%;">
						<div id="changa-slider" appid="f0626ff3-ba6b-41fc-a259-75ea2a661b6e" slider-type="vertical" style = "width: 100%;"></div>	
					</div>

				</div>

				<?php
					if(!get_option('changa_feeds', false)){
						?>
							<div class = "changa-setup-container">
								<h1>Setup Changa for your Site</h1>
								<a href = "<?php echo $fullCallbackUrl ?>"> <button class = "changa-setup-btn"> Get Started </button> </a>
							</div>
						<?php		
					}else{
						$feeds = get_option('changa_feeds');
						$feeds = json_decode($feeds);
						// var_dump($feeds);
						?>	
							<div class = "changa-feeds-row1">
								<p> Feeds from changa lite </p>
							</div>

				<!--Feeds from Changa Dashboard -->
						<div class= "changa-feeds-container">
							<?php
								if($feeds && count($feeds) > 0){
								foreach($feeds as $feed){
							?>
									<div class = "changa-feed" 
										>
										<div class = "onHover"> 
												<p class = "short-code"><?php echo'[changa '.$feed->name.']'?></p>
										</div>
										<div class = "heres-your-short-code">
											<p> Here's your shortCode </p>
										</div>
										<div style = "position: relative; width: 100%">
											<p class = "feed-name"><?php echo $feed->name?></p>
											<p class = "feed-name feed-name-hover">[changa <?php echo $feed->name?>]</p>
										</div>
										<div class = "feed-type">
											<p><?php echo $feed->type ?></p>
										</div>
										<div class = "tags-users">
											<p class = "tags"><?php
												if(array_key_exists('users' , $feed) && is_array($feed->users) && count($feed->users) ){
													echo join(' , ', $feed->users);
												}else{
													echo join(' , ', $feed->hashtags);
												}
											?></p>
										</div>
									</div>
								<?php
								}}
								?>
								<!-- No Feeds  -->
								<?php if(!count($feeds)) 
									echo '<p class = "info"> No feeds found </p>'
								?>
						</div>
						<!-- endof Changa feeds -->

						<!-- Changa Generic feed Selection -->
						<form method = "POST" action = "<?php echo $callbackUrl ?>">
						<div class = "generic-wrapper">
							<h3 class = "generic-msg">Select the Feed that you would like to display on every Post/Page</h3>
							<p style = "margin: 0 0 30px 0; text-align: center"><b>Note</b> If Page contains [changa shortcode]  Shortcode will take the priority.</p>
							<div class = "selectors-wrapper">
								<div class = "feed-select">
									<h1 class = "feed-select-title">Feed </h1>
									<select name = "feed_appid">
											<option value = '__false__'>Select</option>
										<?php
											foreach($feeds as $feed){
												?>
													<option value ="<?php echo $feed->id ?>" <?php echo ($feed->id == $changa_generic_feed_appid) ? 'selected' : ' ';  ?> ><?php echo $feed->name?></option>
												<?php
											}
										?>
									</select>
								</div>
								<div class = "para-select">
									<h1 class = "feed-select-title">Display After</h1>
									<select name = "para">
										<option value = "__false__">Select</option>
										<?php
											foreach( ['1','2','3','4','5','6', '7'] as $para){
												?>
													<option value = "<?php echo $para ?>" <?php if($para == $changa_generic_para)echo 'selected'; ?> > Paragraph <?php echo $para?> </option> 
												<?php
											}
										?>
										<option value = "1000"
											<?php if('1000' == $changa_generic_para)echo 'selected'; ?>
										>Below Content</option>
									</select>
								</div>

							</div>
							<div style = "display:flex; padding: 30px 0px 10px">
								<input type = "submit" value = "UPDATE" class = "generic-update" name = "changa_generic_feed" class = "update" />
							</div>
						</div>
					</form>


								<div style = "display: flex ; justify-content: center; flex-direction: column;align-items: center;width:100%">

								<a target = "_" class = "btn block noActive " style = "" href = "<?php echo $changaCreateFeedUrl ?>"  >  Click Here to Create a Feed </a>
								<a class = "btn block" href = "<?php echo $fullCallbackUrl ?>"  > Click here to Refresh your Feeds </a>
							</div>

				<?php
					}
				?>
			</div>