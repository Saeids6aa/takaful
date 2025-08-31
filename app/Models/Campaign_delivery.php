<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign_delivery extends Model
{
    use HasFactory;
            protected $fillable = [
        'status',
        'campaign_id',
        'familiy_id',
        'admin_id',
        'image',
        'description',
    ];

        public function campaign() { return $this->belongsTo(Campaign::class); }
    public function family()   { return $this->belongsTo(Family::class, 'familiy_id'); }
    public function admin()    { return $this->belongsTo(Admin::class); }

}
