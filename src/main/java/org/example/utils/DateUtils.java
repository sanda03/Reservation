package org.example.utils;

import java.time.LocalDateTime;

public class DateUtils {
    public static LocalDateTime now() {
        return LocalDateTime.now();
    }

    public static LocalDateTime plusHours(long hours) {
        return now().plusHours(hours);
    }
}
