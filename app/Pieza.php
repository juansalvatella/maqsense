<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pieza extends Model {

    use SoftDeletes;

    protected $table = 'piezas';
    protected $fillable = [
        'nombre',
        'referencia',
        'cantidad',
        'tipo_intervenciones_id',
        'maquina_id'
    ];
    protected $dates = ['deleted_at'];

    public function maquina()
    {
        return $this->belongsTo('App\Maquina', 'maquina_id');
    }

    public function tipo_intervencion()
    {
        return $this->belongsTo('App\TipoIntervencion', 'tipo_intervenciones_id');
    }

}