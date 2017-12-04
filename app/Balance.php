<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Project;

class Balance extends Model
{
  protected $guarded = [];

  public function users()
  {
      return $this->hasOne(User::class);
  }

  public function projects()
  {
      return $this->hasMany(Project::class);
  }

  public function getCreatedAtAttribute($date)
  {
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
  }

  public function getUpdatedAtAttribute($date)
  {
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
  }

}
