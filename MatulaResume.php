<?php

$myResume = new Resume();

// My Contact Information
$myResume->myName = "Terry Matula";
$myResume->myEmail = "terrymatula@gmail.com";
$myResume->myPhone = "832-541-7215";

// Places I've worked
$workExperience1 = array();
$workExperience1['company'] = "PetRelocation";
$workExperience1['title'] = "Web Developer";
$workExperience1['dates'] = "Dec 2009 - Present";
$workExperience1['description'] = "Created and maintained lead gathering form, in Drupal and then a custom 
    solution using the Codeigniter framework. Built landing pages using Wordpress, and a custom landing 
    page maker. Updated the company homepage, resulting in 50% more incoming leads.";
$myResume->addWorkExperience($workExperience1);

$workExperience2 = array();
$workExperience2['company'] = "Clear Channel Radio";
$workExperience2['title'] = "Online Training Developer";
$workExperience2['dates'] = "Feb 2003 - May 2009";
$workExperience2['description'] = "Created online training modules that were taken by Sales people and 
    On-air personalities nationwide, including a quiz/grading engine. Designed and developed an 
    applicant tracking system.";
$myResume->addWorkExperience($workExperience2);

$workExperience3 = array();
$workExperience3['company'] = "KKBQ-FM";
$workExperience3['title'] = "Morning Show Director";
$workExperience3['dates'] = "Aug 1997 - Apr 2000";
$workExperience3['description'] = "Operated the board, put together audio elements for 'bits' and 
    parodies, kept the show on schedule";
$myResume->addWorkExperience($workExperience3);

// My Skills
$mySkills = array(
    'PHP',
    'MySQL',
    'Javascript/jQuery',
    'CSS',
    'Codeigniter Framework',
    'Wordpress');
$myResume->addInfo($mySkills, 'mySkills');
$myResume->addInfo('API access and oAuth', 'mySkills');

// Links for my places online
$myResume->addInfo("My Portfolio: <a href='http://terrymatula.com'>terrymatula.com</a>", 'moreInfo');
$myResume->addInfo("<a href='https://github.com/matula'>Github</a>", 'moreInfo');
$myResume->addInfo("<a href='http://careers.stackoverflow.com/matula'>StackOverflow</a>", 'moreInfo');
$myResume->addInfo("<a href='http://twitter.com/terrymatula'>Twitter</a>", 'moreInfo');

echo $myResume;

/**
 * A Resume Class for Terry Matula
 * @author Terry Matula
 */
class Resume
{

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
            $this->myJobs[] = $workArray;
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
            // using a tad bit of SPL because I can
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
