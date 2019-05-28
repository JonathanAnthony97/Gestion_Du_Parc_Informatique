<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\Materielcategorie;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materielcategories')->insert([
            ['categorie' => 'Reseau'],
        	['categorie' => 'Ordinateur'],
        	['categorie' => 'Peripherique'],
        	['categorie' => 'Electrique']]);
        $id_reso = Materielcategorie::where('categorie','=','Reseau')->first();
        $id_ordi = Materielcategorie::where('categorie','=','Ordinateur')->first();
        $id_peri = Materielcategorie::where('categorie','=','Peripherique')->first();
        $id_ele = Materielcategorie::where('categorie','=','Electrique')->first();

        $reso = $id_reso->id_catg;
        $ordi = $id_ordi->id_catg;
        $peri = $id_peri->id_catg;
        $ele = $id_ele->id_catg;

        DB::table('materielcategories')->insert([
            
            ['categorie' => 'Serveur','id_ctg_comp'=>$reso],
            ['categorie' => 'Switch','id_ctg_comp'=>$reso],
            ['categorie' => 'Storage','id_ctg_comp'=>$reso],
            ['categorie' => 'Firewall','id_ctg_comp'=>$reso],
            ['categorie' => 'Laptop','id_ctg_comp'=>$ordi],
            ['categorie' => 'Desktop','id_ctg_comp'=>$ordi],
            ['categorie' => 'Client Léger','id_ctg_comp'=>$ordi],
            ['categorie' => 'Ecran','id_ctg_comp'=>$peri],
            ['categorie' => 'Imprimante','id_ctg_comp'=>$peri],
            ['categorie' => 'Onduleur','id_ctg_comp'=>$ele]

        ]);
    }
}
