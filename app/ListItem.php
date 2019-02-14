<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    //
    protected $table = 'lists';
    protected $fillable = [
    	'city_id',
    	'developer_id',
    	'name',
    	'price',
    	'isOnSale'
    ];

    public $timestamps = true;

}
