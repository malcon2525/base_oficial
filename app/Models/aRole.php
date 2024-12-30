<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles; // Não esqueça de importar o trait

class Role extends Model
{
    use HasFactory, HasRoles; // Inclua o trait HasRoles

    protected $table = 'roles';

    protected $fillable = [
        'name', // Nome do papel
        'guard_name', 
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions');
    }

   

}
