# Readercon/Zambia
Convention scheduling tool originally developed for Arisia, now customized for Readercon programming.
Zambia tracks sessions (events, panels, and anything that needs to be scheduled), participants, and rooms.

## Features
* Track sessions, rooms, and participants
* Comprehensive conflict checking
* Participants log in to enter availability, provide biography, etc.
* Reports for various departments such as technical services and hotel liaison
* Includes an interface to [KonOpas](https://github.com/eemeli/konopas), a free tool for publishing the schedule to mobile devices

## Requirements
* PHP 7.X (tested on 7.0 & 7.2) (should be able to run on PHP 5.6 if tweaked to use older version of Swift)
  * XSLT library
  * Multibyte library
* Apache (should be able to run on other web servers than can handle PHP and MySQL, but not tested)
* MySQL
* SMTP connection for use as mail relay (only if you want to send email from Zambia)
  * Note, many hosts limit use of their mail relays in ways not compatible with Zambia
* Swift mailer (tested on v 6.1.3)

## Integrations
Other software that can work with Zambia:

* [ConGuide](https://github.com/pselkirk/conguide), a tool for producing a printable pocket program in InDesign from Zambia, including a schedule grid
* [KonOpas](https://github.com/eemeli/konopas), a free tool for publishing the schedule to mobile devices

## More information
Join the Zambia-specific Slack [team](https://join.slack.com/t/zambia-scheduler/shared_invite/enQtNzYxMDA2MDI2OTAwLTA3YWMyNWU3ZWYxZTE2ZjVlNjFhMzIxMThlMzVhNzk2N2I5NWUwZjQxYmUxZDQ4ODdjZjJmNzAyNTFmZDA3ZTE)
