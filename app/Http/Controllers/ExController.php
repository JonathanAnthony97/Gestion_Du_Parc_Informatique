<?php

namespace App\Http\Controllers;
//Excel
use Excel;
//Pdf
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;

class ExController extends Controller 
{   
  
    //premier chargement et parametrage du constante
    public function index($const = 0){

        
         if( is_null(Session::get('Par_page')))
            Session::put('Par_page',5);
    	//return view('exemple');
        if($const != 0){
            $this->set_Constante($const);
        }
        $cos=$this->get_Constante();
         
    	$total=User::count();
        $user=User::paginate($cos);
        $a=1;
        if($total > 0){
        	if($total >= $cos){
        		$b=$cos; 
        	}else{
        		$b=$total;
        	}
        }else{
            $a=0;
            $b=$a;
        }
        if($const != 0){
        return view('test',compact('user','a','b','total'))->render();
        }
        return view('static',compact('user','a','b','total'));
    }

 
    public function d(){
         //Session::forget('Par_page');
         //dd(Session::get('Par_page'));
        return view('chart');
    }

    //recherche et renvoi par ajax
    public function recherche(Request $request){
        $search=$request->search;
        $cos=$this->get_Constante();
        $a=1;
        if($search == null){ 
            $total=User::count();
            $user=User::paginate($cos);
        }else{
            $u=User::where('username','like',"%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->orWhere('created_at','like',"%{$search}%");
                
            $total=$u->count();
            $user= $u->paginate($cos);
            
        }
        if($total > 0){
                if($total >= $cos){
                    $b=$cos; 
                }else{
                     $b=$total;
                }
            }else{
                $a=0;
                $b=$a;
            }
        return view('test',compact('user','a','b','total'))->render();
    }

    public function nav_search(Request $request){

    }

    protected function get_Constante(){
        return Session::get('Par_page');
    }

    protected function set_Constante($param){
         Session::put('Par_page',$param);
    }


    public function ajax_pagination(Request $request){
       $cos=$this->get_Constante();

        if($request->cle == null){
                $total=User::count();
                $user=User::paginate($cos);
        }
        else{
            $search = $request->cle;
             $u=User::where('username','like',"%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->orWhere('created_at','like',"%{$search}%");
            $total=$u->count();
            $user=$u->paginate($cos);
        }

            $lien=intval($request->page);
            $a=1;
            $l=(($lien - 1) * $cos) + 1;
            $ref=$total-$l;
                if($lien == 1){
                    if($total >= $cos){
                        $b=$cos; 
                    }else{
                        $b=$total;
                    }
                }else{
                    if($ref >= $cos){
                    $a=$l;
                    $b=$l + ($cos-1);
                }
                if($ref < $cos){
                    $a=$l;
                    $b=$total;
                }
            }
            return view('test',compact('user','a','b','total'))->render(); 
    }



    public function downloadExcel($type){
         $data = User::get()->toArray();

        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {
                $sheet->fromArray($data);
            });

        })->download($type);
    }


    function conversion($request){
        $test = $request->has('download');
        if(!$test){
            throw new Exception("Exportation impossible");   
        }else{
            return $test;
        }
    }
   public function pdfview(Request $request){

        $users = User::get();
        view()->share('users',$users);
        try{
            if(this.conversion($request)){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
            }
            return view('pdfview');
        }
        catch(Exception $e){
            return $e.getMessage();
        }

   }


















    /*public function prosses(Request $request){
    	//print_r($request->all());

    	$columns = array(
    		0 => 'username',
    		1 => 'email',
    		2 => 'created_at',
    		3 => 'action'
    	);
    	$totalData = User::count();
    	if($request->input('length') < 0){
    		$limit = 100;
    	}else{
    		$limit = $request->input('length');
    	}
    	$start = $request->input('start');
    	$order = $columns[$request->input('order.0.column')];
    	$dir = $request->input('order.0.dir');

    	if(empty($request->input('search.value'))){
    		$posts = User::offset($start)
    			->limit($limit)
    			->orderBy($order,$dir)
    			->get();
    		$totalFiltered = User::count();
    	}else{
    		$search = $request->input('search.value');
    		$posts = User::where('username','like',"%{$search}%")
    			->orWhere('email','like',"%{$search}%")
    			->orWhere('created_at','like',"%{$search}%")
    			->offset($start)
    			->limit($limit)
    			->orderBy($order,$dir)
    			->get();
    			$totalFiltered = User::where('username','like',"%{$search}%")
    			->orWhere('email','like',"%{$search}%")->count(); 
    	}
    	$data = array();

    	if($posts){
    		foreach ($posts as $r) {
    			$nestedData['username'] = $r->username;
    			$nestedData['email'] = $r->email;
    			$nestedData['created_at'] = date('d-m-Y H:i:s',strtotime($r->created_at));
    			$nestedData['action'] = '
    				<a href="'.$r->id.'" class="btn btn-warning btn-xs">Edit</a>
    				<a href="#" class="btn btn-danger btn-xs">Delete</a>
    			';
    			$data[] = $nestedData;
    		}
    	}
    	$json_data = array(
    		"draw" =>intval($request->input('draw')),
    		"recordsTotal" => intval($totalData),
    		'recordsFiltered' => intval($totalFiltered),
    		"data" => $data
    	);

    	echo json_encode($json_data);
    }*/
}
