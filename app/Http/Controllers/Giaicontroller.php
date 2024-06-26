<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Giaicontroller extends Controller
{
    public function getPt1(){
        return view('Giaipt');
    }
    public function postPt1 (Request $req){
        $validated = $req->validate([
            'hsa'=>'required|numeric',
            'hsb'=>'required|numeric',
        ],[
            'hsa.required'=>'HỆ SỐ A KHÔNG ĐƯỢC ĐỂ TRỐNG',
            'hsa.numeric'=>'A LÀ SỐ',
            'hsb.required'=>'HỆ SỐ B KHÔNG ĐƯỢC ĐỂ TRỐNG',
            'hsb.numeric'=>'B LÀ SỐ',
        ]
    );
    $a=$req->hsa;   
    $b=$req->hsb;
    if($a==0)
        if($b==0)
            $kq="pt vo so nghiệm";
        else $kq="pt vo nghiệm";
    else $kq="nghiệm của pt la". -$b/$a;
    return view ('Giaipt',compact('kq','a','b'));
    }
};

