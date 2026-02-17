<?php

namespace EasyBooking\Classes;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Availablity{

    // insert availability
    public static function create($data){
        global $wpdb;
        if(empty($date) || ! is_array($data)){
            return false;
        }

        $insert = $wpdb->insert(self::table(), $data);
        if($insert){
            return $insert;
        }
    }
    
    // get all availability
    public static function index(){
        $select = "SELECT * FORM {self::table()}";
    }

    // update availability
    public static function update($id, $data){
        global $wpdb;

        if(empty($id) || ! is_array($data)){
            return false;
        }

        $update = $wpdb->update(self::table(), $data, ['id' => $id]);

        if($update){
            $get_data_by_id = self::show($id);
            if($get_data_by_id){
                return $get_data_by_id;
            }
        }
    }

    // get availability by id
    public static function show($id){
        global $wpdb;
        if(empty($id) || ! is_numeric($id)){
            return false;
        }

        $select = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {self::table()} WHERE id = %d",
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