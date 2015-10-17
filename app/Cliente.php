<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model {

    use SoftDeletes;

    protected $table = 'clientes';
    protected $fillable = ['nombre','persona_contacto','tlf_contacto','direccion','observaciones'];

    public function maquinas()
    {
        return $this->hasMany('App\Maquina', 'cliente_id');
    }

    public function incidencias()
    {
        return $this->hasMany('App\Incidencia', 'cliente_id');
    }

}