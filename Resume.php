<?php
namespace matula;

use \ArrayObject;

/**
 * Class Resume
 * Create a resume page
 *
 * @package matula
 * @author Terry Matula
 * @TODO add in composer.json
 */
class Resume
{

    public $myName;
    public $myEmail;
    public $myPhone;
    private $myJobs = [];
    private $mySkills = [];
    private $moreInfo = [];
    private $cssUrl = "http://terrymatula.com/resumestyle.css";

    /**
     *  Add Work Experience
     *
     * @param array $workArray
     */
    public function addWorkExperience($workArray)
    {
        if (is_array($workArray)) {
            $jobsArray = new ArrayObject($workArray);
            $jobsIt    = $jobsArray->getIterator();
            while ($jobsIt->valid()) {
                $this->myJobs[] = $jobsIt->current();
                $jobsIt->next();
            }
        }
    }

    /**
     * Add Information
     *
     * @param string or array $info
     * @param string $type
     */
    public function addInfo($info, $type = 'mySkills')
    {
        if (is_array($info)) {
            foreach ($info as $in) {
                $this->{$type}[] = $in;
            }
        } elseif (is_string($info)) {
            $this->{$type}[] = $info;
        }
    }

    protected function getHeader()
    {
        return "<html><head><link rel='stylesheet' type='text/css' href='$this->cssUrl' /></head><body><div id='resume'>";
    }

    protected function getFooter()
    {
        return "</div></body></html>";
    }

    /**
     * Output the page
     *
     * @return string
     */
    public function __toString()
    {
        $output = $this->getHeader();
        $output .= "<h1 id='myName'>$this->myName</h1>";
        $output .= "<h3 id='myEmail'><a href='mailto:$this->myEmail'>$this->myEmail</a></h3>";
        $output .= "<h4 id='myPhone'>$this->myPhone</h4>";

        if (!empty($this->myJobs)) {
            $output .= "<p class='subHeader'>Work Experience</p><ul id='jobs'>";
            foreach ($this->myJobs as $jobs) {
                $output .= "<li>";
                $output .= "<strong>{$jobs['company']} - {$jobs['title']}</strong>";
                $output .= "<em>{$jobs['dates']}</em>";
                $output .= "<p>{$jobs['description']}</p>";
                $output .= "</li>";
            }
            $output .= "</ul>";
        }
        if (!empty($this->mySkills)) {
            $output .= "<p class='subHeader'>Skills</p><ul id='skills'>";
            foreach ($this->mySkills as $skills) {
                $output .= "<li>$skills</li>";
            }
            $output .= "</ul>";
        }
        if (!empty($this->moreInfo)) {
            $output .= "<p class='subHeader'>More Information</p><ul id='info'>";
            $infoArray = new ArrayObject($this->moreInfo);
            $infoIt    = $infoArray->getIterator();
            while ($infoIt->valid()) {
                $output .= "<li>{$infoIt->current()}</li>";
                $infoIt->next();
            }
            $output .= "</ul>";
        }

        $output .= $this->getFooter();

        return $output;
    }
}