<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class nomController extends Controller
{
    public function index(){ /*code*/ }
  
    public function create(){ /*code d'affichage du formulaire de creation*/ }

    public function store(Request $request){ /*code d'enregistrement */ }
  
    public function show($id){ /*code d'affichage */}
  
    public function edit($id){ /*code d'affichage du formulaire de modification*/ }

    public function update(Request $request, $id){ /*code de modification*/ }

    public function destroy($id){ /*code de suppression*/ }
}
