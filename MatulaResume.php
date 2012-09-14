<?php

$myResume = new Resume();

// My Contact Information
$myResume->myName = "Terry Matula";
$myResume->myEmail = "terrymatula@gmail.com";
$myResume->myPhone = "832-541-7215";

// Places I've worked
$workExperience = array();

$workExperience[0]['company'] = "White Lion Interactive";
$workExperience[0]['title'] = "Web Developer";
$workExperience[0]['dates'] = "Apr 2012 - Present";
$workExperience[0]['description'] = "Front-end and back-end development for numerous clients. Use the Kohana framework, 
	with javascript, HTML5, and CSS3 on the front-end.";
	
$workExperience[1]['company'] = "PetRelocation";
$workExperience[1]['title'] = "Web Developer";
$workExperience[1]['dates'] = "Dec 2009 - Feb 2012";
$workExperience[1]['description'] = "Created and maintained lead gathering form, in Drupal and then a custom 
    solution using the Codeigniter framework. Built landing pages using Wordpress, and a custom landing 
    page maker. Updated the company homepage, resulting in 50% more incoming leads.";

$workExperience[2]['company'] = "Clear Channel Radio";
$workExperience[2]['title'] = "Online Training Developer";
$workExperience[2]['dates'] = "Feb 2003 - May 2009";
$workExperience[2]['description'] = "Created online training modules that were taken by Sales people and 
    On-air personalities nationwide, including a quiz/grading engine. Designed and developed an 
    applicant tracking system.";

$workExperience[3]['company'] = "KKBQ-FM";
$workExperience[3]['title'] = "Morning Show Director";
$workExperience[3]['dates'] = "Aug 1997 - Apr 2000";
$workExperience[3]['description'] = "Operated the board, put together audio elements for 'bits' and 
    parodies, kept the show on schedule";
$myResume->addWorkExperience($workExperience);

// My Skills
$mySkills = array(
    'PHP',
    'MySQL',
    'Javascript/jQuery',
    'CSS',
    'Codeigniter Framework',
	'Kohana',
	'Laravel',
    'Wordpress');
$myResume->addInfo($mySkills, 'mySkills');
$myResume->addInfo('API access and oAuth', 'mySkills');

// Links for my places online
$myResume->addInfo("<strong>My Portfolio</strong> <a href='http://terrymatula.com'>terrymatula.com</a>", 'moreInfo');
$myResume->addInfo("<a href='https://github.com/matula'>Github</a>", 'moreInfo');
$myResume->addInfo("<a href='http://careers.stackoverflow.com/matula'>StackOverflow</a>", 'moreInfo');
$myResume->addInfo("<a href='http://twitter.com/terrymatula'>Twitter</a>", 'moreInfo');

// Links for my certifications
$myResume->addInfo("<strong>My Certifications</strong> CIW Web Foundations Associate, CIW Web Design Specialist", 'moreInfo');

echo $myResume;

/**
 * A Resume Class for Terry Matula
 * @author Terry Matula
 */
class Resume {

    public $myName;
    public $myEmail;
    public $myPhone;
    private $myJobs = array();
    private $mySkills = array();
    private $moreInfo = array();
    private $cssUrl = "http://terrymatula.com/resumestyle.css";

    /**
     *  Add Work Experience
     * @param array $workArray 
     */
    public function addWorkExperience($workArray)
    {
        if (is_array($workArray))
        {
            $jobsArray = new ArrayObject($workArray);
            $jobsIt = $jobsArray->getIterator();
            while ($jobsIt->valid())
            {
                $this->myJobs[] = $jobsIt->current();
                $jobsIt->next();
            }
        }
    }

    /**
     * Add Information
     * @param string or array $info
     * @param string $type 
     */
    public function addInfo($info, $type = 'mySkills')
    {
        if (is_array($info))
        {
            foreach ($info as $in)
            {
                $this->{$type}[] = $in;
            }
        }
        else if (is_string($info))
        {
            $this->{$type}[] = $info;
        }
    }

    private function getHeader()
    {
        return "<html><head><link rel='stylesheet' type='text/css' href='{$this->cssUrl}' /></head>
            <body><div id='resume'>";
    }

    private function getFooter()
    {
        return "</div></body></html>";
    }

    /**
     * Output the page
     * @return type 
     */
    public function __toString()
    {
        $output = $this->getHeader();
        $output .= "<h1 id='myName'>$this->myName</h1>";
        $output .= "<h3 id='myEmail'><a href='mailto:$this->myEmail'>$this->myEmail</a></h3>";
        $output .= "<h4 id='myPhone'>$this->myPhone</h4>";

        if (!empty($this->myJobs))
        {
            $output .= "<p class='subHeader'>Work Experience</p><ul id='jobs'>";
            foreach ($this->myJobs as $jobs)
            {
                $output .= "<li>";
                $output .= "<strong>{$jobs['company']} - {$jobs['title']}</strong>";
                $output .= "<em>{$jobs['dates']}</em>";
                $output .= "<p>{$jobs['description']}</p>";
                $output .= "</li>";
            }
            $output .= "</ul>";
        }
        if (!empty($this->mySkills))
        {
            $output .= "<p class='subHeader'>Skills</p><ul id='skills'>";
            foreach ($this->mySkills as $skills)
            {
                $output .= "<li>$skills</li>";
            }
            $output .= "</ul>";
        }
        if (!empty($this->moreInfo))
        {
            $output .= "<p class='subHeader'>More Information</p><ul id='info'>";
            $infoArray = new ArrayObject($this->moreInfo);
            $infoIt = $infoArray->getIterator();
            while ($infoIt->valid())
            {
                $output .= "<li>{$infoIt->current()}</li>";
                $infoIt->next();
            }
            $output .= "</ul>";
        }

        $output .= $this->getFooter();
        return $output;
    }

}
