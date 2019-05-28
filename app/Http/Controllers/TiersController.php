<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tier;
use App\Model\Departement;
use App\Model\Materielcategorie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Model\Reseaumateriel;
use App\Model\Materielelectrique;
use App\Model\Peripherique;
use App\Model\Ordinateur;
use App\Model\Utilisateur;
use App\Model\Materiel;

use Response;
class TiersController extends Controller
{

	public function __construct()
    {
         $this->middleware('auth');
    }
	//ajout d'un fournisseur
    public function add(Request $request){
        if(is_null(Session::get('Par_page3'))){
            Session::put('Par_page3',10);
        }
    	$validator=Validator::make($request->all(),[
                'nom'=>'required|unique:tiers',
                'contact'=>'required'
                ]);
            if($validator->fails())
            {
                return Response::json(['errors'=>$validator->errors()]);
            }
            else
            {
            	$t = new Tier;
            	$t->nom = $request->nom;
            	$t->adr = $request->adresse;
            	$t->contact = $request->contact;
            	$t->catg = "fournisseur";
            	$t->save();
            
                $const = $this->get_Constante3();
                
                $total =Tier::where('catg','fournisseur')->count();
                $last = ceil($total/$const);

                return response()->json(['t'=>$t,'last'=>$last]);
            }
    }

    public function addPrest(Request $request){

        if(Tier::where([['nom',$request->nom],['catg','prestataire']])->count() > 0){
            $param = '|unique:tiers';
        }else{
            $param = '';
        }
        $valid = [ 'nom'=>'required'.$param,
                'contact'=>'required'];
        $validator=Validator::make($request->all(),$valid);

        if($validator->fails())
            {
                return Response::json(['errors'=>$validator->errors()]);
            }else{
                $t = new Tier;
                $t->nom = $request->nom;
                $t->adr = $request->adresse;
                $t->contact = $request->contact;
                $t->catg = "prestataire";
                $t->save();

                $cos = $this->get_Constante3();
                $total = Tier::where('catg','prestataire')->count();
                $last = ceil($total/$cos);
                return response()->json($last);
            }
    }

    public function modifPrest(Request $request){

        if(Tier::where([['nom',$request->nom],['catg','prestataire'],['id_tier','!=',$request->idModPrst]])
            ->count() > 0){
                $param = '|unique:tiers';
                }else{ $param = ''; }

                $valid = [ 'nom'=>'required'.$param,
                'contact'=>'required'];

                $validator=Validator::make($request->all(),$valid);
                
                if($validator->fails())
                {
                     return Response::json(['errors'=>$validator->errors()]);
                }else{
                    $t = Tier::find($request->idModPrst);
                    $t->nom = $request->nom;
                    $t->contact =$request->contact;
                    $t->adr = $request->adresse;
                    $t->save();
                    return response()->json($t);
                }
    }

    private function get_Constante3(){
        return Session::get('Par_page3');
    }
    //ajout d'un departement
    public function addDep(Request $request){
	    	$validator=Validator::make($request->all(),[
	        'nom'=>'required',
	        'site'=>'not_in:0'
	        ]);
            if($validator->fails())
            {
                return Response::json(['errors'=>$validator->errors()]);
            }else{
            	$dep = new Departement;
            	$dep->id_site = $request->site;
            	$dep->nom = $request->nom;
            	$dep->save();
            	return response()->json($dep);
            }
    }
    //ajout d'un categorie/sous categorie materiel

    public function addCat(Request $request){
    	$validator=Validator::make($request->all(),[
	        'categorie'=>'required|unique:materielcategories',
	        ]);
    		if($validator->fails())
            {
                return Response::json(['errors'=>$validator->errors()]);
            }else{
            	$c = new Materielcategorie;
            	$c->categorie = ucfirst($request->categorie);
            	if($request->parent == null){
            		$c->id_ctg_comp = 0;
            	}else{
            		$c->id_ctg_comp = $request->parent;
            	}
            	$c->save();
            	return response()->json($c);
            }
    }



    public function getSoutCategorie($id){
    	$souCat =Materielcategorie::where('id_ctg_comp','=',$id)->get();
    	return response()->json($souCat);
    }

    public function RecupMateriel($id){
        $colum = ['reseaumateriels.id_ma as id_ma','categorie','marque','model','date_acqui'];
        $colum2 = ['materielelectriques.id_ma as id_ma','categorie','marque','model','date_acqui'];
        $colum3 = ['peripheriques.id_ma as id_ma','categorie','marque','model','date_acqui'];
        $colum4 = ['ordinateurs.id_ma as id_ma','categorie','marque','model','date_acqui'];

        $reso = Reseaumateriel::leftJoin('materielcategories as m','m.id_catg','=','reseaumateriels.id_catg')
                                ->leftJoin('materiels as mat','mat.id_ma','=','reseaumateriels.id_ma');
                                
        $elec = Materielelectrique::leftJoin('materielcategories as m','m.id_catg','=','materielelectriques.id_catg')
                                ->leftJoin('materiels as mat','mat.id_ma','=','materielelectriques.id_ma');
                                
        $periph = Peripherique::leftJoin('materielcategories as m','m.id_catg','=','peripheriques.id_catg')
                                ->leftJoin('materiels as mat','mat.id_ma','=','peripheriques.id_ma');
                                                   
        $ordi = Ordinateur::leftJoin('materielcategories as m','m.id_catg','=','ordinateurs.id_catg')
                                ->leftJoin('materiels as mat','mat.id_ma','=','ordinateurs.id_ma');
                                

        if($id != "0"){
            $reso = $reso->where('id_tier','=',$id);
            $elec = $elec->where('id_tier','=',$id);
            $periph = $periph->where('id_tier','=',$id);
            $ordi = $ordi->where('id_tier','=',$id);
        }
        $reso = $reso->get($colum);
        $elec = $elec->get($colum2);
        $periph = $periph->get($colum3);
        $ordi = $ordi->get($colum4);

        return response()->json(['reso'=>$reso,'elec'=>$elec,'periph'=>$periph,'ordi'=>$ordi]);
    }


    public function modif(Request $request){

        if(Tier::where([['nom',$request->nom],['id_tier','!=',$request->id_fsr_modif]])->count() > 0){
            $param = '|unique:tiers';
        }else{
            $param = '';
        }

        $valid = [
                'nom'=>'required'.$param,
                'contact'=>'required'
                ];
        $validator=Validator::make($request->all(),$valid);
            if($validator->fails())
            {
                return Response::json(['errors'=>$validator->errors()]);
            }else{

                $f = Tier::find($request->id_fsr_modif);
                $f->nom = $request->nom;
                $f->adr = $request->adresse;
                $f->contact = $request->contact;
                $f->save();

                return response()->json($f);
            }
    }

    public function edit($id){
        $f = Tier::find($id);
        return response()->json($f);
    }

    public function recupPrst($id){
        $f = Tier::find($id);
        return response()->json($f);
    }


    public function getOptSelect(){
        $prest = Tier::where('catg','prestataire')->get();
        $dep = Departement::get();
        return response()->json(['prest'=>$prest,'dep'=>$dep]);
    }

    public function getPrest(){
        $prest = Tier::where('catg','prestataire')->get();
        return response()->json($prest);
    }

    public function delPrest($id){
        Tier::where('id_tier',$id)->delete();
    }

    public function delFrs($id){
        Tier::where('id_tier',$id)->delete();
    }

    public function delUti($id){
        Utilisateur::where('id_uti',$id)->delete();
    }

}
