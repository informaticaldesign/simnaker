<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuHelper
 *
 * @author heryhandoko
 */
class ConfigsHelper {

    //put your code here
    public static function getByKey($key) {
        return \App\Models\Configs::getByKey($key);
    }
    
    //put your code here
    public static function getBankByKey($key) {
        return \App\Models\Banknota\Configs::getByKey($key);
    }

}
