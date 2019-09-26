<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 25/03/2019
 * Time: 13:36
 */
 $args = 20;

 switch($args){
     case $args>20:
         echo "+20";
         break;
     case 20: // idem $args==20
         echo "20";
         break;
     case $args<20:
         echo "-20";
 }

