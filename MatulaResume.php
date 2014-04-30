<?php
require('Resume.php');

$myResume = new matula\Resume();

// My Contact Information
$myResume->myName = "Terry Matula";
$myResume->myEmail = "terrymatula@gmail.com";
$myResume->myPhone = "832-541-7215";

// Places I've worked
$workExperience = [];
$workExperience[0]['company'] = 'Basanty.com';
$workExperience[0]['title'] = 'Senior Software Developer';
$workExperience[0]['dates'] = 'Sep 2013 - present';
$workExperience[0]['description'] = 'Developed and maintained basanty.com and smilecloud.io, including a RESTful API for the mobile apps.';

$workExperience[1]['company'] = "White Lion Interactive";
$workExperience[1]['title'] = "Web Developer";
$workExperience[1]['dates'] = "Apr 2012 - Sep 2013";
$workExperience[1]['description'] = "Back-end and some front-end development for numerous clients. Use the Kohana framework,
	with javascript, HTML5, and CSS3 on the front-end.";

$workExperience[2]['company'] = "PetRelocation";
$workExperience[2]['title'] = "Web Developer";
$workExperience[2]['dates'] = "Dec 2009 - Feb 2012";
$workExperience[2]['description'] = "Created and maintained lead gathering form, in Drupal and then a custom
    solution using the Codeigniter PHP framework. Built landing pages using Wordpress, and a custom landing
    page maker. Updated the company homepage, resulting in 50% more incoming leads.";

$workExperience[3]['company'] = "Clear Channel Radio";
$workExperience[3]['title'] = "Online Training Developer";
$workExperience[3]['dates'] = "Feb 2004 - April 2009";
$workExperience[3]['description'] = "Created online training modules that were taken by sales people and
    on-air personalities nationwide, including a quiz/grading engine. Designed and developed an
    applicant tracking system.";

$myResume->addWorkExperience($workExperience);

// My Skills
$mySkills = [
    'PHP',
    'MySQL',
    'JavaScript/jQuery',
    'EmberJS/AngularJS/NodeJS',
    'CSS',
    'Codeigniter Framework',
    'Kohana',
    'Laravel',
    'Wordpress'
];
$myResume->addInfo($mySkills, 'mySkills');
$myResume->addInfo('API access and oAuth', 'mySkills');

// Links for my places online
$myResume->addInfo("<strong>My Portfolio</strong> <a href='http://terrymatula.com'>terrymatula.com</a>", 'moreInfo');
$myResume->addInfo("<a href='https://github.com/matula'>Github</a>", 'moreInfo');
$myResume->addInfo("<a href='http://www.linkedin.com/in/tmatula/'>LinkedIn</a>", 'moreInfo');
$myResume->addInfo("<a href='http://careers.stackoverflow.com/matula'>StackOverflow</a>", 'moreInfo');
$myResume->addInfo("<a href='http://twitter.com/terrymatula'>Twitter</a>", 'moreInfo');

// Links for my certifications
$myResume->addInfo("<strong>My Certifications</strong> CIW Web Foundations Associate, CIW Web Design Specialist, CIW JavaScript Specialist, A+ Certification", 'moreInfo');

echo $myResume;