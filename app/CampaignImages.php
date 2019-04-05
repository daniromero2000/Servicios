<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignImages extends Model
{
    public $timestamps = false;

    protected $table = 'campaign_images';

    protected $fillable = ['id','name','campaign'];
}
