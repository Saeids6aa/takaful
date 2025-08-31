<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'admin_id',
        'camp_id',
        'quantity',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class); // campaigns.category_id -> categories.id
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class); // campaigns.admin_id -> admins.id
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }
}
