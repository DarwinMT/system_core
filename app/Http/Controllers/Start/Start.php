<?php

namespace App\Http\Controllers\Start;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


use App\Models\Usuario\User;
use App\Models\Usuario\Modulo;

class Start extends Controller
{
    /**
     *
     * Cargar el login o la pagina principal dependiendo del dipositivo que use
     * ademas verifica la session del usuario
     */
    public function index()
    {
    	if($this->device_detect()==1){

            if (Session::has('user_data')){
                $data_user=Session::get('user_data');
                if($this->device_detect()==1){
                    $acees=$this->access_user_boostrap();
                    return view('Home/MainB',compact("data_user","acees"));
                }else{
                    $acees=$this->access_user_materialize();
                    return view('Home/MainM',compact("data_user","acees"));
                }
            }else{
                Session::forget('user_data');
                return view('Home/Homeb');
                //return redirect('/');
            }

    		//return view('Home/Homeb');
    	}else{
            if (Session::has('user_data')){
                $data_user=Session::get('user_data');
                if($this->device_detect()==1){
                    $acees=$this->access_user_boostrap();
                    return view('Home/MainB',compact("data_user","acees"));
                }else{
                    $acees=$this->access_user_materialize();
                    return view('Home/MainM',compact("data_user","acees"));
                }
            }else{
                Session::forget('user_data');
                return view('Home/Homem');
                //return redirect('/');
            }
    		//return view('Home/Homem');
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
    /**
     *
     * Funcion para validar por post los datos de incio de session 
     * 
     *
     */
    public function store(Request $request){
    	$aux = $request->all();
    	$user=User::with("persona.personaempresa","permisos.rol")
    				->whereRaw("username='".$aux["User"]."' AND estado=1 ")->get();
    	if(count($user)>0){
    		//if($aux["Password"]== $user[0]->password){
            if( Hash::check( $aux["Password"], $user[0]->password) ){
    			if(isset($user[0]->persona)){
    				if(isset($user[0]->persona->personaempresa[0]->id_emp)){
    					if(isset($user[0]->permisos[0])){
                            // Acceso concedido
                            Session::put('user_data', $user);
                            return response()->json(['success' => 0, 'user'=>$user ]);
                        }else{
                            //usuario sin permisos de sistema
                            return response()->json(['success' => 5 ]);     
                        }
    				}else{
    					//usuario sin empresa asignada
    					return response()->json(['success' => 4 ]);		
    				}
    			}else{
    				//usuario sin datos
    				return response()->json(['success' => 3 ]);	
    			}
    		}else{
    			//contraseña incorrecta
    			return response()->json(['success' => 2 ]);
    		}
    	}else{
    		//usuario no existe
    		return response()->json(['success' => 1 ]);
    	}
    }
    /**
     *
     *
     * Salir del systema
     *
     */
    public function logout_system_core($value='')
    {
    	Session::forget('user_data');
    	return redirect('/');
    }
         /**
     *
     * Crear menu boostrap en base a los permisos del usuario 
     * 
     *
     */
    public function access_user_boostrap()
    {
        $menupadre=Modulo::whereRaw("ISNULL(id_nodmen);")->get();
        $data_user=Session::get('user_data');
        $permisos=json_decode($data_user[0]->permisos[0]->acceso);
        $nav="<ul class='nav navbar-nav navbar-right'>";
        foreach ($menupadre as $m) {
            $encontrar=0;
            foreach ($permisos as $p) {
                if($m["id_men"]==$p->id_nodmen && $encontrar==0){

                    $nav.=" <li class='dropdown'> "; // menu padre
                    $nav.="  <a href='#' class='dropdown-toggle' id='drop3' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='true'> ";
                    if($m["id_men"]==15){ // se cambia el titulo por los datos del usuario
                        $nav.=" ".$data_user[0]->username." <span class='caret'></span>  </a> ";
                    }else{
                        $nav.=" ".$m["titulo"]." <span class='caret'></span>  </a> ";   
                    }
                    
                    
                    $nav.=" <ul class='dropdown-menu' > "; //sub menu nivel 2 
                    foreach ($permisos as $i) {
                        if($m["id_men"]==$i->id_nodmen){
                            $nav.=" <li><a href='".$i->url."'>".$i->titulo."</a></li>  ";
                        }
                    }
                    $nav.="</ul>";
                    $nav.="</li>";

                    $encontrar=1;
                }
            }
        }
        $nav.="</ul>";
        return $nav;
    }

    /**
     *
     * Crear menu materialize en base a los permisos del usuario 
     * 
     *
     */
    public function access_user_materialize()
    {
        $menupadre=Modulo::whereRaw("ISNULL(id_nodmen);")->get();
        $data_user=Session::get('user_data');
        $permisos=json_decode($data_user[0]->permisos[0]->acceso);
        $nav="";
        //$nav="<ul class='nav navbar-nav navbar-right'>";
        foreach ($menupadre as $m) {
            $encontrar=0;
            foreach ($permisos as $p) {
                if($m["id_men"]==$p->id_nodmen && $encontrar==0){

                    $nav.=" <li > "; // menu padre
                    $nav.="  <a href='#' class='dropdown-button' href='#!' data-activates='dropdown".$m["id_men"]."'> ";
                    if($m["id_men"]==15){ // se cambia el titulo por los datos del usuario
                        $nav.=" <i class='material-icons prefix'>".$m["html"]."</i> ".$data_user[0]->username."";
                        $nav.=" <i class='material-icons right'>arrow_drop_down</i> </a> ";
                    }else{
                        $nav.=" <i class='material-icons prefix'>".$m["html"]."</i> ".$m["titulo"]."";
                        $nav.=" <i class='material-icons right'>arrow_drop_down</i> </a> ";
                    }
                    
                    
                    $nav.=" <ul id='dropdown".$m["id_men"]."' class='dropdown-content'  > "; //sub menu nivel 2 
                    foreach ($permisos as $i) {
                        if($m["id_men"]==$i->id_nodmen){
                            $nav.=" <li><a href='".$i->url."'>".$i->titulo."</a></li>  ";
                        }
                    }
                    $nav.="</ul>";
                    $nav.="</li>";
                    $nav.=" <li class='divider'></li>";

                    $encontrar=1;
                }
            }
        }
        //$nav.="</ul>";
        return $nav;
    }
}
