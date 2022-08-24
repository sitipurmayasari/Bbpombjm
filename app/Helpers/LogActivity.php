<?php


namespace App\Helpers;
use Request;
use App\LogActivity as LogActivityModel;
// use Browser;


class LogActivity
{


    public static function addToLog($subject)
    {
    	$log = [];
    	$log['subject'] = $subject;
    	$log['ip'] = Request::ip();
    	$log['agent'] = Request::header('user-agent');
		// $log['agent'] = Browser::detect();
    	$log['users_id'] = auth()->check() ? auth()->user()->id : 1;
    	LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
    	return LogActivityModel::latest()->get();
    }


}