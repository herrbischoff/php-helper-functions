<?php

/*
 * Get current time, formatted
 */
function _now() {
    return date('d-m-Y', time());
}

/*
 * Format a date
 */
function _dateConvert($originalDate) {
    $newDate = date('d-m-Y', strtotime($originalDate));
}

/*
 * Get week number from a date
 */
function _weeknumber($ddate) {
    $date = new DateTime($ddate);
    return $date->format("W");
}

/*
 * Convert minutes to hours and minutes
 */
function _convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

/*
 * Get difference between two times
 */
function _dateDiff($date1, $date2) {
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%H:%I');
}

/*
 * Calculate age
 */
function _age($date) {
    $time = strtotime($date);
    if($time === false){
        return '';
    }

    $year_diff = '';
    $date = date('Y-m-d', $time);
    list($year,$month,$day) = explode('-',$date);
    $year_diff = date('Y') - $year;
    $month_diff = date('m') - $month;
    $day_diff = date('d') - $day;
    if ($day_diff < 0 || $month_diff < 0) $year_diff-;

    return $year_diff;
}

/*
 * Twitter style "time ago" dates
 */
function _ago($tm,$rcs = 0) {
    $cur_tm = time(); $dif = $cur_tm-$tm;
    $pds = array('second','minute','hour','day','week','month','year','decade');
    $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
    for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);

    $no = floor($no); if($no <> 1) $pds[$v] .='s'; $x=sprintf("%d %s ",$no,$pds[$v]);
    if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
    return $x;
}
