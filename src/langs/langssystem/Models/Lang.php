<?php

namespace langs\langssystem\Models;

use App\Helpers\CustomHelper;
use Illuminate\Database\Eloquent\Model;
use langs\langssystem\Models\LangFields;

class Lang extends Model
{
    protected $table = 'langs';

    protected $guarded = ['id'];

    protected $fillable = [
        'iso_code',
        'name',
        'id_lang',

    ];

    public function getLang()
    {
        $this->value = \Session()->get('lang');

        $this->lang = Lang::select('id_lang')->where('langs.iso_code', '' . $this->value . '')->value('id_lang');

        return $this->lang;
    }

    public static function getLangsCount()
    {
        $langsall = Lang::all();

        return count($langsall);

    }

    public static function getLangsCountdos()
    {
        return Lang::select('id', 'name', 'iso_code', 'id_lang')->get();

    }

    public static function getLangsIds()
    {

        return Lang::select('id_lang', 'name', 'iso_code')->get();

    }

    public function insertDatas($typelanstable, $idlangstable, $id_lang, $array)
    {

        $countlangs = $this->getLangsCount();

        // $langsIds = $this->getLangsIds();

        $datas = $typelanstable::find($idlangstable);

        $array = $this->preparedatas($array, $id_lang);

        $datas->langstab()->create($array);

    }

    //Method used in updates lang_field forms
    public function checkid($typelanstable, $idlangstable, $id_lang, $array)
    {

        $langsids = LangFields::where([
            ['langstable_id', '=', $idlangstable],
            ['langstable_type', '=', $typelanstable],
        ])->pluck('id_lang')->toArray();

        if (in_array($id_lang, $langsids)) {

        } else {

            $datas = $typelanstable::find($idlangstable);

            $array = $this->preparedatas($array, $id_lang);

            $datas->langstab()->create($array);
        }

    }

    public function ids($typelanstable, $idlangstable, $id_lang)
    {
        return LangFields::where([
            ['langstable_id', '=', $idlangstable],
            ['langstable_type', '=', $typelanstable],
            ['id_lang', '=', $id_lang],
        ])->first();
    }

    public function updateDatas($typelanstable, $idlangstable, $id_lang, $array)
    {

        $countlangs = $this->getLangsCount();

        $langsIds = $this->getLangsIds();

        for ($i = 0; $i < $countlangs; $i++) {
            $datas = $typelanstable::find($idlangstable);

            $array = $this->preparedatas($array, $id_lang);

            LangFields::where([
                ['langstable_id', '=', $idlangstable],
                ['langstable_type', '=', $typelanstable],
                ['id_lang', '=', $id_lang]])
                ->update($array);

        }

    }

    public function deleteDatas($typelanstable, $idlangstable)
    {

        LangFields::where([
            ['langstable_type', '=', $typelanstable],
            ['langstable_id', '=', $idlangstable]])
            ->delete();

    }

    public function preparedatas($array, $id_lang)
    {
        foreach ($array as $clave => $valor) {

            "{$clave} => {$valor} ";

        }

        if (isset($array['uri'])) {
            $array['uri'] = CustomHelper::cleanuri($array['uri']);

        }

        if (isset($array['html_block'])) {

            $array['html_block'] = html_entity_decode($array['html_block']);

        }

        if (isset($array['description'])) {

            $array['description'] = html_entity_decode($array['description']);

        }

        if (isset($array['delivery_time'])) {

            $array['otherfields'] = $array['delivery_time'];

            unset($array['delivery_time']);

        }

        $array['id_lang'] = $id_lang;

        return $array;
    }

}
