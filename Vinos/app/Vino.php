<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vino extends Model

{
    
    protected $fillable =['categoria','nombre','descripcion','demora','img'];
}
