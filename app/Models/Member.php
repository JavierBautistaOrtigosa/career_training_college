<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
      use HasFactory;

      protected $fillable = [
            'first_name',
            'last_name',
            'age',
            'email',
            'phone',
            'address',
            'professional_summary',
      ];

      public function getFullNameAttribute()
      {
            // This functions allows the members table to show the following:
            // {{ $member->full_name }}
            return $this->first_name . ' ' . $this->last_name;
      }
}
