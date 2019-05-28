<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Utilisateur;
use Illuminate\Support\Facades\Session;
use App\Model\Departement;
use Illuminate\Support\Facades\Validator;
use App\Model\Tier;
use App\Model\Materiel;
use App\Model\Intervention;
use App\Model\Reseaumateriel;
use App\Model\Materielelectrique;
use App\Model\Peripherique;
use App\Model\Ordinateur;
use Excel;
use Response;

class UtilisateurController extends Controller
{

    public function __construct()
    {
         $this->middleware('auth');
    }

    protected $colExcel = array('nom as Fournisseur','adr as Adresse','contact as Contact');
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

    public function index(Request $request,$const = 0){
   
    	if( is_null(Session::get('Par_page2'))){
            Session::put('Par_page2',10);
    	}

        if(is_null(Session::get('Par_page3'))){
        	Session::put('Par_page3',10);
        }

        if(is_null(Session::get('Par_page4'))){
            Session::put('Par_page4',10);
        }

        if(is_null(Session::get('Par_page5'))){
            Session::put('Par_page5',10);
        }

        if($const != 0){
            $this->set_Constante($const);
        }
        if($request->const2 != null){
        	$this->set_Constante2($request->const2);
        }
        if($request->const3 != null){
            $this->set_Constante3($request->const3);
        }
        if($request->const4 != null){
            $this->set_Constante4($request->const4);
        }

        $cos=$this->get_Constante();

        if(isset($request->service)){
        	if($request->service == 0){
        		$total = Utilisateur::count();
        		$ut = Utilisateur::paginate($cos);
        	}else{
        		$total = Utilisateur::where('id_dep',$request->service)->count();
        		$ut = Utilisateur::where('id_dep',$request->service)->paginate($cos);
        	}	
        }else{
        	$total = Utilisateur::count();
        	$ut = Utilisateur::paginate($cos);
        }

        
        $n = $this->algo1($total,$cos);
                $a =$n[0];$b=$n[1];

        $cos2 = $this->get_Constante2();

        $total2 = Tier::where('catg','fournisseur')->count();
        $fsr = Tier::where('catg','fournisseur')->paginate($cos2);

        
        $n1 = $this->algo1($total2,$cos2);
                $a2 =$n1[0];$b2=$n1[1];

        $cos3 = $this->get_Constante3();
        $total3 = Tier::where('catg','prestataire')->count();
        $prest = Tier::where('catg','prestataire')->paginate($cos3);

        
        $n2 = $this->algo1($total3,$cos3);
                $a3 =$n2[0];$b3=$n2[1];

        $cos4 = $this->get_Constante4();
        $total4 = Intervention::count();
        $inter = Intervention::paginate($cos4);

        
        $n3 = $this->algo1($total4,$cos4);
                $a4 =$n3[0];$b4=$n3[1];

        $colum = ['reseaumateriels.id_ma as id_ma','categorie','marque','model','date_acqui'];
        $colum2 = ['materielelectriques.id_ma as id_ma','categorie','marque','model','date_acqui'];
        $colum3 = ['peripheriques.id_ma as id_ma','categorie','marque','model','date_acqui'];
        $colum4 = ['ordinateurs.id_ma as id_ma','categorie','marque','model','date_acqui'];

        $reso = Reseaumateriel::leftJoin('materielcategories as m','m.id_catg','=','reseaumateriels.id_catg')
        						->leftJoin('materiels as mat','mat.id_ma','=','reseaumateriels.id_ma')
        						->get($colum);
        $elec = Materielelectrique::leftJoin('materielcategories as m','m.id_catg','=','materielelectriques.id_catg')
        						->leftJoin('materiels as mat','mat.id_ma','=','materielelectriques.id_ma')
        						->get($colum2);
        $periph = Peripherique::leftJoin('materielcategories as m','m.id_catg','=','peripheriques.id_catg')
        						->leftJoin('materiels as mat','mat.id_ma','=','peripheriques.id_ma')
        						->get($colum3);						
       	$ordi = Ordinateur::leftJoin('materielcategories as m','m.id_catg','=','ordinateurs.id_catg')
        						->leftJoin('materiels as mat','mat.id_ma','=','ordinateurs.id_ma')
        						->get($colum4);

        
        $ser = Departement::get();


        if($request->ajax()){
        	if($request->const2 != null){
        		return view('Parc.suplier',compact('fsr','a2','b2','total2'))->render();
        	}
            if($request->const3 != null){

                return view('Parc.prestataire',compact('prest','a3','b3','total3'))->render();
            }
            else{
                if($request->delPrest == "true"){
                    return view('Parc.prestataire',compact('prest','a3','b3','total3'))->render();
                }
                if($request->delFrs == "true"){
                    return view('Parc.suplier',compact('fsr','a2','b2','total2'))->render();
                }
                if($request->delUti == "true"){
                    return view('Parc.util',compact('ut','a','b','total'))->render();
                }
        		return view('Parc.util',compact('ut','a','b','total'))->render();
        	}
        }

        //dd($reso);

        return view('Parc.utilisateur',compact('ut','a','b','total','ser',
            'fsr','a2','b2','total2','reso','elec','periph','ordi',
            'a3','b3','total3','prest','a4','b4','total4','inter'));

    }

