<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Model\Panne;
use App\Model\Materiel;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Response;
use Excel;
use DB;

class PaneController extends Controller
{
	public function __construct()
    {
         $this->middleware('auth');
    }
    protected  $col = ['pannes.id_pan as id_pan','pannes.date_pan as date_pan','pannes.description','rp.id_pan as id_rp'];
    protected  $col2 = ['pannes.date_pan as Date_Panne','pannes.description as Observation'];

    private function set_Constante($param){
    	Session::put('Par_page11',$param);
    }
    private function set_ConstantePan($param){
        Session::put('Par_page14',$param);
    }
    private function set_Constante15($param){
        Session::put('Par_page15',$param);
    }

    private function get_Constante(){
    	return Session::get('Par_page11');
    }
    private function get_ConstantePan(){
        return Session::get('Par_page14');
    }
    private function get_Constante15(){
        return Session::get('Par_page15');
    }

        //algorithme d'affichage
    private function algo1($total,$cos){
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
		$tab[] = $a;
		$tab[] = $b;
		return $tab;
    }

    //special pagination
    private function algo2($request,$total,$cos){
    	$a=1;
    	$lien=intval($request->page);
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
	    $tab[] = $a;
		$tab[] = $b;
		return $tab;
    }
   
    public function getPanne(Request $request,$const = 0){
    	if( is_null(Session::get('Par_page11'))){
            Session::put('Par_page11',9);
 		}
 		if($const != 0){
 			 $this->set_Constante($const);
 		}
 		$cos = $this->get_Constante();

        $pan = Panne::where('id_ma',$request->idMa)
            ->leftJoin('reparations as rp','rp.id_pan','=','pannes.id_pan');
        if(isset($request->arg)){
            $search = $request->arg;
            $pan = $pan->where([['date_pan','like',"%{$search}%"],['id_ma',$request->idMa]])
                ->orWhere([['pannes.description','like',"%{$search}%"],['id_ma',$request->idMa]]);
        }else{
            $pan = $pan->orderBy('date_pan','desc');
        }
	
 		$total = $pan->count();
 		$pans = $pan->paginate($cos,$this->col);

 		$n = $this->algo1($total,$cos);
            $a =$n[0];$b=$n[1];
        return view('Parc.panne',compact('a','b','total','pans'))->render();

    }

