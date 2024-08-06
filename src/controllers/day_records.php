<?php
    session_start();
    requireValidSession();

    $date = (new DateTime())->getTimestamp();
    $today = strftime('%d de %B de %Y', $date);
    //$today = date('j \d\e F \d\e Y');

    loadTemplateView('day_records', ['today' => $today]);
?>