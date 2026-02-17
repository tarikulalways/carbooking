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
    public static function get_availability($search){
        global $wpdb;
        $table = self::table();
        
        if($search){
            $data = $wpdb->get_results([
                $wpdb->prepare(
                    "SELECT * FROM {$table} WHERE name LIKE %s",
                    $search
                )
            ]);
            
            return self::formated_availability($data);
        }else{
            $data = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT * FROM {$table} WHERE is_active = %d",
                    1
                )
            );

            return self::formated_availability($data);
        }
    }

    public static function formated_availability(array $data){
        $formated = array_map(function($item){
            return [
                'id' => (int) $item->id,
                'name' => $item->name,
                'timezone' => $item->timezone,
                'schedule' => $item->schedule? json_decode($item->schedule, true): [],
                'create_at' => $item->create_at
            ];
        }, $data);

        return $formated;
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
    public static function update_availability(int $id, array $data){
        global $wpdb;

        if(empty($id) || ! is_array($data)){
            return false;
        }

        $update = $wpdb->update(self::table(), $data, ['id' => $id]);

        if($update){
            return self::get_availability_by_id($id);
        }
    }

    // get availability by id
    public static function get_availability_by_id(int $id){
        global $wpdb;
        if(empty($id) || ! is_numeric($id)){
            return false;
        }

        $table = self::table();
        $data = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE id = %d",
                $id
            )
        );

        if(is_object($data)){
            return [
                'id' => (int) $data->id,
                'name' => $data->name,
                'timezone' => $data->timezone,
                'schedule' => $data->schedule ? json_decode($data->schedule): [],
            ];
        }
    }

    public static function delete_availability(int $id){
        global $wpdb;
        if(empty($id) || !is_numeric($id)){
            return false;
        }

        $is_delete = $wpdb->delete(self::table(), ['id' => $id]);
        if($is_delete){
            return $is_delete;
        }
    }

    public static function table(){
        global $wpdb;
        
        return $wpdb->prefix . EASYBOOKING_DB_PREFIX . '_availability';
    }
}