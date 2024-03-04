<?php

namespace App\Controllers;
use Throwable;
class Home extends BaseController
{
    

    public function index()
    {
        $migrate = \Config\Services::migrations();

        try{

            $migrate->latest();
            
        } catch (Throwable $e){

            print_r($e) ;
        }
    }
}
