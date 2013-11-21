<?php

function get_program($params)
{
	global $programOptions;

	$program = array();
	$lessons = array();
	$days    = get_terms('ait-program-day');

	// sort loops
	$counter = 0;
	foreach ($days as $day) {
		$lessons = get_posts(array(
		  'post_type' => 'ait-program',
		  'post_status' => 'publish',
		  'tax_query' => array(
				array(
				    'taxonomy' => 'ait-program-day',
				    'field' => 'slug',
				    'terms' => $day->slug
				)
           ),
		  'posts_per_page' => -1,
		  'caller_get_posts'=> 1,
		  'orderby' => 'menu_order')
		);

		foreach($lessons as $lesson)
		{
			$halls = wp_get_post_terms($lesson->ID, 'ait-program-location');
			foreach ($halls as $hall) {
				$options = $programOptions->the_meta($lesson->ID);
				$timestamp = (intval($options["start-hour"]) * 60) + intval($options["start-minute"]);
				$program[$day->name][$hall->name][$counter]['post'] = $lesson;
				$program[$day->name][$hall->name][$counter]['timestamp'] = $timestamp;
			}
			$counter++;
		}
	}

	foreach ($program as $day => $locations) {
		foreach ($locations as $location => $lessons) {
			uasort($lessons,'programAscSort');
			$program[$day][$location] = $lessons;
		}
	}

	// render section
	$result  = '<div class="ait-program">';

	// loop for day switcher
	$counter = 0;

	$result .= "<div class=\"day-names clearfix\">";
	foreach($program as $day => $hall)
	{
		$result .= "<div class=\"day-name left\" data-ait-day=\"day-$counter\">$day</div>";
		$counter++;
	}
	$result .= "</div>";


	$result  .= '<div class="program-days">';
	$counter = 0;
	foreach($program as $day => $locations)
	{
		$result .= "<div class=\"day-program\" data-ait-day=\"day-$counter\">";

		$innerCounter = 0;
		$widthClass = '';
		foreach($locations as $location => $lessons)
		{
			if($innerCounter == 0) {
				switch(count($locations)) {
					case 1:
						$widthClass = 'full';
						break;
					case 2:
						$widthClass = 'half';
						break;
					default:
						$widthClass = 'third';
				}
			}

			$innerCounter++;

			$result .= "<div class=\"program-column $widthClass\">";

			$result .= "<div class=\"program-location\">$location</div>";

			foreach($lessons as $lesson)
			{
				$options = $programOptions->the_meta($lesson['post']->ID);

				$lesson = $lesson['post'];

				$startHour   = intval($options["start-hour"]);
				$startMinute = $options["start-minute"];
				$endHour     = intval($options["end-hour"]);
				$endMinute   = $options["end-minute"];

				if ($startMinute === '0') {
					$startMinute .= '0';
				}

				if ($endMinute === '0') {
					$endMinute .= '0';
				}

				$lessonHeight = 'height: ' . lessonDuration($startHour, intval($startMinute), $endHour, intval($endMinute)) * intval($options["heightStep"]) . "px;";

				$icon     = $options["programIcon"];
				$align    = (!empty($icon)) ? " text-align: center;" : '';
				$freeTime = (!empty($options["freeTime"])) ? " freeTime" : '';
				$bgColor  = (!empty($options["programBgColor"])) ? " background: " . $options["programBgColor"] . ";" : "";
				$fgColor  = (!empty($options["programFgColor"])) ? "color: " . $options["programFgColor"] . ";" : "";

				$result .= "<div class=\"lesson$freeTime\" style=\"$lessonHeight$align$bgColor\">";

				if ($freeTime === '') {

					$result .= "<div class=\"lesson-wrap\">";

					$result .= "<div class=\"lesson-data\">";

					if(!empty($icon)) {
						$result .= "<img class=\"program-icon\" src=\"$icon\" alt=\"Icon of lesson\">";
					}

					$result .= "<div class=\"lesson-time\" style=\"$fgColor\">$startHour:$startMinute - $endHour:$endMinute</div>";

					$result .= "<div class=\"lesson-title\">";
					$speakerLink = $options["speakerLink"];
					$speakerName = $options["speakerName"];

					if (!empty($speakerLink)) {
						$result .= "<a class=\"speaker-name\" href=\"$speakerLink\" style=\"$fgColor\">";
					}

					if (!empty($speakerName)) {
						$result .= "<span class=\"speaker-name\" style=\"$fgColor\">$speakerName - </span>";
					}

					if (!empty($speakerLink)) {
						$result .= "</a>";
					}
					$result .= "<span class=\"lesson-title\" style=\"$fgColor\">$lesson->post_title</span>";

					// /.lesson-title
					$result .= "</div>";

					// /.lesson-data
					$result .= "</div>";

					// /.lesson-wrap
					$result .= "</div>";

				}
				// /.lesson
				$result .= "</div>";
			}

			// /.program-column
			$result .= "</div>";

			if (($innerCounter % 2) == 0) {
				$result .= "<div class=\"responsive-clearfix\"></div>";
			}

			if ($widthClass == 'third' && ($innerCounter % 3) == 0) {
				$result .= "<div class=\"clearfix\"></div>";
			} else if ($widthClass == 'half' && ($innerCounter % 2) == 0) {
				$result .= "<div class=\"clearfix\"></div>";
			}

		}

		// /.day-program
		$result .= "</div>";
		$counter++;
	}

	// /.program-days
	$result  .= '</div>';
	// /.ait-program
	$result .= '</div>';

	return $result;

}
add_shortcode('program', 'get_program');

function lessonDuration($start_hours, $start_mins, $end_hours, $end_mins)
{
	$start_mins += $start_hours * 60;
	$end_mins   += $end_hours * 60;
	$end_mins   -= $start_mins;

	return $end_mins / 15;
}

function programAscSort($item1,$item2)
{
    if ($item1['timestamp'] == $item2['timestamp']) return 0;
    	return ($item1['timestamp'] > $item2['timestamp']) ? 1 : -1;
}