<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

    public $table = 'category';

    public $fillable = [
        'id', 'name','image'
    ];

    protected $append = ['image'];

    protected $hidden = [
        'updated_at'
    ];

    public function getImageAttribute(){
        if (!$this->attributes['image']) {
            return 'public/categories/default.png';
        }
        return $this->attributes['image'];   
    }
}
