<?php
	/**
	 * 轻应用通过IFrame方式在易班开放平台中接入显示
	 * 所以不能直接在浏览器打开本地地址进入浏览
	 * 而是打开易班管理中心中对应站内应用的网站地址进行浏览
	 *
	 * SDK中的方式会检测是否有易班开放平台提供的参数，若无则会抛出异常
	 */


	/**
	 * 包含SDK
	 */
	require("classes/yb-globals.inc.php");
	
	session_start();

	
	/**
	 * 配置文件
	 */
	include('config.php');

	/**
	 * 站内应用需要使用AppID、AppSecret和应用入口地址初始化
	 *
	 */
	$api = YBOpenApi::getInstance()->init($cfg['x']['appID'], $cfg['x']['appSecret'], $cfg['x']['callback']);
	if (!isset($_SESSION['token'])) {
		try
		{
			/**
			 * 调用perform()验证授权，若未授权会自动重定向到授权页面
			 * 授权成功返回的数组中包含用户基本信息及访问令牌信息
			 */
			$info = $api->getFrameUtil()->perform();
            $userInfo = $api->getUser()->other();
				// 可以输出info数组查看
								// 访问令牌[visit_oauth][access_token]
			$_SESSION['token']	= $info['visit_oauth']['access_token'];
			$_SESSION['usrid']	= $info['visit_user']['userid'];
			$_SESSION['name']	= $info['visit_user']['username'];
		}
		catch (YBException $ex)
		{
			echo $ex->getMessage();
		}		
	}
	
	$api = YBOpenApi::getInstance()->bind($_SESSION['token']);
	$token_info = $api->getAuthorize()->query();
	
	if ($token_info['status'] === "404")
	{
		try
		{
			/**
			 * 调用perform()验证授权，若未授权会自动重定向到授权页面
			 * 授权成功返回的数组中包含用户基本信息及访问令牌信息
			 */
			$info = $api->getFrameUtil()->perform();
			# print_r($info);	// 可以输出info数组查看
								// 访问令牌[visit_oauth][access_token]
			$_SESSION['token']	= $info['visit_oauth']['access_token'];
			$_SESSION['usrid']	= $info['visit_user']['userid'];
			$_SESSION['name']	= $info['visit_user']['username'];
		}
		catch (YBException $ex)
		{
			echo $ex->getMessage();
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>校级活动</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
</head>
<body>
<div id="main-content">
	<div id="searchbar" class="">
		<nav class="navbar">
			<div class="navbar-info">
				<div class="nav-search-line left">
					<span class="icon-search"></span>
					<form action="search.php" method="get">
						<input type="search" name="user-search" placeholder="请输入你关注的活动" />
					</form>
				</div>
				<div class="nav-search-cls right" id="close">
					<span class="icon-cross"></span>
				</div>
			</div>
		</nav>
		<section class="sidebar">
			<ul class="main-classify">
				<li class="main-classify-part selected" id="main-school">
					<div class="main-line hide">
						<div class="main-line-desc">
							<div class="main-line-title"><span class="main-line-collg" id="collg-yiban">易班</span>震惊！易班程序员竟齐聚风味餐厅</div>
							<div class="main-line-detail">
								<div class="main-line-date"><span class="main-line-start-date">3月23日</span>-<span class="main-line-end-date">4月23日</span></div>
								<div class="main-line-num"><span id="join-num">233</span>人已关注</div>
							</div>
						</div>
						<div class="main-line-img"><img height="100%" src="image/collg-yiban.jpg"></div>
					</div>

					<div class="main-line hide">
						<div class="main-line-desc">
							<div class="main-line-title"><span class="main-line-collg" id="collg-school">校会</span>震惊！校园歌手大赛竟定于愚人节召开</div>
							<div class="main-line-detail">
								<div class="main-line-date"><span class="main-line-start-date">3月23日</span>-<span class="main-line-end-date">4月23日</span></div>
								<div class="main-line-num"><span id="join-num">233</span>人已关注</div>
							</div>
						</div>
						<div class="main-line-img"><img height="100%" src="image/collg-school.jpg"></div>
					</div>

				</li>
				<li class="main-classify-part" id="main-incolg">
					<div class="main-line">
						<div class="main-line-desc">
							<div class="main-line-title"><span class="main-line-collg" id="collg-scs">计算机</span>计算机学院第23届秋之韵强势来袭！</div>
							<div class="main-line-detail">
								<div class="main-line-date"><span class="main-line-start-date">3月23日</span>-<span class="main-line-end-date">4月23日</span></div>
								<div class="main-line-num"><span id="join-num">233</span>人已关注</div>
							</div>
						</div>
						<div class="main-line-img"><img height="100%" src="image/collg-scs.jpg"></div>
					</div>
				</li>
				<li class="main-classify-part" id="main-nocolg">
					<div class="main-line">
						<div class="main-line-desc">
							<div class="main-line-title"><span class="main-line-collg" id="collg-scss">网安</span>震惊！三笙有幸竟于网安网红诞辰举行！</div>
							<div class="main-line-detail">
								<div class="main-line-date"><span class="main-line-start-date">3月23日</span>-<span class="main-line-end-date">4月23日</span></div>
								<div class="main-line-num"><span id="join-num">233</span>人已关注</div>
							</div>
						</div>
						<div class="main-line-img"><img height="100%" src="image/collg-meow.jpg"></div>
					</div>
				</li>
			</ul>
		</section>
	</div>
	<div id="showbar" class="">
		<nav class="navbar">
			<div class="navbar-info">
				<ul class="nav-classify center">
					<li id="search">
						<span class="icon-search"></span>
					</li>
					<li class="nav-classify-part selected" id="nav-school">校级</li>
					<li class="nav-classify-part" id="nav-incolg">院内</li>
					<li class="nav-classify-part" id="nav-nocolg">外院</li>
				</ul>
			</div>
		</nav>
		<section class="mainbar">
			<ul class="main-classify">
				<li class="main-classify-part selected" id="main-school">
					<div class="main-line  yiban-template hide">
						<div class="main-line-desc">
							<div class="main-line-title"><span class="main-line-collg" id="collg-yiban">易班</span>震惊！易班程序员竟齐聚风味餐厅</div>
							<div class="main-line-detail">
								<div class="main-line-date"><span class="main-line-start-date">3月23日</span>-<span class="main-line-end-date">4月23日</span></div>
								<div class="main-line-num"><span id="join-num">233</span>人已关注</div>
							</div>
						</div>
						<div class="main-line-img"><img height="100%" src="image/collg-yiban.jpg"></div>
					</div>

					<div class="main-line school-template hide">
						<div class="main-line-desc">
							<div class="main-line-title"><span class="main-line-collg" id="collg-school">校会</span>震惊！校园歌手大赛竟定于愚人节召开</div>
							<div class="main-line-detail">
								<div class="main-line-date"><span class="main-line-start-date">3月23日</span>-<span class="main-line-end-date">4月23日</span></div>
								<div class="main-line-num"><span id="join-num">233</span>人已关注</div>
							</div>
						</div>
						<div class="main-line-img"><img height="100%" src="image/collg-school.jpg"></div>
					</div>

				</li>
				<li class="main-classify-part" id="main-incolg">
					<div class="main-line incolg-template hide">
						<div class="main-line-desc">
							<div class="main-line-title"><span class="main-line-collg" id="collg-scs">计算机</span>计算机学院第23届秋之韵强势来袭！</div>
							<div class="main-line-detail">
								<div class="main-line-date"><span class="main-line-start-date">3月23日</span>-<span class="main-line-end-date">4月23日</span></div>
								<div class="main-line-num"><span id="join-num">233</span>人已关注</div>
							</div>
						</div>
						<div class="main-line-img"><img height="100%" src="image/collg-scs.jpg"></div>
					</div>
				</li>
				<li class="main-classify-part" id="main-nocolg">
					<div class="main-line nocolg-template hide">
						<div class="main-line-desc">
							<div class="main-line-title"><span class="main-line-collg" id="collg-scss">网安</span>震惊！三笙有幸竟于网安网红诞辰举行！</div>
							<div class="main-line-detail">
								<div class="main-line-date"><span class="main-line-start-date">3月23日</span>-<span class="main-line-end-date">4月23日</span></div>
								<div class="main-line-num"><span id="join-num">233</span>人已关注</div>
							</div>
						</div>
						<div class="main-line-img"><img height="100%" src="image/collg-meow.jpg"></div>
					</div>
				</li>
			</ul>
		</section>
		<nav class="footbar">
			<ul class="foot-classify">
				<li class="foot-classify-part center selected" id="foot-whole">
					<div class="foot-classify-icon">
						<span class="icon-dribbble"></span>
					</div>
					<div class="foot-classify-desc">活动</div>
				</li>
				<li class="foot-classify-part center" id="foot-mine">
					<div class="foot-classify-icon">
						<span class="icon-user"></span>
					</div>
					<div class="foot-classify-desc">我</div>
				</li>
			</ul>
		</nav>
	</div>
</div>

	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>

	<script src="js/initactivities.js"></script>

</body>
</html>