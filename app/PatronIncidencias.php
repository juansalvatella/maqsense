<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatronIncidencias extends Model {

    use SoftDeletes;

    protected $table = 'patrones';
    protected $fillable = ['nombre'];

    public function steps()
    {
        return $this->hasMany('App\SecuenciaStep', 'patrones_id');
    }

    public function maquinas()
    {
        return $this->hasMany('App\Maquina', 'patrones_id');
    }

}