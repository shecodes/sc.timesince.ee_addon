<?php


$plugin_info = array(
  'pi_name' => 'EE TimeSince',
  'pi_version' => '1.5',
  'pi_author' => 'Sue Crocker',
  'pi_author_url' => 'http://www.eehowto.com/',
  'pi_description' => 'Displays number of days blogging or since an event.',
  'pi_usage' => Timesince::usage()
  );

class Timesince
{

var $return_data = "";

  function Timesince()
  {
    global $TMPL;
    $day = $TMPL->fetch_param('day');
    $month = $TMPL->fetch_param('month');
    $year = $TMPL->fetch_param('year');
    $hour = $TMPL->fetch_param('hour');
    $event = $TMPL->fetch_param('event');
    $minute = $TMPL->fetch_param('minute');
    
    // get current unix timestamp
  $today = time();
  $days = floor((time()-mktime($hour,$minute,'00',$month,$day,$year))/86400);

    
  $this->return_data = "$days days since $event.";
 }
 
  // ----------------------------------------
  //  Plugin Usage
  // ----------------------------------------

  // This function describes how the plugin is used.
  //  Make sure and use output buffering

  function usage()
  {
  ob_start(); 
  ?>
==PURPOSE==  
  The EE Timesince plug-in allows you to display the number of days since an event.  The required paramaters are the day, month and year (in numeric form) of the date you are counting up from.
    

==REQUIRED PARAMETERS==
  day="[1..31]"
  The day of the month counting from.
  
  month="[1..12]"
  The month number that you are counting from.  Ex:  1 for January, 2 February, etc.
  
  year="[2004...]"
  The year, any above 2004 should work.
  
  event=" ";
  Whatever your event is, what you are counting down from.
  
==OPTIONAL PARAMETERS==
	hours="[0...24]"
	The hour your event ended on, in 24 hour format.  24 is midnight, 12 is noon, etc.
  
===POSSIBLE EXAMPLES===

	{exp:timesince day="31" month="10" year="2005" event="Weblog launched"}
	Output is "x days since Weblog launched".
	Counts up from the day you launched your weblog.
	
	
            Note:  If you try to use single or double quotes in the event (eg. Sue's Site), you must encode it.
			It's a limitation of the template system.  You can convert HTML entitites at this site, http://resources.wordpress.org/tools/encode/.
			Or, try to remember to use &#039; for ' (single quotes) &amp; for & (ampersands) and &quot; for " (double quotes).

	NOTE: This is a rewrite of an existing EE plugin by Marlana Shipley at: http://www.stitchingforsanity.com

	
<?php
  $buffer = ob_get_contents();
	
  ob_end_clean(); 

  return $buffer;
  }
  // END

}

?>
	