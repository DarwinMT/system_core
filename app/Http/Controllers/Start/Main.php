<?php

namespace App\Http\Controllers\Start;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Main extends Controller
{
    public function index()
    {	
    	if (Session::has('user_data')){
    		$data_user=Session::get('user_data');
    		if($this->device_detect()==1){
	    		return view('Home/MainB',compact("data_user"));
	    	}else{
	    		return view('Home/MainM',compact("data_user"));
	    	}
    	}else{
    		Session::forget('user_data');
    		return redirect('/');
    	}
    }
     /**
     *
     * Funcion para detectar que dispositivo es 
     * Original de : http://7sabores.com/blog/detectar-tipo-dispositivo-mobile-tablet-desktop-php
     *
     */
    public function device_detect()
    {
  
		$tablet_browser = 0;
		$mobile_browser = 0;
		$body_class = 'desktop';
		 
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		    $tablet_browser++;
		    $body_class = "tablet";
		}
		 
		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		    $mobile_browser++;
		    $body_class = "mobile";
		}
		 
		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		    $mobile_browser++;
		    $body_class = "mobile";
		}
		 
		$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
		$mobile_agents = array(
		    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		    'newt','noki','palm','pana','pant','phil','play','port','prox',
		    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		    'wapr','webc','winw','winw','xda ','xda-');
		 
		if (in_array($mobile_ua,$mobile_agents)) {
		    $mobile_browser++;
		}
		 
		if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
		    $mobile_browser++;
		    //Check for tablets on opera mini alternative headers
		    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
		    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
		      $tablet_browser++;
		    }
		}
		if($tablet_browser >0 || $mobile_browser>0 ){ // dispositivo movil
			return 2;
		}else{ //escritorio
			return 1;
		}
    }
}
