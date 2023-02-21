<?php

namespace Francerz\MX_RFC;

use DateTimeImmutable;

class RFC
{
    public const PATTERN_REGEXP = '/^[A-Z]{4}[0-9]{6}[\\d\\w]{2}[\\dA]$/';

    private const INCONVENIENTES = [
        'BUEI', 'BUEY', 'CACA', 'CACO', 'CAGA', 'CAGO', 'CAKA', 'COGE', 'COJA',
        'COJE', 'COJI', 'COJO', 'CULO', 'FETO', 'GUEY', 'JOTO', 'KACA', 'KACO',
        'KAGA', 'KAGO', 'KAKA', 'KAGO', 'KOGE', 'KOJO', 'KULO', 'MAME', 'MAMO',
        'MEAR', 'MEON', 'MION', 'MULA', 'PEDA', 'PEDO', 'PENE', 'PUTA', 'PUTO',
        'QULO', 'RATA', 'RUIN'
    ];

    private const IGNORAR_REGEXP = '/\\b(DAS|DEL|DER|DE|DIE|DI|DD|LAS|LA|LOS|EL|LES|LE|MAC|MC|VAN|VON|Y)\\s+/';
    private const CHAR_CHECK_VALUES = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ";
    private const CHAR_CHECK_CODE = "123456789ABCDEFGHIJKLMNPQRSTUVWXYZ";

    private const CHAR_VALUES = '0123456789&ABCDEFGHIJKLMNOPQRSTUVWXYZ^';

    private $rfc;

    /**
     * @param string $rfc
     */
    public function __construct($rfc)
    {
        $this->rfc = $rfc;
    }

    private static function quitarAcentos($string)
    {
        return strtr($string, [
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
            'À' => 'A', 'È' => 'E', 'Ì' => 'I', 'Ò' => 'O', 'Ù' => 'U',
            'Ü' => 'U',
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'à' => 'a', 'è' => 'e', 'ì' => 'i', 'ò' => 'o', 'ù' => 'u',
            'ü' => 'u'
        ]);
    }

    public static function getCharValue($char)
    {
        if ($char === ' ') {
            return '00';
        }
        if ($char === 'Ñ') {
            return '40';
        }
        $charPos = strpos(self::CHAR_VALUES, $char);
        if ($charPos >= 29) {
            $charPos += 3;
        } elseif ($charPos >= 20) {
            $charPos += 1;
        }
        return str_pad($charPos, 2, '0', STR_PAD_LEFT);
    }

    public static function getCharCheckCode($number)
    {
        return substr(self::CHAR_CHECK_CODE, $number, 1);
    }

    public static function getCharCheckValue($char)
    {
        return strpos(self::CHAR_CHECK_VALUES, $char);
    }

    public static function generaLastChar($rfc)
    {
        $j = 13;
        $suma = 0;
        $prerfc = substr($rfc, 0, 12);
        for ($i = 0; $i < 12; $i++) {
            $suma += (static::getCharCheckValue(substr($prerfc, $i, 1)) * ($j - $i));
        }
        $residuo = 11 - $suma % 11;

        if ($residuo == 11) {
            return '0';
        }
        if ($residuo == 10) {
            return 'A';
        }

        return "{$residuo}";
    }

    public static function hasPalabraInconveniente($rfc)
    {
        $prerfc = substr($rfc, 0, 4);
        return in_array($prerfc, static::INCONVENIENTES);
    }

    /**
     * @return bool
     */
    public function esValido()
    {
        $match = preg_match(static::PATTERN_REGEXP, $this->rfc);
        if ($match === false) {
            return false;
        }

        if (static::hasPalabraInconveniente($this->rfc)) {
            return false;
        }

        $lastChar = static::generaLastChar($this->rfc);
        $realLastChar = substr($this->rfc, -1);
        if ($realLastChar !== $lastChar) {
            return false;
        }
        return true;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getFechaNacimiento()
    {
        $year = substr($this->rfc, 4, 2);
        $month = substr($this->rfc, 6, 2);
        $day = substr($this->rfc, 8, 2);

        return new DateTimeImmutable("19{$year}-{$month}-{$day}");
    }

    private static function normalizar($string)
    {
        $string = static::quitarAcentos($string);
        $string = mb_strtoupper($string);
        $string = str_replace('Ñ', '^', $string);
        $string = preg_replace(self::IGNORAR_REGEXP, '', $string);
        $string = preg_replace('/\s+/', ' ', $string);
        return $string;
    }

    /**
     * @param string $nombre
     * @return int
     */
    private static function calcularSumaNombre($nombre)
    {
        $suma = 0;
        $calc = '0';
        $size = strlen($nombre);
        if ($size > 0) {
            for ($i = 0; $i < $size; $i++) {
                $calc .= static::getCharValue(substr($nombre, $i, 1));
            }
            $size = strlen($calc);
            $prevChar = substr($calc, 0, 1);
            for ($i = 1; $i < $size; $i++) {
                $char = substr($calc, $i, 1);
                $suma += ($prevChar . $char) * $char;
                $prevChar = $char;
            }
        }
        return $suma;
    }

    private static function calcularHomonimia($nombre, $apellido1, $apellido2)
    {
        $suma = self::calcularSumaNombre($apellido1);
        $suma += self::calcularSumaNombre($apellido2);
        $suma += self::calcularSumaNombre($nombre);
        $residuo = $suma % 1000;

        $chars = static::getCharCheckCode(floor($residuo / 34));
        $chars .= static::getCharCheckCode($residuo % 34);

        return $chars;
    }

    /**
     * @param string $nombre
     * @param string $apellido1
     * @param string $apellido2
     * @return bool
     */
    public function esNombreValido($nombre, $apellido1, $apellido2)
    {
        $realHomonimia = substr($this->rfc, 10, 2);

        $normNombre = static::normalizar($nombre);
        $normApellido1 = static::normalizar($apellido1);
        $normApellido2 = static::normalizar($apellido2);
        $calcHomonimia = static::calcularHomonimia($normNombre, $normApellido1, $normApellido2);

        return $realHomonimia == $calcHomonimia;
    }

    public function __toString()
    {
        return $this->rfc;
    }
}
