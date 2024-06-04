<?php
namespace App\Traits;

trait CustomDatatable{
    public function textCenter(){
        return fn($row) => "<div class='text-center'>".$row."</div>";
    }

    public function textDate($format){
        return fn($row) => "<div class='text-center'>".\Carbon\Carbon::parse($row)->format($format)."</div>";
    }
}

