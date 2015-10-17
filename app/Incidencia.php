<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incidencia extends Model {

    use SoftDeletes;

    protected $table = 'incidencias';
    protected $dates = ['fecha_programada','fecha_prevision_programacion'];
    protected $fillable = [
        'fecha_programada',
        'fecha_prevision_programacion',
        'estado',
        'tipo',
        'step_posicion',
        'seguimiento',
        'descripcion',
        'no_of',
        'check_material',
        'contrato',
        'urgente',
        'cliente_id',
        'maquina_id',
        'tipo_intervenciones_id'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }

    public function maquina()
    {
        return $this->belongsTo('App\Maquina', 'maquina_id');
    }

    public function tipo_intervencion()
    {
        return $this->belongsTo('App\TipoIntervencion', 'tipo_intervenciones_id');
    }

}