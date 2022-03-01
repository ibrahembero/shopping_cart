<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // here we will declare the name of table
    protected $table="carts";
    //white box that can we add valus in database
    // photo cannot take value
    protected $fillable=['product_id','user_id','created_at','updated_at'];
    //when we select all from table only fillable can return
    //without hidden 
    protected $hidden=['created_at','updated_at'];
    // if we will make timestamps false
    public $timestamps=true;
}
