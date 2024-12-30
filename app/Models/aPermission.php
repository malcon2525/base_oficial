<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class Permission extends Model
{
    use HasFactory, HasRoles; // Inclua o trait HasRoles

    protected $table = 'permissions';

    protected $fillable = [
        'name', // Nome do papel
        'guard_name', 
    ];

    
}
