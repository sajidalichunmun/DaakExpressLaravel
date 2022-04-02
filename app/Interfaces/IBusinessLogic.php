<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface IBusinessLogic
{
    public function list();
    public function show($id);
    public function store($request);
    public function update($request,$id);
    public function delete($id);
}
