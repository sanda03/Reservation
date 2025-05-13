<?php

class DateUtils {
    public static function now() {
        return new DateTime();
    }

    public static function plusHours($hours) {
        $date = new DateTime();
        $date->modify("+{$hours} hours");
        return $date;
    }

    public static function plusDays($days) {
        $date = new DateTime();
        $date->modify("+{$days} days");
        return $date;
    }
}
?>
