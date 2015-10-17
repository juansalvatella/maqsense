<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maquina extends Model {

    use SoftDeletes;

    protected $table = 'maquinas';
    protected $dates = ['puesta_en_marcha'];
    protected $fillable = [
        'pos_intervencion_inicial',
        'puesta_en_marcha',
        'marca',
        'modelo',
        'no_serie',
        'horas_funcionamiento',
        'no_revisiones_anuales',
        'patrones_id',
//        'localizacion',
        'observaciones'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }

    public function patron()
    {
        return $this->belongsTo('App\PatronIncidencias', 'patrones_id');
    }

    public function incidencias()
    {
        return $this->hasMany('App\Incidencia', 'maquina_id');
    }

    public function steps()
    {
        return $this->hasMany('App\SecuenciaStep', 'maquina_id');
    }

    public function piezas()
    {
        return $this->hasMany('App\Pieza', 'maquina_id');
    }

}