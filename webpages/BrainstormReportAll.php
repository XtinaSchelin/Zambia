<?php
//	Copyright (c) 2006-2019 Peter Olszowka. All rights reserved. See copyright document for more details.
global $title;
require_once('BrainstormCommonCode.php');
$ConStartDatim = CON_START_DATIM;
$title = "All Suggestions";
$query = <<<EOD
SELECT S.sessionid,
       T.trackname,
       NULL typename,
            S.title,
            CONCAT(IF(LEFT(S.duration, 2) = 00, '', IF(LEFT(S.duration, 1) = 0, CONCAT(RIGHT(LEFT(S.duration, 2), 1), 'hr '), CONCAT(lEFT(S.duration, 2), 'hr '))), IF(date_format(S.duration, '%i')=00, '', IF(LEFT(date_format(S.duration, '%i'), 1)=0, CONCAT(RIGHT(date_format(S.duration, '%i'), 1), 'min'), CONCAT(date_format(S.duration, '%i'), 'min')))) Duration,
            S.estatten,
            S.progguiddesc,
            S.persppartinfo,
            roomname,
            DATE_FORMAT(ADDTIME('$ConStartDatim', SCH.starttime), '%a %l:%i %p') AS starttime,
            SS.statusname
FROM Sessions S
JOIN Tracks T USING (trackid)
JOIN SessionStatuses SS USING (statusid)
LEFT JOIN Schedule SCH USING (sessionid)
LEFT JOIN Rooms R USING (roomid)
WHERE SS.statusname IN ('Edit Me',
                        'Brainstorm',
                        'Vetted',
                        'Assigned',
                        'Scheduled')
ORDER BY T.trackname,
         S.title;
EOD;
if (($result = mysqli_query_exit_on_error($query)) === false) {
        exit(); // Should have exited already
}
brainstorm_header($title);
echo "<p> This list includes ALL ideas that have been submitted.   Some may require Peril Sensitive Sunglasses.</p>";
echo "<p> We are in the process of sorting through these suggestions: combining duplicates; splitting big ones into pieces; checking general feasability; finding needed people to present; looking for an appropiate time and location; rewritting for clarity and proper english; and hoping to find a time machine so we can do it all.</p>";
echo "<p> If you want to help, email us at ";
echo "<a href=\"mailto:" . PROGRAM_EMAIL . "\">" . PROGRAM_EMAIL . "</a> </p>\n";
echo "This list is sorted by Track and then Title.";
RenderPrecis($result, false);
brainstorm_footer();
exit();
