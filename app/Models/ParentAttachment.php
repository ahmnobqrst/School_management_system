<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ParentAttachment extends Model
{
    use HasFactory , HasTranslations, SoftDeletes;

    protected $table = 'parent_attachments';
   public $timestamps = true;
    public $fillable = ['file_name','parent_id','created_at', 'updated_at', 'deleted_at'];
}