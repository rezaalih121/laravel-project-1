<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // this is for insert protection list of properties allowed to be created 
    // but we also could just disable this protection option in the Provider/AppServiceProvider.php file and in boot() function add this
    // Model::unguard();
    
    protected $fillable = ['title', 'logo' , 'company' , 'location' , 'website' , 'email' ,'tags' , 'description' ];
    public function scopeFilter($query, array $filters){
        //dd($filters['tag']);

        if($filters['tag'] ?? false){
            $query->where('tags','like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false){
            $query->where('title','like', '%' . request('search') . '%')
            ->orWhere('description','like', '%' . request('search') . '%')
            ->orWhere('tags','like', '%' . request('search') . '%')
            ->orWhere('company','like', '%' . request('search') . '%');
        }
    }
} 
