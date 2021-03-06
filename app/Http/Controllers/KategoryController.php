<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\KategoriRepository;

class KategoryController extends Controller
{

     Public Function Index()
    {
    	$kategoryRepo=new KategoriRepository;
       	$kategoris = $kategoryRepo->getCategoryList();
    	return view('kategori.index', compact('kategoris')); // 3
    }
   	
   	 Public Function Create()
    {
        return view('kategori.create');
    }

    Public Function Save(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|string|max:100'
        // ]);
        $aa = $request->all();
        $name = $aa['name'];
        // $name= ['name'=>$request->name];
        $kategoryRepo=new KategoriRepository;
	   // function createCategory($name)
    //    	{
        $kategoris = $kategoryRepo->createCategory($name);
        if($kategoris) return redirect('/kategori')->with(['success' => '<strong>' . $kategoris->name . '</strong> Telah disimpan']);
        else return redirect('/kategori/new')->with(['error' => $e->getMessage()]); 
        // }
       
    }

    //fungsi update kategori
    Public Function Edit($id)
    {
    	$kategoryRepo=new KategoriRepository;
    	$kategoris = $kategoryRepo->getCategoryId($id);
    	return view('kategori.edit', compact('kategoris'));
    }

    Public Function Update(Request $request, $id)
    {
        $aa = $request->all();
        $name = $aa['name'];
        $kategoryRepo=new KategoriRepository;
        $kategoris = $kategoryRepo->UpdateCategory($id, $name);
        if($kategoris) return redirect('/kategori')->with(['success' => '<strong>' . $name . '</strong> Telah diupdate']);
        else return redirect('/kategori')->with(['error' => $e->getMessage()]); 
        // }
    }

    Public Function Delete($id)
    {
    	$kategoryRepo=new KategoriRepository;
    	$kategoris = $kategoryRepo->DeleteCategory($id);
    	if($kategoris) return redirect('/kategori')->with(['success' =>  'Data Berhasil dihapus']);
    {
    	$kategoryRepo=new KategoriRepository;
    	$kategoris = $kategoryRepo->getCategoryId($id);
    	return view('kategori.edit', compact('kategoris'));
    }
}
}