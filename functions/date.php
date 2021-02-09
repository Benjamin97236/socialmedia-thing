<?php
    function currentDate($date) {
        $months = array('Januari', 'Februari', 'Mars', 'April', 'Maj
        ', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December');
        $month = substr($date, 4, 2);
        $real_month = $months[$month-1];
        $day = substr($date, 1, 2);
        $year = substr($date, 6, 4);
        $time = substr($date, 11);
        $real_time = explode(":", $time);

        $hour = $real_time[0];
        $minute1 = $real_time[1];
        $minute = strval(":".$minute1);
        

        $current_time = date('d m Y H:i:s');
        if(substr($current_time, 1, 2) == $day) {
            $day = 'Idag';
            $real_month = "";
            $year = "";
        } else if(substr($current_time, 1, 2) == $day+1) {
            $day = 'Igår';
            $real_month = "";
            $year = "";
        } else {
            $hour = "";
            $minute = "";
        }

        $complete_date = ''.$day.'  '.$real_month.' '.$year.' '.$hour.''.$minute.'';
        return $complete_date;
        
    }
