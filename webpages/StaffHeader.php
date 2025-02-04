<?php
//	Copyright (c) 2011-2019 Peter Olszowka. All rights reserved. See copyright document for more details.
function staff_header($title, $is_report = false, $reportColumns = false, $reportAdditionalOptions = false)
{
	require_once("javascript_functions.php");
	global $fullPage, $header_used;
	$header_used = HEADER_STAFF;
?>
	<!DOCTYPE html>
	<html lang="en" <?php if ($fullPage) echo "class =\"fullPage\""; ?>>

	<head>
		<meta charset="utf-8">
		<title>Zambia &ndash; <?php echo $title ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Zambia, the fan convention scheduling tool">
		<meta name="author" content="PeterO, DDA, others">

		<link rel="stylesheet" href="external/jqueryui1.8.16/jquery-ui-1.8.16.custom.css" type="text/css">
		<link rel="stylesheet" href="external/bootstrap2.3.2/bootstrap.css" type="text/css">
		<link rel="stylesheet" href="external/bootstrap2.3.2/bootstrap-responsive.css" type="text/css">
		<link rel="stylesheet" href="css/zambia.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/staffMaintainSchedule.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="external/choices9.0.0/choices.min.css" type="text/css">
		<?php if ($is_report) {
			echo "<link rel=\"stylesheet\" href=\"external/dataTables1.10.16/dataTables.css\" type=\"text/css\" />\n";
			if ($reportColumns) {
				echo "<meta id=\"reportColumns\" data-report-columns=\"";
				echo htmlentities(json_encode($reportColumns));
				echo "\">";
			}
			if ($reportAdditionalOptions) {
				echo "<meta id=\"reportAdditionalOptions\" data-report-additional-options=\"";
				echo htmlentities(json_encode($reportAdditionalOptions));
				echo "\">";
			}
		} ?>
		<link rel="shortcut icon" href="images/favicon.ico">
		<script type="text/javascript">
			var thisPage = "<?php echo $title; ?>";
			var conStartDateTime = new Date("<?php echo CON_START_DATIM; ?>".replace(/-/g, "/"));
			var alwaysShowLargeHeader = false;
			var STANDARD_BLOCK_LENGTH = "<?php echo STANDARD_BLOCK_LENGTH; ?>";
		</script>
		<?php
		/* "external" means 3rd party library */
		load_external_javascript();
		load_internal_javascript($title, $is_report);
		?>
	</head>

	<body <?php if ($fullPage) echo "class =\"fullPage\""; ?>>
		<div <?php if ($fullPage) echo "id=\"fullPageContainer\""; ?> class="container-fluid">
			<div id="myhelper"></div><!-- used for drag-and-drop operations -->
			<?php if ($fullPage) echo "<div id=\"headerContainer\">"; ?>
			<!-- Header -->
			<header class="row-fluid staff" id="top">
				<div id="regHeader" class="span12">
					<div class="span9">
						<h1 class="pageHeader pull-left">
							<img id="zambiaLogo" src="images/<?php echo LOGO_FILENAME; ?>" alt="Logo for <?php echo CON_NAME; ?>" class="zambiaLogo zambiaImage wide-only" />
							<div class="pageHeaderText span9"> Zambia<span class="wide-medium-only">: The <?php echo CON_NAME; ?> Scheduling Tool</span></div>
						</h1>
					</div>
					<?php if (isset($_SESSION['badgeid'])) { ?>
						<div class="span3" id="welcome">
							<p>Welcome, <?php echo $_SESSION['badgename']; ?></p>
							<img id="hideHeader" class="imgButton pull-right" src="images/green-up.png" alt="Shrink header to a thin strip" title="Shrink header to a thin strip" />
							<a id="logoutButton" class="btn btn-primary pull-right" href="logout.php" title="Click to log out">Log out</a>
						</div>
				</div>
				<div id="altHeader" class="row-fluid">
					<div id="welcomeSmall">
						<img src="images/green-down.png" id="showHeader" class="pull-right" alt="Expand header to normal size" title="Expand header to normal size" />
						<a id="logoutButton" class="btn btn-primary btn-mini pull-right" href="logout.php" title="Click to log out">Log out</a>
						<p class="pull-right">Welcome, <?php echo $_SESSION['badgename']; ?></p>
					</div>
				</div>
			</header>
			<nav id="staffNav" class="navbar navbar-inverse">
				<div class="navbar-inner">
					<div class="container" style="width: auto;">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<div class="brand"><?php echo $title; ?></div>
						<div class="nav-collapse">
							<ul class="nav">
								<li class="dropdown">
									<a href="#sessions" class="dropdown-toggle" data-toggle="dropdown">Sessions<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="StaffSearchSessions.php">Search Sessions</a></li>
										<li><a href="CreateSession.php">Create New Session</a></li>
										<li><a href="ViewSessionCountReport.php">View Session Counts</a></li>
										<li><a href="ViewAllSessions.php">View All Sessions</a></li>
										<li><a href="ViewPrecis.php?showlinks=0">View Precis</a></li>
										<li><a href="ViewPrecis.php?showlinks=1">View Precis with Links</a></li>
										<li><a href="StaffSearchPreviousSessions.php">Import Sessions</a></li>
										<li><a href="SessionHistory.php">Session History</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#participants" class="dropdown-toggle" data-toggle="dropdown">Participants<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="AdminParticipants.php">Administer</a></li>
										<li><a href="InviteParticipants.php">Invite to a Session</a></li>
										<li><a href="StaffAssignParticipants.php">Assign to a Session</a></li>
										<?php makeMenuItem("Send email", may_I('SendEmail'), "StaffSendEmailCompose.php", false); ?>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<?php
										$prevErrorLevel = error_reporting();
										$tempErrorLevel = $prevErrorLevel && ~E_WARNING;
										error_reporting($tempErrorLevel);
										if (!include 'ReportMenuInclude.php') {
											echo "<li><div class='menu-error-entry'>Report menus not built!</div></li>\n";
										} else { ?>
											<li class='divider'></li>
											<li><a href='staffReportsInCategory.php'>All Reports</a></li>
										<?php }
										error_reporting($prevErrorLevel);
										?>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#scheduling" class="dropdown-toggle" data-toggle="dropdown">Scheduling<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="MaintainRoomSched.php">Maintain Room Schedule</a></li>
										<li><a href="StaffMaintainSchedule.php">Grid Scheduler</a></li>
									</ul>
								</li>
								<li class="divider-vertical"></li>
								<li><a href="StaffPage.php">Overview</a></li>
								<?php makeMenuItem("Suggest a Session", may_I('BrainstormSubmit'), "BrainstormWelcome.php", may_I('BrainstormSubmit')); ?>
								<li class="divider-vertical"></li>
								<li>
									<form method=POST action="ShowSessions.php" class="navbar-search pull-left">
										<input type="text" name="searchtitle" class="search-query" placeholder="Search for sessions by title">
										<input type="hidden" value="ANY" name="track">
										<input type="hidden" value="ANY" name="status">
										<input type="hidden" value="ANY" name="type">
										<input type="hidden" value="" name="sessionid">
										<input type="hidden" value="ANY" name="divisionid">
									</form>
								</li>
								<?php if (may_I('ConfigureReports')) { ?>
									<li class="dropdown">
										<a href="#admin" class="dropdown-toggle" data-toggle="dropdown">Admin<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="BuildReportMenus.php">Build Report Menus</a></li>
										</ul>
									</li>
								<?php } ?>
							</ul>
							<ul class="nav pull-right">
								<li class="divider-vertical"></li>
								<li><a id="ParticipantView" href="welcome.php">Participant View</a></li>
							</ul>
						</div>
						<!--/.nav-collapse -->
					</div>
				</div>
			</nav>
		<?php
						if ($fullPage) echo "</div>"; //close headerContainer 
					} // if badgeid was set
					else {
						require_once("loginForm.php");
						echo "<script type=\"text/javascript\">";
						echo "   var alwaysShowLargeHeader = true;";
						echo "</script>";
		?>
			</header>
	<?php
						if ($fullPage) echo "</div>"; //close headerContainer 
					}
				}
	?>