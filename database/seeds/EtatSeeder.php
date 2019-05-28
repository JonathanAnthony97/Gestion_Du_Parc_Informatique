<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etats')->insert([
        	['etat' => 'En service'],
        	['etat' => 'En Panne'],
        	['etat' => 'Mauvais'],
            ['etat' => 'Inutilisé']]);
    }
}
