<?php

namespace App\Constants\Notifications;

class NotificationModelAction
{

     public const TYPES = [

          1 => NotificationModelAction::CREATE,

          2 => NotificationModelAction::UPDATE,

          3 => NotificationModelAction::DELETE,

          4 => NotificationModelAction::READ,

     ];

     public const CREATE = [
          'code' => 1,
          'prefix' => 'CREATE',
          'name' => "Create"
     ];

     public const UPDATE = [
          'code' => 2,
          'prefix' => 'UPDATE',
          'name' => "Update"
     ];

     public const DELETE = [
          'code' => 3,
          'prefix' => 'DELETE',
          'name' => "Delete"
     ];

     public const READ = [
          'code' => 4,
          'prefix' => 'READ',
          'name' => "Read"
     ];
}
