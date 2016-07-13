<?php

namespace App\Model\DB;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'file';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file_name','file_type'];
}
