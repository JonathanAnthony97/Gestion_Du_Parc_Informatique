<?php

namespace App\Http\Controllers;

//Excel
use Excel;
//Pdf
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Model\Materielcategorie;
use App\Model\Materiel;
use App\Model\Site;
use App\Model\Tier;
use App\Model\Departement;
use App\Model\Utilisateur;
use App\Model\Reseaumateriel;
use App\Model\Materielelectrique;
use App\Model\Peripherique;
use App\Model\Ordinateur;
use Response;
use App\Model\Etat;
use App\Model\Reparation;
use App\Events\NewMateriel;
use App\Events\NewModif;
use App\Model\MaterielUtilisateur;
use Illuminate\Support\Facades\DB;
use App\Model\Reform;
use DateTime;

class MaterielController extends Controller
{

    protected $col1 = array('materiels.id_ma as id_ma','num_serie','marque','model','date_acqui','nom','etat','vlr_acqui');
    protected $excel = array('num_serie as Numero_Serie','marque as Marque','model as Modèle','date_acqui as Date_Acquisition','nom as Fournisseur','etat as Etat','vlr_acqui as Valeur_Acquisition');
    protected $col2 = array('materiels.id_ma as id_ma','num_serie','marque','model','date_acqui','nom','vlr_acqui');

    public function __construct()
    {
         $this->middleware('auth');
    }

