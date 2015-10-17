<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoIntervencion extends Model {

    use SoftDeletes;

    protected $table = 'tipo_intervenciones';
    protected $fillable = ['nombre','descripcion'];

    public function steps()
    {
        return $this->hasMany('App\SecuenciaStep', 'tipo_intervenciones_id');
    }

    public function incidencias()
    {
        return $this->hasMany('App\Incidencia', 'tipo_intervenciones_id');
    }

    public function piezas()
    {
        return $this->hasMany('App\Piezas', 'tipo_intervenciones_id');
    }

}