<?php

namespace EasyBooking\Database;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CreateAvailabilityTable{
    public static function up($prefix, $charsert_collate){
        $table = $prefix . EASYBOOKING_DB_PREFIX . '_availability';

        $sql = "CREATE TABLE IF NOT EXISTS {$table}(
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            timezone VARCHAR(50) NOT NULL,
            schedule JSON NOT NULL,
            is_default TINYINT(1) DEFAULT 0,
            is_active TINYINT(1) DEFAULT 1,
            create_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ){$charsert_collate};";

        dbDelta($sql);
    }
}

