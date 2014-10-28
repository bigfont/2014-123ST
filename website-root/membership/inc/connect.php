<!--
  This page appears to be associated with the membership page.  
-->

<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

$db   = "studioWP";
$host = "us-cdbr-azure-west-a.cloudapp.net";
$user = "b5fb2dd924598a";
$pass = "7961155f";

$con = mysql_connect($host, $user, $pass);
$db  = mysql_select_db($db);

if (isset($_SESSION['admin'])) {
    $admin = true;
} else {
    $admin = false;
}

if (!function_exists('scandir')) {
    function scandir($folder)
    {
        $handle = opendir($folder);
        while (false !== ($filename = readdir($handle))) {
            $files[] = $filename;
        }
        return $files;
    }
}





function scanDirectories($rootDir, $allowext, $allData = array())
{
    $dirContent = scandir($rootDir);
    foreach ($dirContent as $key => $content) {
        $path = $rootDir . '/' . $content;
        $ext  = substr($content, strrpos($content, '.') + 1);
        
        if (in_array($ext, $allowext)) {
            if (is_file($path) && is_readable($path)) {
                $allData[] = $path;
            } elseif (is_dir($path) && is_readable($path)) {
                // recursive callback to open new directory
                $allData = scanDirectories($path, $allData);
            }
        }
    }
    return $allData;
}

function simpleLink($link)
{
    $link = str_replace("http://", "", $link);
    $link = str_replace('/', '', $link);
    
    return ($link);
}


function outgoingLink($link)
{
    if ($link == '') {
        return '';
    }
    if (strstr($link, "http://")) {
        return $link;
    } else {
        return "http://" . $link;
    }
}


/**
 * trims text to a space then adds ellipses if desired
 * @param string $input text to trim
 * @param int $length in characters to trim to
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string
 */
function trim_text($input, $length, $ellipses = true, $strip_html = true)
{
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }
    
    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }
    
    //find last space within length
    $last_space   = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);
    
    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }
    
    return $trimmed_text;
}

function getProfiles()
{
    $sql = "select * from profiles order by tour_number asc";
    $result = mysql_query($sql) or die(mysql_error());
    $d = array();
    while ($record = mysql_fetch_assoc($result)) {
        $d[] = $record;
    }
    return ($d);
}

function getProfile($id)
{
    $sql = "select * from profiles where id = '$id'";
    $result = mysql_query($sql) or die(mysql_error());
    $record = mysql_fetch_object($result);
    return ($record);
}

function getDetails($slug)
{
    $d   = array();
    $sql = "select * from projects where slug = '$slug'";
    $result = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($result) > 0) {
        $d['status'] = 1;
        $record      = mysql_fetch_object($result);
        $d['detail'] = $record;
        $sql         = "select * from skills_to_projects, skills where skills_to_projects.project_id = '$record->id' and skills_to_projects.skill_id = skills.id order by skills.view_order ASC";
        $result = mysql_query($sql) or die(mysql_error());
        while ($r = mysql_fetch_assoc($result)) {
            $d['skills'][] = $r;
        }
    } else {
        $d['status'] = 0;
    }
    return ($d);
}


function getFirstWork()
{
    $d   = array();
    $sql = "select * from projects order by view_order ASC limit 1";
    $result = mysql_query($sql) or die(mysql_error());
    $d['status'] = 1;
    $record      = mysql_fetch_object($result);
    $d['detail'] = $record;
    $sql         = "select * from skills_to_projects, skills where skills_to_projects.project_id = '$record->id' and skills_to_projects.skill_id = skills.id order by skills.view_order ASC";
    $result = mysql_query($sql) or die(mysql_error());
    while ($r = mysql_fetch_assoc($result)) {
        $d['skills'][] = $r;
    }
    return ($d);
}

function getSkills($project_id)
{
    $sql = "select * from skills_to_projects where project_id = '$project_id'";
    $result = mysql_query($sql) or die(mysql_error());
    $d = array();
    while ($record = mysql_fetch_assoc($result)) {
        $d[] = $record;
    }
    return ($d);
}

function getAllSkills()
{
    $sql = "select * from skills order by view_order ASC";
    $result = mysql_query($sql) or die(mysql_error());
    $d = array();
    while ($record = mysql_fetch_assoc($result)) {
        $d[] = $record;
    }
    return ($d);
}



function getImages($project_id)
{
    $sql = "select * from images where project_id = '$project_id' order by view_order ASC";
    $result = mysql_query($sql) or die(mysql_error());
    $d = array();
    while ($record = mysql_fetch_assoc($result)) {
        $d[] = $record;
    }
    return ($d);
}
?>