    protected function get_Constante(){
        return Session::get('Par_page2');
    }
    protected function get_Constante2(){
    	return Session::get('Par_page3');
    }
    protected function get_Constante3(){
        return Session::get('Par_page4');
    }
    protected function get_Constante4(){
         return Session::get('Par_page5');
    }
    protected function set_Constante($param){
         Session::put('Par_page2',$param);
    }
    protected function set_Constante2($param){
    	Session::put('Par_page3',$param);
    }
    protected function set_Constante3($param){
        Session::put('Par_page4',$param);
    }
    protected function set_Constante4($param){
        Session::put('Par_page5',$param);
    }

    public function paginer(Request $request)
    {
    	$cos=$this->get_Constante();
    	if($request->arg == null)
    	{
    		$total = Utilisateur::count();
        	$ut = Utilisateur::paginate($cos);
    	}else{
    		$search = $request->arg;
    		$ut = Utilisateur::where('nom_u','like',"%{$search}%")
    							->orWhere('prenom','like',"%{$search}%")
    							->orWhere('adresse','like',"%{$search}%")
    							->orWhere('email','like',"%{$search}%")
    							->orWhere('TelPort','like',"%{$search}%")
    							->orWhere('TelFix','like',"%{$search}%");
    		$total = $ut->count();
    		$ut = $ut->paginate($cos);
    	}
    	
            $n = $this->algo2($request,$total,$cos);
                $a =$n[0];$b=$n[1];

            return view('Parc.util',compact('ut','a','b','total'))->render();
    }

    public function paginerFsr(Request $request){
    	$cos2=$this->get_Constante2();
    	if($request->arg == null)
    	{
    		$total2 = Tier::where('catg','fournisseur')->count();
        	$fsr = Tier::where('catg','fournisseur')->paginate($cos2);
    	}else{
    		$search = $request->arg;
    		$fsr = Tier::Where('nom','like',"%{$search}%")
    							->orWhere('adr','like',"%{$search}%")
    							->orWhere('contact','like',"%{$search}%");
    		$total2 = $fsr->count();
    		$fsr = $fsr->where('catg','fournisseur')->paginate($cos2);
    	}
    	
            $n = $this->algo2($request,$total2,$cos2);
                $a2 =$n[0];$b2=$n[1];
            return view('Parc.suplier',compact('fsr','a2','b2','total2'))->render();
    }


    public function paginerPrst(Request $request){
        $cos3 = $this->get_Constante3();
        if($request->arg == null)
        {
            $total3 = Tier::where('catg','prestataire')->count();
            $prest = Tier::where('catg','prestataire')->paginate($cos3);
        }else{
            $search = $request->arg;
            $prest = Tier::Where('nom','like',"%{$search}%")
                                ->orWhere('adr','like',"%{$search}%")
                                ->orWhere('contact','like',"%{$search}%");
            $total3 = $prest->count();
            $prest = $prest->where('catg','prestataire')->paginate($cos3);
        }
        
            $n = $this->algo2($request,$total3,$cos3);
                $a3 =$n[0];$b3=$n[1];
        return view('Parc.prestataire',compact('prest','a3','b3','total3'))->render();
    }


    public function search(Request $request){
    	$search = $request->search;
        $cos=$this->get_Constante();
        

        if($search == null){
        	if(isset($request->dep)){
        		$total = Utilisateur::where('id_dep',$request->dep)->count();
        		$ut = Utilisateur::where('id_dep',$request->dep)->paginate($cos);
        	}else{
        		$total = Utilisateur::count();
        	$ut = Utilisateur::paginate($cos);
        	}
        }else{
        	
        	if(isset($request->dep)){
                $ut = Utilisateur::where([['nom_u','like',"%{$search}%"],['id_dep',$request->dep]])
                                ->orWhere([['prenom','like',"%{$search}%"],['id_dep',$request->dep]])
                                ->orWhere([['adresse','like',"%{$search}%"],['id_dep',$request->dep]])
                                ->orWhere([['email','like',"%{$search}%"],['id_dep',$request->dep]])
                                ->orWhere([['TelPort','like',"%{$search}%"],['id_dep',$request->dep]])
                                ->orWhere([['TelFix','like',"%{$search}%"],['id_dep',$request->dep]]);
        	}else{
                $ut = Utilisateur::where('nom_u','like',"%{$search}%")
                                ->orWhere('prenom','like',"%{$search}%")
                                ->orWhere('adresse','like',"%{$search}%")
                                ->orWhere('email','like',"%{$search}%")
                                ->orWhere('TelPort','like',"%{$search}%")
                                ->orWhere('TelFix','like',"%{$search}%");
            }
    		$total = $ut->count();
    		$ut = $ut->paginate($cos);
        }
        
                $n = $this->algo1($total,$cos);
                $a =$n[0];$b=$n[1];
        
            return view('Parc.util',compact('ut','a','b','total'))->render();
    }


