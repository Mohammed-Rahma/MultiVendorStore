<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name', 'parent_id', 'description', 'status', 'slug', 'image'
    ];
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::disk('public')->url($this->image);
        }
        return "https://placehold.co/100x100";
    }

    public function  scopeFilter(Builder $query , $request){
        $query->when($request->search, function ($query, $value) {
            $query->where('categories.name', 'Like', "%{$value}%")
                ->orWhere('description', 'Like', "%$value%");
        })->when($request->status , function($query , $value){
            $query->whereStatus($value);
        })->when($request->parent_id , function($query , $value){
            $query->where('categories.name' , 'Like' , "%$value%");
        });
    }
     
    public function scopeActive(Builder $builder){
       $builder->where('status','=', 'active');
    }
    #dynamic scope
    public function scopeStatus(Builder $builder , $status ){
        $builder->where('status','=', $status);
     }
}
