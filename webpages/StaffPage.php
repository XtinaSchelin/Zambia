<?php
// Copyright (c) 2011-2018 Peter Olszowka. All rights reserved. See copyright document for more details.
global $participant, $message_error, $message2, $congoinfo, $title;
$title = "Staff Overview";
require_once('db_functions.php');
require_once('StaffHeader.php');
require_once('StaffFooter.php');
require_once('StaffCommonCode.php');
staff_header($title);
?>

<p> Please note the tabs above. One of them will take you to your
    participant view. Another will allow you to manage Sessions. Note that
    Sessions is the generic term we are using for all Events, Films, Panels,
    Anime, Video, etc.

<p> The general flow of sessions over time is: <br>
<ul>
    <li> Brainstorm - New session idea put in to the system by one
        of our brainstorm users. The idea may or may not be sane or good.
        It could be too big or too small or duplicative.
    <li> Edit Me - New session idea that a participant or staff member entered.
        An idea entered by a brainstorm user that is non-offensive should be
        moved to this status. These are still rough and may well have issues.
        Still could be duplicates.
    <li> Vetted - A real session that we'd like to see happen. At this point
        the language should be fairly close to final in the description. Spell
        checking and grammar checking should have happened. It needs have
        publication status, a type, kid category, division and a room set.
        Please check the duration (defaults to 1 hour) and the various things the
        session might need (like power, mirrors, etc.)
        This is the minimal status that participants are allowed to sign up for.
        Avoid duplicates (however the list is still
        approximately 3 times what will actually run)
    <li> Assigned - Session has participants assigned to it.
    <li> Scheduled - Session is in the schedule (don't set this by hand as
        the tool actually sets this for you when you schedule it in a room!)
        The language needs to match what you want to see <b>published</b>.
    <li> Occured - It Happened! Fill in the estimated attendance and update
        any other needed information when moving the session to this status.
</ul>

<p> There are 2 other statuses that a session can have:
<ul>
    <li> Dropped - The bit bucket. This idea is no longer under consideration.
        Nor will it ever be again. The most frequent reason for this is identical
        data to another session.
    <li> Cancelled - Over all a good idea, but it isn't going to happen this
        year. Maybe it is too close to another idea, maybe it was dependent on
        a particular person attenting, maybe there were scheduling complications.
        You should probably still say why it was cancelled.
        This is an category we can mine for ideas in future years.
</ul>
<p>For your reference there are several statuses pulled over from previous
    years. They are here for your reference and in general should be mined for
    information. Feel free to import a session from a previous year into the
    workflow for this year if you want to see it happen this year.

<p>
    Number of con days: <?php echo CON_NUM_DAYS; ?><br />
    Con name: <?php echo CON_NAME + " " + CON_NUM; ?><br />

    <?php staff_footer(); ?>