    public function getDep(Request $request){
    	$dep = Departement::get();
    	return response()->json($dep);
    }

    //ajout d'un utiliateur 
    public function ajout(Request $request)
    {
    	$validator=Validator::make($request->all(),[
                'service'=>'not_in:0',
                'nom'=>'required',
                'prenom'=>'required',
                'email'=>'required|email|unique:utilisateurs',
                'telPortable'=>'required',
                'telFix'=>'required',
                ]);

    	if($validator->fails()){
    		return Response::json(['errors'=>$validator->errors()]);
    	}else{
    		$u = new Utilisateur;
    		$u->id_dep = $request->service;
    		$u->nom_u = strtoupper($request->nom);
    		$u->prenom = ucfirst($request->prenom);
    		$u->adresse = $request->adr;
    		$u->email = $request->email;
    		$u->TelPort = $request->telPortable;
    		$u->TelFix = $request->telFix;

    		$u->save();

    		$const = $this->get_Constante();
    		$total =Utilisateur::count();
    		$last = ceil($total/$const);

    		return response()->json($last);
    	}
    }

    public function recupUtil($id){
    	$u = Utilisateur::where('id_uti',$id)->leftJoin('departements as d','d.id_dep','=','utilisateurs.id_dep')->first();
    	$nonU = Departement::where('id_dep','!=',$u->id_dep)->get();
    	return response()->json(['u'=>$u,'nu'=>$nonU]);
    }

    public function modif(Request $request){
    	$id = $request->idModif;
    
    	if((Utilisateur::where([['email',$request->email],['id_uti','!=',$id]])->count() > 0 ))
        {
        	$param = '|unique:utilisateurs';
        }else{$param ='';}
        $valid=[
                'service'=>'not_in:0',
                'nom'=>'required',
                'prenom'=>'required',
                'email'=>'required|email'.$param,
                'telPortable'=>'required',
                'telFix'=>'required',
                ];

    	$validator=Validator::make($request->all(),$valid);

    	if($validator->fails()){
    		return Response::json(['errors'=>$validator->errors()]);
    	}else{

    		$u = Utilisateur::where('id_uti',$id)->first();
    		$u->id_dep = $request->service;
    		$u->nom_u = $request->nom;
    		$u->prenom = $request->prenom;
    		$u->adresse = $request->adr;
    		$u->email = $request->email;
    		$u->TelPort = $request->telPortable;
    		$u->TelFix = $request->telFix;
    		$u->save();

    		return response()->json($u);
    	}
    	
    }


    public function searchFrs(Request $request){
  		$search = $request->arg;
    	$cos2 = $this->get_Constante2();
    	
    	if($search == null)
    	{
        	$total2 = Tier::where('catg','fournisseur')->count();
        	$fsr = Tier::where('catg','fournisseur')->paginate($cos2);
    	}else{
    		$fsr = Tier::Where('nom','like',"%{$search}%")
    							->orWhere('adr','like',"%{$search}%")
    							->orWhere('contact','like',"%{$search}%");
    		$total2 = $fsr->count();
    		$fsr = $fsr->where('catg','fournisseur')->paginate($cos2);
    	}
    	 
    	
            $n = $this->algo1($total2,$cos2);
                $a2 =$n[0];$b2=$n[1];
        return view('Parc.suplier',compact('fsr','a2','b2','total2'))->render();
    }

    public function searchPrst(Request $request){
        $search = $request->arg;
        $cos3 = $this->get_Constante3();
        
        if($search == null)
        {
            $total3 = Tier::where('catg','prestataire')->count();
            $prest = Tier::where('catg','prestataire')->paginate($cos3);
        }else{
            $prest = Tier::Where('nom','like',"%{$search}%")
                                ->orWhere('adr','like',"%{$search}%")
                                ->orWhere('contact','like',"%{$search}%");
            $total3 = $prest->count();
            $prest = $prest->where('catg','prestataire')->paginate($cos3);
        }
        
            $n = $this->algo1($total3,$cos3);
                $a3 =$n[0];$b3=$n[1];
        return view('Parc.prestataire',compact('prest','a3','b3','total3'))->render();
    }

    public function UtilExcel($type){
        $col = array('dep.nom as Departement','nom_u as Nom','prenom as Prenom','adresse as Adresse','email as Email','TelPort as Tél_Portable','TelFix as Tél_Fixe');
        $data = Utilisateur::leftJoin('departements as dep','dep.id_dep','=','utilisateurs.id_dep')->get($col)->toArray();

        return Excel::create('Utilisateurs', function($excel) use ($data) {

            $excel->sheet('Utilisateurs', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);
    }

    public function FournisseurExcel($type){
     
        $data = Tier::where('catg','fournisseur')->get($this->colExcel)->toArray();
        return Excel::create('Liste_fournisseurs', function($excel) use ($data) {

            $excel->sheet('Fournisseur', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);
    }

    public function PrestatairExcel($type){
        $data = Tier::where('catg','prestataire')->get($this->colExcel)->toArray();
        return Excel::create('Liste_prestataire', function($excel) use ($data) {

            $excel->sheet('Prestataire', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);
    }
}
