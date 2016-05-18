<?php
    function espailliure(){
        $dev = '/';  
        $freespace = disk_free_space($dev);  
        $totalspace = disk_total_space($dev);

        $dev."</br>";
        $freespace."</br>";
        $totalspace."</br>";
        $freespace_mb = $freespace/1024/1024 ."</br>";
        $totalspace_mb = $totalspace/1024/1024 ."</br>";
        $freespace_percent = ($freespace/$totalspace)*100 ." ---> % LIBRE</br>";
        $used_percent = (1-($freespace/$totalspace))*100;
        $freespace = round($used_percent);
        $total = round($totalspace);

        echo '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'.$used_percent.'%">';
        echo $freespace."% UTILITZAT";
    }
    
?>