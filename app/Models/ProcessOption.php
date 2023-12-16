<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessOption extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'process_options';

    protected $fillable = [
        'process',
    ]; 
}