        public function PanExcel(Request $request,$type){
        $mat = $request->mat;
        $id = $request->idMa;

        $data = Panne::where('id_ma',$request->idMa)
        ->leftJoin('reparations as rp','rp.id_pan','=','pannes.id_pan')
            ->orderBy('date_pan','desc')->get($this->col2)->toArray();
            
        return Excel::create('Pannes | '.$mat, function($excel) use ($data) {
                $excel->sheet('Panne', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);
    }

    public function paginPane(Request $request){
    	$cos = $this->get_Constante();

    	$pan = Panne::where('id_ma',$request->idMa)
 		->leftJoin('reparations as rp','rp.id_pan','=','pannes.id_pan')
 			->orderBy('date_pan','desc');
 		$total = $pan->count();
 		$pans = $pan->paginate($cos,$this->col);

    	$n = $this->algo2($request,$total,$cos);
                $a = $n[0];$b=$n[1];
         return view('Parc.panne',compact('a','b','total','pans'))->render();
    }

    public function getMonoPan(Request $request){
    	$p =Panne::where('id_pan',$request->idPan)->first();
    	return response()->json($p);
    }


    public function ModifPanne(Request $request){
    	$id=$request->idPan;
    	$id_mat = $request->id_mat;

    	$acqui = Materiel::where('id_ma',$request->id_mat)->first(['date_acqui']);
            $dt = DateTime::createFromFormat('Y-m-d H:i:s',$acqui->date_acqui)->format('d-m-Y');
            $rg = '|after:'.$dt;
            $validator=Validator::make($request->all(),[
                'datePane' => 'required|date_format:d-m-Y'.$rg,
                'description' => 'required'
                ]);
            if($validator->fails()){
                return Response::json(['errors'=>$validator->errors()]);
            }else{
            	$pan = Panne::where('id_pan',$id)->first();
            	$pan->date_pan = DateTime::createFromFormat('d-m-Y',$request->datePane)->format('Y-m-d');
            	$pan->description = $request->description;
            	$pan->save();
            	$res = Panne::leftJoin('reparations as rp','rp.id_pan','=','pannes.id_pan')
            	->where('pannes.id_pan',$id)->first($this->col);
            	return response()->json($res);
            }
    }

    public function histopane(Request $request,$const = 0){
        if( is_null(Session::get('Par_page14'))){
            Session::put('Par_page14',10);
        }
        if( is_null(Session::get('Par_page15'))){
            Session::put('Par_page15',10);
        }
        if($const != 0){
             $this->set_ConstantePan($const);
        }
        $cos = $this->get_ConstantePan();
        

        $col = array('m.id_ma','m.num_serie','m.marque','mt.categorie','dep.nom');

        $table = array('reseaumateriels','ordinateurs','peripheriques','materielelectriques');
        $mat = array();
        if(isset($request->arg)){
            $arg = $request->arg;
            for($k=0;$k<count($table);$k++){
                $m = DB::table($table[$k])->leftJoin('materiels as m','m.id_ma','=',$table[$k].'.id_ma')
                    ->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$k].'.id_ma')
                    ->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
                    ->leftJoin('materielcategories as mt','mt.id_catg','=',$table[$k].'.id_catg')
                    ->where('m.num_serie','like',"%{$arg}%")
                    ->orWhere('m.marque','like',"%{$arg}%")
                    ->orWhere('mt.categorie','like',"%{$arg}%")
                    ->orWhere('dep.nom','like',"%{$arg}%")
                    ->orderBy('histo.date_aff','desc')
                    ->get($col);
                for($p=0;$p<count($m);$p++){
                    $mat[] = $m[$p];
                }
            }
        }else{
            for($k=0;$k<count($table);$k++){
                $m = DB::table($table[$k])->leftJoin('materiels as m','m.id_ma','=',$table[$k].'.id_ma')
                    ->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$k].'.id_ma')
                    ->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
                    ->leftJoin('materielcategories as mt','mt.id_catg','=',$table[$k].'.id_catg')
                    ->orderBy('histo.date_aff','desc')
                    ->get($col);
                for($p=0;$p<count($m);$p++){
                    $mat[] = $m[$p];
                }
            }
        }
            for($i=0;$i<count($mat);$i++)
            {
                 $nbPane = Panne::where('id_ma',$mat[$i]->id_ma)->count();
                 $done[] = array('id_ma'=>$mat[$i]->id_ma,
                                 'Numero_Serie'=>$mat[$i]->num_serie,
                                 'Marque'=>$mat[$i]->marque,
                                 'Type'=>$mat[$i]->categorie,
                                 'Departement'=>$mat[$i]->nom,
                                 'Pannes'=>$nbPane);
            }
            for($d=0;$d<count($done)-1;$d++){
                for($j=$d+1;$j<count($done);$j++){
                    if($done[$d]['Pannes'] < $done[$j]['Pannes']){
                        $temp = $done[$d];
                        $done[$d] = $done[$j];
                        $done[$j] = $temp;
                    }
                }  
            }
            if(!isset($done)){
                $done=array();
            }
            $total = count($done);

            if(isset($request->page)){
                $n = $this->algo2($request,$total,$cos);
                $a =$n[0];$b=$n[1];
            }else{
                $n = $this->algo1($total,$cos);
                $a =$n[0];$b=$n[1];
            }

            $trace = $this->paginer($request,$done,$cos); 
        
            if($request->ajax()){
                return view('Parc.listHistoPane',compact('trace','a','b','total'))->render();
            }else{
                return view('Parc.histopane',compact('trace','a','b','total'));
            }
    }

    //generation d'excel
    public function TotalPaneExcel($type){
        $col = array('m.id_ma','m.num_serie','m.marque','mt.categorie','dep.nom');

        $table = array('reseaumateriels','ordinateurs','peripheriques','materielelectriques');
        $mat = array();
        for($k=0;$k<count($table);$k++){
                $m = DB::table($table[$k])->leftJoin('materiels as m','m.id_ma','=',$table[$k].'.id_ma')
                    ->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$k].'.id_ma')
                    ->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
                    ->leftJoin('materielcategories as mt','mt.id_catg','=',$table[$k].'.id_catg')
                    ->orderBy('histo.date_aff','desc')
                    ->get($col);
                for($p=0;$p<count($m);$p++){
                    $mat[] = $m[$p];
                }
            }
            for($i=0;$i<count($mat);$i++)
            {
                 $nbPane = Panne::where('id_ma',$mat[$i]->id_ma)->count();
                 $done[] = array('Numero_Serie'=>$mat[$i]->num_serie,
                                 'Marque'=>$mat[$i]->marque,
                                 'Type'=>$mat[$i]->categorie,
                                 'Departement'=>$mat[$i]->nom,
                                 'Pannes'=>$nbPane);
            }
            for($d=0;$d<count($done)-1;$d++){
                for($j=$d+1;$j<count($done);$j++){
                    if($done[$d]['Pannes'] < $done[$j]['Pannes']){
                        $temp = $done[$d];
                        $done[$d] = $done[$j];
                        $done[$j] = $temp;
                    }
                }  
            }
            if(!isset($done)){
                $done=array();
            }
            $data = json_decode(json_encode($done),true);
            return Excel::create('Satistiques de Pannes', function($excel) use ($data){
                $excel->sheet('Panne', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);
    }

    public function HistoPaneExcel(Request $request,$type){
       $nom = $request->type.' '.$request->seri.' '.$request->marque;
       $col = array('date_pan as Date Panne','description as Description de la Panne');
       $id = $request->idMa;
       $data = Panne::where('id_ma',$id)->orderBy('date_pan','desc')->get($col)->toArray();
       return Excel::create('Pannes : '.$nom, function($excel) use ($data){
                $excel->sheet('Panne', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);

    }
    //pagination
    private function paginer(Request $request,$done,$cos){
        $page = isset($request->page) ? $request->page : 1;
        $perPage = $cos;
        $offset = ($page * $perPage) - $perPage;
        $trace = new LengthAwarePaginator(
            array_slice($done,$offset,$perPage,true),
            count($done),$perPage,$page,
            ['path'=>$request->url(),'query' => $request->query()]
        );
        return $trace;
    }


    public function detailpane($id){
        $cos = $this->get_Constante15();
        $pane = Panne::where('id_ma',$id)->orderBy('date_pan','desc');
        $total1 = $pane->count();
        $pane = $pane->paginate($cos);
        $n = $this->algo1($total1,$cos);

         $a1 =$n[0];$b1=$n[1];
                
        return view('Parc.listPane',compact('pane','a1','b1','total1'))->render();
    }

    public function histopanAjax(Request $request,$const = 0){
        if($const != 0){
             $this->set_Constante15($const);
        }
        $cos = $this->get_Constante15();

        if(isset($request->arg)){
            $arg = $request->arg;
            $pane = Panne::where('id_ma',$request->id)
            ->where([['date_pan','like',"%{$arg}%"],['id_ma',$request->id]])
            ->orWhere([['description','like',"%{$arg}%"],['id_ma',$request->id]])
            ->orderBy('date_pan','desc');
        }else{
            $pane = Panne::where('id_ma',$request->id)->orderBy('date_pan','desc');
        }
        $total1 = $pane->count();
        $pane = $pane->paginate($cos);
        if(isset($request->page)){
            $n = $this->algo2($request,$total1,$cos);
            $a1 =$n[0];$b1=$n[1];
        }else{
            $n = $this->algo1($total1,$cos);
            $a1 =$n[0];$b1=$n[1];
        }
        
        return view('Parc.listPane',compact('pane','a1','b1','total1'))->render();

    }
    public function DeletePane($id){
        Panne::where('id_pan',$id)->delete();
    }

    public function getPanRep(Request $request){
        $id = $request->id;
        $pan = Panne::leftJoin('reparations as rp','rp.id_pan','=','pannes.id_pan')
        ->where('id_ma',$id)->orderBy('date_pan','desc')->get($this->col);
        
            return response()->json($pan);
    }

    public function delPane($id){
        Panne::where('id_pan',$id)->delete();
    }


}