    private function GetIdReform(){
        $idReform = Reform::get(['id_ma']);
        $tab = array();
        for($i=0;$i<count($idReform);$i++){
            $tab[]=$idReform[$i]->id_ma;
        }
        return $tab;
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
	 //premier chargement et parametrage de la constante d'affichage
    public function index(Request $request,$const = 0){
        if( is_null(Session::get('Par_page')))
            Session::put('Par_page',10);
        $param = null;
        if($const != 0){
            $this->set_Constante($const);
        }
        $cos=$this->get_Constante();
        $m = Materiel::leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
        ->leftJoin('etats as e','e.id_eta','=','materiels.id_eta');

        if(isset($request->gpi)){
            $m = $m->where('materiels.id_catg','=',$request->gpi);
            $param = $request->gpi;
            $stype = Materielcategorie::where('id_ctg_comp',$param)->get();
            
            $nomCat = Materielcategorie::where('id_catg','=',$request->gpi)->first();
        }
        
    	$total=$m->count();
        $ma=$m->paginate($cos,$this->col1);

        $n = $this->algo1($total,$cos);
            $a =$n[0];$b=$n[1];

        if($request->ajax()){
        return view('Parc.materiel',compact('ma','a','b','total'))->render();
        }
        return view('Parc.index',compact('ma','a','b','total','param','nomCat','stype'));
    }


    private function process($z){
        $p = Materielcategorie::where('id_catg','=',$z)->first();
        $parent = Materielcategorie::where('id_catg','=',$p->id_ctg_comp)->first();
        $Cat = $parent->categorie;
        //$sCat = $p->categorie;
        $nomTable = null;
        switch ($Cat) {
            case 'Ordinateur':
                $nomTable = 'ordinateurs';
                //selction where lap ou desk
                break;
            case 'Reseau':
                $nomTable = 'reseaumateriels';
                break;
            case 'Peripherique':
                $nomTable = 'peripheriques';
                break;
            case 'Electrique':
                $nomTable = 'materielelectriques';
                break;
            default:
                # code...
                break;
        }

        $m = DB::table('materiels')
                ->Join('tiers as t','t.id_tier','=','materiels.id_tier')
                ->Join('etats as e','e.id_eta','=','materiels.id_eta')
                ->join($nomTable.' as s','s.id_ma','=','materiels.id_ma')
                ->where('s.id_catg',$z)->select($this->col1);
        return $m;
    }

    public function loadType(Request $request,$id,$const = 0){
        if($const != 0){
            $this->set_Constante($const);
        }
        $cos=$this->get_Constante();
        $m=null;
        if(isset($request->c)){
            $m = $this->searchProcess($id,$request->c);
        }else{
            $m = $this->process($id);
        }
        
  
        $total=$m->count();
        $ma=$m->paginate($cos);
        /////////
        $n = $this->algo1($total,$cos);
                $a =$n[0];$b=$n[1];
        return view('Parc.materiel',compact('ma','a','b','total'))->render();
    }


    private function searchProcess($z,$search){
        $p = Materielcategorie::where('id_catg','=',$z)->first();
        $parent = Materielcategorie::where('id_catg','=',$p->id_ctg_comp)->first();
        $Cat = $parent->categorie;
        //$sCat = $p->categorie;
        $nomTable = null;
        switch ($Cat) {
            case 'Ordinateur':
                $nomTable = 'ordinateurs';
                //selction where lap ou desk
                break;
            case 'Reseau':
                $nomTable = 'reseaumateriels';
                break;
            case 'Peripherique':
                $nomTable = 'peripheriques';
                break;
            case 'Electrique':
                $nomTable = 'materielelectriques';
                break;
            default:
                # code...
                break;
        }

        $m = DB::table('materiels')
                ->Join('tiers as t','t.id_tier','=','materiels.id_tier')
                ->Join('etats as e','e.id_eta','=','materiels.id_eta')
                ->join($nomTable.' as s','s.id_ma','=','materiels.id_ma')
                //->where(['s.id_catg',$z]])
                ->where([['num_serie','like',"%{$search}%"],['s.id_catg',$z]])
                ->orWhere([['marque','like',"%{$search}%"],['s.id_catg',$z]])
                ->orWhere([['model','like',"%{$search}%"],['s.id_catg',$z]])
                ->orWhere([['date_acqui','like',"%{$search}%"],['s.id_catg',$z]])
                ->orWhere([['nom','like',"%{$search}%"],['s.id_catg',$z]])
                ->orWhere([['etat','like',"%{$search}%"],['s.id_catg',$z]])
                ->orWhere([['vlr_acqui','like',"%{$search}%"],['s.id_catg',$z]])
                ->select($this->col1);
        return $m;
    }


    //pagination des sous type
    public function loading(Request $request){
        $cos=$this->get_Constante();
        $m=null;
        if(isset($request->d)){

        $m = $this->searchProcess($request->c,$request->d);
        }else{
            //appel de la fonction processe
        $m = $this->process($request->c);
        }
        
        $total=$m->count();

        $ma=$m->paginate($cos);

        /////////
            $n = $this->algo2($request,$total,$cos);
                $a =$n[0];$b=$n[1];
            return view('Parc.materiel',compact('ma','a','b','total'))->render();
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

            $m = Materiel::leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
            ->leftJoin('etats as e','e.id_eta','=','materiels.id_eta');

            if($request->c > 0)
            {
                $m = $m->where('materiels.id_catg','=',$request->c);
            }
            

                $total=$m->count();
                $ma=$m->paginate($cos,$this->col1);
        }else{
            $search = $request->cle;

            if($request->c > 0)
            {
                $u = Materiel::leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
                ->leftJoin('etats as e','e.id_eta','=','materiels.id_eta')
                ->where([['num_serie','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['marque','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['model','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['date_acqui','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['nom','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['etat','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['vlr_acqui','like',"%{$search}%"],['materiels.id_catg','=',$request->c]]);
            }else{
                $u = Materiel::leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
                ->leftJoin('etats as e','e.id_eta','=','materiels.id_eta')
                ->where('num_serie','like',"%{$search}%")
                ->orWhere('marque','like',"%{$search}%")
                ->orWhere('model','like',"%{$search}%")
                ->orWhere('date_acqui','like',"%{$search}%")
                ->orWhere('nom','like',"%{$search}%")
                ->orWhere('etat','like',"%{$search}%")
                ->orWhere('vlr_acqui','like',"%{$search}%");
            }

            
            $total=$u->count();
            $ma=$u->paginate($cos,$this->col1);
        }
            ////////////
            $n = $this->algo2($request,$total,$cos);
                $a =$n[0];$b=$n[1];
            return view('Parc.materiel',compact('ma','a','b','total'))->render(); 
    }

        //recherche et renvoi par ajax
    public function recherche(Request $request){
        $search=$request->search;
        //dd($request->c);
        $cos=$this->get_Constante();
        
        if($search == null){
             $m=Materiel::leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
             ->leftJoin('etats as e','e.id_eta','=','materiels.id_eta');
             //specification par categorie
             if($request->c > 0 ){
                $m = $m->where('materiels.id_catg','=',$request->c);
             }
             
            $total=$m->count();
            $ma=$m->paginate($cos,$this->col1);
        }else{
        
            if($request->c > 0){
                $u=Materiel::leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
                ->leftJoin('etats as e','e.id_eta','=','materiels.id_eta')
                ->where([['num_serie','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['marque','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['model','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['date_acqui','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['nom','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['etat','like',"%{$search}%"],['materiels.id_catg','=',$request->c]])
                ->orWhere([['vlr_acqui','like',"%{$search}%"],['materiels.id_catg','=',$request->c]]);
                
            }else{
               
                $u=Materiel::leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
                ->leftJoin('etats as e','e.id_eta','=','materiels.id_eta')
                ->where('num_serie','like',"%{$search}%")
                ->orWhere('marque','like',"%{$search}%")->orWhere('model','like',"%{$search}%")
                ->orWhere('date_acqui','like',"%{$search}%")->orWhere('nom','like',"%{$search}%")
                ->orWhere('etat','like',"%{$search}%")->orWhere('vlr_acqui','like',"%{$search}%");
            }
            
            $total=$u->count();
            $ma= $u->paginate($cos,$this->col1);
            
        }
        
            $n = $this->algo1($total,$cos);
                $a =$n[0];$b=$n[1];
        return view('Parc.materiel',compact('ma','a','b','total'))->render();
    }


    public function loader($key,Request $request){
        $page="vide";
        if($request->type == "Ordinateur"){
             $page = "ordi";
        }
        switch ($key) {
            case 'Serveur':
               $page = "server";
                break;
            case 'Switch':
                $page = "switch";
                break;
            case 'Storage':
                $page = "storage";
                break;
            case 'Onduleur':
                $page = "onduleur";
                break;
            case 'Ecran':
                $page = "ecran";
                break;
            case 'Imprimante':
                $page = 'imprimante';
                break;
            default:
                # code...
                break;
        }
        if($page !== "vide"){
            return view('Form.'.$page)->render();
        }else{
            return null;
        }
        
    }

    //reuperation des utilisateurs 
    public function getUtil($id){
        $uti = Utilisateur::where('id_dep','=',$id)->get(['id_uti','prenom']);
        return response()->json($uti);
    }

    //formulaire d'ajout d'un materiel

    public function formAjout(){
        $sites = Site::get();
        $tiers = Tier::where('catg','fournisseur')->get();
        $deps = Departement::get();
        
        $cat = Materielcategorie::where('id_ctg_comp','=',0)->get();
        if(Materielcategorie::count() > 0){
        $id = Materielcategorie::where('id_ctg_comp','=',0)->first();
        $souCat = Materielcategorie::where('id_ctg_comp','=',$id->id_catg)->get();
        $initial=$id->categorie;
        }
        return view('Parc.materielForm',compact('sites','tiers','deps','cat','souCat','initial'));
    }

    //Recuperation des details

    public function getDetail(Request $request,$id){

        $idCat = Materiel::where('id_ma','=',$id)->get(['id_catg']);
         $i=$idCat[0]->id_catg;
        $f = Materielcategorie::where('id_catg','=',$i)->get(['categorie']);
       
        $famille = $f[0]->categorie;

        $categorie = null;
        $type = null;
        $detail =null;
        $souCat = null;
        $page = 'materielResoDetail';
        
        switch ($famille) {
            case 'Ordinateur':
                $categorie = 'ordinateurs';
                $tp = Ordinateur::leftJoin('materielcategories as m',
                    'm.id_catg','=',$categorie.'.id_catg')->where('id_ma','=',$id)->get(['categorie']);
                    $type = $tp[0]->categorie;
                break;
            case 'Reseau':
                $categorie = 'reseaumateriels';
                $model = 'Reseaumateriel';
                $tp = Reseaumateriel::leftJoin('materielcategories as m',
                    'm.id_catg','=',$categorie.'.id_catg')->where('id_ma','=',$id)->get(['categorie']);
                $type= $tp[0]->categorie;
                break;

            case 'Peripherique':
                $categorie = 'peripheriques';
                $tp = Peripherique::leftJoin('materielcategories as m',
                    'm.id_catg','=',$categorie.'.id_catg')->where('id_ma','=',$id)->get(['categorie']);
                $type = $tp[0]->categorie;
                $page = 'periphDetail';
                break;

            case 'Electrique':
                $categorie = 'materielelectriques';
                $tp = Materielelectrique::leftJoin('materielcategories as m',
                    'm.id_catg','=',$categorie.'.id_catg')->where('id_ma','=',$id)->get(['categorie']);
                $type = $tp[0]->categorie;
                $page = 'ElecDetail';
                break;
            default:
                
                break;
        }

        switch ($type) {
            case 'Serveur':
                $souCat = 'serveurs';
                $page = 'serverDetail';
                break;
            case 'Switch':
                $souCat = 'switchs';
                $page = 'switchDetail';
                break;
            /*case 'Firewall':
                $souCat = 'firewalls';
                $page = 'firewallDetail';
                break; */
            case 'Storage':
                $souCat = 'storages';
                $page = 'storageDetail';
                break;
            case 'Onduleur':
                $souCat = 'onduleurs';
                $page = 'onduleurDetail';
                break;
            case 'Ecran':
                $souCat = 'ecrans';
                $page = 'ecranDetail';
                break;
            case 'Imprimante':
                $souCat = 'imprimantes';
                $page = 'imprimanteDetail';
                break;
            default:
                if($categorie == "ordinateurs"){
                    $page = 'ordiDetail';
                }
                break;
        }

        if($souCat != null){
            $dt = Materiel::leftJoin($categorie.' as c','c.id_ma','=','materiels.id_ma')
            ->leftJoin($souCat.' as s','s.id_ma','=','materiels.id_ma');
           
        }else{
            //ordinateur et autre
                $dt = Materiel::leftJoin($categorie.' as c','c.id_ma','=','materiels.id_ma')
                ->leftJoin('materielcategories as t','t.id_catg','=','materiels.id_catg');
            
        }

        $dt = $dt->leftJoin('histoaffectations as histo','histo.id_ma','=','materiels.id_ma')
                ->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
                //->leftJoin('materielutilisateurs as matuti','matuti.date_aff_mat_uti','=','histo.date_aff')
                ->leftJoin('utilisateurs as u','u.id_uti','=','histo.id_uti')
                ->where('materiels.id_ma','=',$id)
                ->orderBy('histo.date_aff','desc')->take(1)->get();        
        $id_ma = $id;
          if(isset($request->modal)){
            return view('ModalDetail.'.$page.'M',compact('id_ma','dt','type'))->render();
          }

          return view('Detail.'.$page,compact('id_ma','dt','type'))->render();
    }

    public function addMa(Request $request){
        $type=$request->nomType;

        if($request->departement > 0){
            $rq = 'required';
        }else{
             $rq = 'nullable';
        }

        $validation = [
                'numSerie'=>'required',
                'marque'=>'required',
                'model'=>'required',
                'Type' =>'not_in:0',
                'fournisseur'=>'not_in:0',
                'dateAcquisition'=>'required|date_format:d-m-Y  H:i',
                'valeurAcquisition'=>'required|numeric',
                'garantie'=>'nullable|integer',
                'dateAffectation'=> $rq.'|date_format:d-m-Y  H:i|after:dateAcquisition',
                'duréeVie'=>'nullable|integer|min:1',
                'maintenable'=>'nullable|integer'
                ];

         if($type == "Client Léger" || $type == "Desktop" || $type == "Laptop"){
            $validation['pack'] = 'nullable|integer';
            $validation['processeur'] = 'nullable|integer';
            $validation['freqCpu'] = 'nullable|numeric';
            $validation['chips'] = 'nullable|integer';
            $validation['totalRam'] = 'nullable|integer';
            $validation['nbDisque'] = 'nullable|integer';
            $validation['tailleParDisque'] = 'nullable|integer';
            }

            if(Materielcategorie::count() > 0){
                $c = Materielcategorie::where('id_catg','=',$request->categParent)->first();
                    if($c->categorie == "Electrique"){
                    $validation['puissance'] = 'nullable|numeric';
                }
            }
         
        switch ($type) {
            case 'Serveur':
                $validation['adrIp'] = 'nullable|ipv4';
                $validation['processeur'] = 'nullable|integer';
                $validation['freqCpu'] = 'nullable|numeric';
                $validation['chips'] = 'nullable|integer';
                $validation['totalRam'] = 'nullable|integer';
                $validation['ethernetPort'] = 'nullable|integer';
                $validation['consolePort'] = 'nullable|integer';
                $validation['nbDisque'] = 'nullable|integer';
                $validation['tailleParDisque'] = 'nullable|integer';
                $validation['pack'] = 'nullable|integer';
                break;
            case 'Switch':
                $validation['ethernetPort'] = 'nullable|integer';
                $validation['consolePort'] = 'nullable|integer';
                break;
            case 'Firewall':
                $validation['ethernetPort'] = 'nullable|integer';
                $validation['consolePort'] = 'nullable|integer';
                break;
            case 'Storage':
                $validation['nbDisque'] = 'nullable|integer';
                $validation['tailleParDisque'] = 'nullable|integer';
                break;
            case 'Onduleur':
                $validation['bateri'] = 'required|integer';
                $validation['phase'] = 'required|integer';
                $validation['intensite'] = 'nullable|integer';
                //$validation['ethernetPort'] = 'nullable|integer';
                //$validation['consolePort'] = 'nullable|integer';
                break;
            default:
                break;
        }
        $validator=Validator::make($request->all(),$validation);
            if($validator->fails())
            {
                return Response::json(['errors'=>$validator->errors()]);
            }
            else{
                 event(new NewMateriel($request));
            }
    }

    public function listParCategorie($cle,$const = 0){
        if($const != 0){
            $this->set_Constante($const);
        }
        $cos=$this->get_Constante();
        $total=Materiel::count();
        $ma=Materiel::leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
        ->leftJoin('etats as e','e.id_eta','=','materiels.id_eta')
        ->where('materiels.id_catg','=',$cle)->paginate($cos,$this->col1);
        
        $n = $this->algo1($total,$cos);
                $a =$n[0];$b=$n[1];
        return view('Parc.index',compact('ma','a','b','total'));
    }


    public function getMenu(){
        $cat = Materielcategorie::where('id_ctg_comp','=',0)->get();
        return response()->json($cat);
    }


    //modification d'un materiel

    public function ModifMAteriel($id){
        $id_cat = Materiel::join('materielcategories as m','m.id_catg','=','materiels.id_catg')
        ->where('materiels.id_ma',$id)->get(['categorie']);
        $catParent = $id_cat[0]->categorie;
        $nomTable = null;
        $souTable = null;
        switch ($catParent) {
            case 'Ordinateur':
                $nomTable = 'ordinateurs';
                break;
            case 'Reseau':
                $nomTable = 'reseaumateriels';
                break;
            case 'Peripherique':
                $nomTable = 'peripheriques';
                break;
            case 'Electrique':
                $nomTable = 'materielelectriques';
                break;
            default:
                # code...
                break;
        }
        $souCat = DB::table($nomTable)
            ->join('materielcategories as m','m.id_catg','=',$nomTable.'.id_catg')
            ->where($nomTable.'.id_ma',$id)->select('categorie')->get();
            $souType = $souCat[0]->categorie;

        $page="materielModif";

        if($souType == "Client Léger" || $souType == "Desktop" || $souType == "Laptop"){
            $page = "ordiModif";
        }
       
        switch ($souType) {
            case 'Serveur':
            $souTable = "serveurs";
               $page = "serverModif";
               
                break;
            case 'Switch':
            $souTable = "switchs";
                $page = "switchModif";
                break;
            case 'Firewall':
                $firewalls;
                $page = "firewallModif";
                break;
            case 'Storage':
                $souTable = "storages";
                $page = "storageModif";
                break;
            case 'Onduleur':
                $souTable = "onduleurs";
                $page = "onduleurModif";
                break;
            case 'Ecran':
            $souTable = "ecrans";
                $page = "ecranModif";
                break;
            case 'Imprimante':
                $souTable = "imprimantes";
                $page = 'imprimanteModif';
                break;
            default:
                
                break;
        }
         

        $md = DB::table('materiels')->where('materiels.id_ma',$id)
                ->leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
                ->leftJoin($nomTable.' as tp','tp.id_ma','=','materiels.id_ma');

                if(isset($souTable)){
                   
                    $md = $md->leftJoin($souTable.' as tf','tf.id_ma','=','materiels.id_ma')
                    ->get();
                }else{
                    $md = $md->get();
                }

                $i = Materiel::where('id_ma','=',$id)
                ->leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
                ->get(['categorie']);
                $initial = $i[0]->categorie;

                switch ($initial) {
                    case 'Ordinateur':
                        $table = 'ordinateurs';
                        break;
                    case 'Reseau':
                        $table = 'reseaumateriels';
                        break;
                    case 'Peripherique':
                        $table = 'peripheriques';
                        break;
                    case 'Electrique':
                        $table = 'materielelectriques';
                        break;
                    default:
                        # code...
                        break;
                }

                $t = DB::table($table)
                    ->leftJoin('materielcategories as m','m.id_catg','=',$table.'.id_catg')
                    ->where($table.'.id_ma','=',$id)->get(['categorie']);
                $type = $t[0]->categorie;
                $tiers = Tier::where([['catg','=','fournisseur'],['id_tier','!=',$md[0]->id_tier]])->get();

                //dd($md);

            return view('Form.'.$page,compact('md','initial','type','tiers'));
                
    }


    public function updateMa(Request $request){
        $id = $request->idMod;
        $type = $request->typ;
        $cat = $request->cat;

        $validation = [
                'numSerie'=>'required',
                'marque'=>'required',
                'model'=>'required',
                'dateAcquisition'=>'required|date_format:d-m-Y  H:i',
                'valeurAcquisition'=>'required|numeric',
                'garantie'=>'nullable|integer',
                'dateAffectation'=>'nullable|date_format:d-m-Y  H:i|after:dateAcquisition',
                'duréeVie'=>'nullable|integer|min:1',
                'maintenable'=>'nullable|integer'
                ];

         if($type == "Client Léger" || $type == "Desktop" || $type == "Laptop"){
            $validation['pack'] = 'nullable|integer';
            $validation['processeur'] = 'nullable|integer';
            $validation['freqCpu'] = 'nullable|numeric';
            $validation['chips'] = 'nullable|integer';
            $validation['totalRam'] = 'nullable|integer';
            $validation['nbDisque'] = 'nullable|integer';
            $validation['tailleParDisque'] = 'nullable|integer';
            }

        if($cat == "Electrique"){
                    $validation['puissance'] = 'nullable|numeric';
                }
                
        switch ($type) {
            case 'Serveur':
                $validation['adrIp'] = 'nullable|ipv4';
                $validation['processeur'] = 'nullable|integer';
                $validation['freqCpu'] = 'nullable|numeric';
                $validation['chips'] = 'nullable|integer';
                $validation['totalRam'] = 'nullable|integer';
                $validation['ethernetPort'] = 'nullable|integer';
                $validation['consolePort'] = 'nullable|integer';
                $validation['nbDisque'] = 'nullable|integer';
                $validation['tailleParDisque'] = 'nullable|integer';
                $validation['pack'] = 'nullable|integer';
                break;
            case 'Switch':
                $validation['ethernetPort'] = 'nullable|integer';
                $validation['consolePort'] = 'nullable|integer';
                break;
            case 'Firewall':
                $validation['ethernetPort'] = 'nullable|integer';
                $validation['consolePort'] = 'nullable|integer';
                break;
            case 'Storage':
                $validation['nbDisque'] = 'nullable|integer';
                $validation['tailleParDisque'] = 'nullable|integer';
                break;
            case 'Onduleur':
                $validation['bateri'] = 'required|integer';
                $validation['phase'] = 'required|integer';
                $validation['intensite'] = 'nullable|integer';
                $validation['ethernetPort'] = 'nullable|integer';
                $validation['consolePort'] = 'nullable|integer';
                break;
            default:
                break;
        }
        $validator=Validator::make($request->all(),$validation);
            if($validator->fails())
            {
                return Response::json(['errors'=>$validator->errors()]);
            }else{
                event(new NewModif($request));
            }
    }

    public function getInfo(Request $request)
    {
        $id = $request->idMa;

        $mat = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
        ->where('id_ma',$id)->first(['num_serie','m.categorie']);
        switch ($mat->categorie) {
            case 'Ordinateur':
                $table = 'ordinateurs';
            break;
            case 'Reseau':
                $table = 'reseaumateriels';
            break;
            case 'Peripherique':
                $table = 'peripheriques';
            break;
            case 'Electrique':
                $table = 'materielelectriques';
            break;
                }

            $type = DB::table($table)->leftJoin('materielcategories as m','m.id_catg','=',$table.'.id_catg')
            ->first(['categorie']);

            return response()->json(['mat'=>$mat->num_serie,'type'=>$type->categorie]);
    }

    public function delMat($id){

        Materiel::where('id_ma',$id)->delete();

    }

    public function MsupMat(Request $request){
        $tab = $request->tab;
        $t = explode(',', $tab);
         Materiel::whereIn('id_ma',$t)->delete();
    }


    public function statistic(){
        $mat = Materiel::count();
        $util = Utilisateur::count();
        $prest = Tier::where('catg','prestataire')->count();
        return response()->json(['mat'=>$mat,'util'=>$util,'prest'=>$prest]);
    }

        public function getSelectEta(){
            $eta = Etat::where([['etat','!=','En service'],['etat','!=','En Panne']])->get();
            return response()->json($eta);
        }

        public function setEtat(Request $request){
            $tab = $request->tab;
            $idEta = $request->idEta;
            $t = explode(',', $tab);
            $mat = Materiel::whereIn('id_ma',$t)->update(['id_eta' => $idEta]);
        }

        public function GeneratExcel($type){
            $m = Materiel::leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
            ->leftJoin('etats as e','e.id_eta','=','materiels.id_eta');
            $data=$m->get($this->excel)->toArray();
        return Excel::create('Liste_Materiel', function($excel) use ($data) {

            $excel->sheet('Liste des Matériels', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);
    }



}
