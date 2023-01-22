<?php

namespace App\Http\Controllers;

class CSharpController extends Controller
{
   public function __invoke(): void
   {
       $command = 'dotnet %s 5 6 m';
       $output = shell_exec(sprintf($command, base_path('calculator/Test\ app.dll')));

       echo $output;
   }
}
