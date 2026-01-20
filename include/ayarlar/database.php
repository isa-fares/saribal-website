<?php
/**
 * Created by PhpStorm.
 * User: Abdulkadir
 * Date: 22.10.2016
 * Time: 22:12
 */

return [


       'pdo' => [


             'local'=>array(
                 'host' => 'localhost',
                 'dbname' => 'saribal',
                 'user' =>'root',
                 'password' => '',
                 'charset' => 'utf8',
                 'driver' => 'pdo_mysql',
                 'debug' => true
             ),

             'host' =>
                [
                     'host' => 'localhost',
                     'dbname' => '',
                     'user' =>'',
                     'password' => '',
                     'charset' => 'utf8',
                     'driver' => 'pdo_mysql',
                     'debug' => false,
                ]




       ]
];