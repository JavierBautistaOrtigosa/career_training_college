<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
      use HasFactory;

      // Mass-assignable fields for Member model
      protected $fillable = [
            'first_name',
            'last_name',
            'age',
            'email',
            'phone',
            'address',
            'professional_summary',
      ];

      // Accessor: returns "First Last" when using $member->full_name
      public function getFullNameAttribute()
      {
            // Allows Blade usage: {{ $member->full_name }}
            return $this->first_name . ' ' . $this->last_name;
      }
}
