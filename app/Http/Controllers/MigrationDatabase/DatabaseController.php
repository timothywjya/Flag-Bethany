<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function TableUsers()
    {
        $data = "CREATE TABLE `creativeministrydatabase`.`users` (`id` BIGINT(20) NOT NULL AUTO_INCREMENT , `name` VARCHAR(200) NOT NULL , `role_id` BIGINT(20) NOT NULL , `username` VARCHAR(64) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_by` BIGINT(20) NULL DEFAULT NULL , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT NULL , `updated_by` BIGINT(20) NULL DEFAULT NULL , `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)), UNIQUE `user_email` (`email`), UNIQUE `user_username` (`username`)) ENGINE = InnoDB;";
    }

    public function TableRoles()
    {
        $data = "CREATE TABLE `creativeministrydatabase`.`roles` (`id` BIGINT(20) NOT NULL AUTO_INCREMENT , `role_name` VARCHAR(32) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_by` BIGINT(20) NULL DEFAULT NULL , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT NULL , `updated_by` BIGINT(20) NULL DEFAULT NULL ) ENGINE = InnoDB;";
    }

    public function Tablemembers()
    {
        $data = "CREATE TABLE `creativeministrydatabase`.`members` (`id` BIGINT(20) NOT NULL AUTO_INCREMENT , `role_id` BIGINT(20) NOT NULL , `user_id` BIGINT(20) NOT NULL , `full_name` VARCHAR(200) NOT NULL , `date_of_birth` DATE NOT NULL , `call_name` VARCHAR(32) NOT NULL , `service_type` BIGINT(20) NOT NULL , `address` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_by` BIGINT(20) NULL DEFAULT NULL , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT NULL , `updated_by` BIGINT(20) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    }

    public function TableChoreographyType()
    {
        $data = "CREATE TABLE `creativeministrydatabase`.`choreography_types` (`id` BIGINT(20) NOT NULL AUTO_INCREMENT , `choreography_name` VARCHAR(50) NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_by` BIGINT(20) NULL DEFAULT NULL , `updated_at` TIMESTAMP NULL DEFAULT NULL , `updated_by` BIGINT(20) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    }
}
