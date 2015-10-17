<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SecuenciaStep extends Model {

    use SoftDeletes;

    protected $table = 'secuencia_steps';
    protected $fillable = ['posicion','seguimiento','periodo','tipo_intervenciones_id','patrones_id','maquina_id'];

    public function patron()
    {
        return $this->belongsTo('App\PatronIncidencias', 'patrones_id');
    }

    public function tipointervencion()
    {
        return $this->belongsTo('App\TipoIntervencion', 'tipo_intervenciones_id');
    }

    public function maquina()
    {
        return $this->belongsTo('App\Maquina', 'maquina_id');
    }

}