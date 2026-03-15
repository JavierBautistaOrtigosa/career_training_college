<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
      use HasFactory;

      // Mass-assignable fields for Event model
      protected $fillable = [
            'title',
            'date_time',
            'location',
            'description',
            'category',
      ];
}
