<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class ProjectPictures extends Model
{
    protected $fillable = ['project_id', 'nombre', 'picture_number'];

    public function product()
    {
        return $this->belongsTo(Project::class);
    }
}
