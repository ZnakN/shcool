<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of IndexController
 *
 * @author зс
 */
class IndexController extends Controller
{
  //put your code here
  
  public function index()
  {
    return view('index');
  }
  
  
}