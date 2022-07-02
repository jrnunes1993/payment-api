<?php

namespace App\Helpers;

class CountryStates
{

    /**
     * Returns a Posta from a given State name.
     *
     * @param  string $value
     * @return string
     */
    public static function NameToPostal($name)
    {
        $postals = array(
            'Acre'                => 'AC',
            'Alagoas'             => 'AL',
            'Amapá'               => 'AP',
            'Amazonas'            => 'AM',
            'Bahia'               => 'BA',
            'Ceará'               => 'CE',
            'Distrito Federal'    => 'DF',
            'Espírito Santo'      => 'ES',
            'Goiás'               => 'GO',
            'Maranhão'            => 'MA',
            'Mato Grosso'         => 'MT',
            'Mato Grosso do Sul'  => 'MS',
            'Minas Gerais'        => 'MG',
            'Pará'                => 'PA',
            'Paraíba'             => 'PB',
            'Paraná'              => 'PR',
            'Pernambuco'          => 'PE',
            'Piauí'               => 'PI',
            'Rio de Janeiro'      => 'RJ',
            'Rio Grande do Norte' => 'RN',
            'Rio Grande do Sul'   => 'RS',
            'Rondônia'            => 'RO',
            'Roraima'             => 'RR',
            'Santa Catarina'      => 'SC',
            'São Paulo'           => 'SP',
            'Sergipe'             => 'SE',
            'Tocantins'           => 'TO'
        );

        return $postals[$name];
    }

    /**
     * Returns a State from a given Postal.
     *
     * @param  string $value
     * @return string
     */
    public static function PostalToName($postal)
    {
        $states = array(
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        );

        return $states[$postal];
    }

    public static function getStates()
    {
        return array(
            'Acre',
            'Alagoas',
            'Amapá',
            'Amazonas',
            'Bahia',
            'Ceará',
            'Distrito Federal',
            'Espírito Santo',
            'Goiás',
            'Maranhão',
            'Mato Grosso',
            'Mato Grosso do Sul',
            'Minas Gerais',
            'Pará',
            'Paraíba',
            'Paraná',
            'Pernambuco',
            'Piauí',
            'Rio de Janeiro',
            'Rio Grande do Norte',
            'Rio Grande do Sul',
            'Rondônia',
            'Roraima',
            'Santa Catarina',
            'São Paulo',
            'Sergipe',
            'Tocantins'
        );
    }

    public static function getPostals()
    {
        return array(
            'AC',
            'AL',
            'AP',
            'AM',
            'BA',
            'CE',
            'DF',
            'ES',
            'GO',
            'MA',
            'MT',
            'MS',
            'MG',
            'PA',
            'PB',
            'PR',
            'PE',
            'PI',
            'RJ',
            'RN',
            'RS',
            'RO',
            'RR',
            'SC',
            'SP',
            'SE',
            'TO'
        );
    }
}
