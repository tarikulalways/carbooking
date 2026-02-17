<?php

namespace EasyBooking\Classes;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Availability{

    // insert availability
    public static function create_availability($data){
        global $wpdb;
        if(empty($data) || ! is_array($data)){
            return false;
        }

        $insert = $wpdb->insert(self::table(), $data);
        if($insert){
            return self::get_availability_by_id($wpdb->insert_id);
        }
    }
    
    // get all availability
    public static function index(){
        global $wpdb;

        $table = self::table();
        $select = $wpdb->get_result(
            $wpdb->prepare(
                "SELECT * FROM {$table}"
            )
        );
        return $select;
    }

    // get total availability
    public static function total(){
        global $wpdb;

        $table = self::table();
        $total = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(id) FROM {$table}"
            )
        );
        return $total;
    }

    // update availability
    public static function update($id, $data){
        global $wpdb;

        if(empty($id) || ! is_array($data)){
            return false;
        }

        $update = $wpdb->update(self::table(), $data, ['id' => $id]);

        if($update){
            $get_data_by_id = self::get_availability_by_id($id);
            if($get_data_by_id){
                return $get_data_by_id;
            }
        }
    }

    // get availability by id
    public static function get_availability_by_id($id){
        global $wpdb;
        if(empty($id) || ! is_numeric($id)){
            return false;
        }

        $table = self::table();
        $select = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE id = %d",
                $id
            )
        );

        if($select){
            return $select;
        }
    }

    public static function table(){
        global $wpdb;
        
        return $wpdb->prefix . EASYBOOKING_DB_PREFIX . '_availability';
    }
}