<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function me(){
       return [
        'NIS' => 3103119179,
        'Name' => 'Shabrina Talita Kuswoyo',
        'Gender' => 'Female',
        'Phone' => '081225145323',
        'Class' => 'XII RPL 6'
       ];
   }
}
