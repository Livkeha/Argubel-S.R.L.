<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class ProjectBlueprints extends Model
{

  protected $fillable = ['project_id', 'nombre', 'blueprint_number'];

  public function product()
  {
      return $this->belongsTo(Project::class);
  }
}
