<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Project;
use App\Balance;

class User extends Authenticatable
{

    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects()
    {
      return $this->belongsTo(Project::class);
    }

    public function balances()
    {
      return $this->belongsTo(Balance::class);
    }

    public function isAdministrator()
   {
       return $this->hasRole('Administrador');
   }

    public function isClient()
   {
       return $this->hasRole('Cliente');
   }
}
