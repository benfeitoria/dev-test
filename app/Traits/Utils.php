<?php

namespace App\Traits;

use Carbon\Carbon;

trait Utils
{
    /**
     * @param $variavel
     * @return string|string[]|null
     */
    public function limpa_tags($variavel)
    {
        return preg_replace('(<(/?[^\>]+)>)', '', $variavel);
    }

    /**
     * @param $value
     * @param string $formato
     * @return string
     */
    public function formata_data_hora($value, $formato = 'd/m/Y H:i:s'): string
    {
        if ($value) {
            return Carbon::parse($value)->format($formato);
        } else {
            return '';
        }
    }

    /**
     * @param $value
     * @param string $formato
     * @return string
     */
    public function formata_data($value, $formato = 'd/m/Y'): string
    {
        if ($value) {
            return Carbon::parse($value)->format($formato);
        } else {
            return '';
        }
    }
}
