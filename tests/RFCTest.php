<?php

namespace Francerz\MX_RFC\Tests;

use DateTimeImmutable;
use Francerz\MX_RFC\RFC;
use PHPUnit\Framework\TestCase;

class RFCTest extends TestCase
{
    public function testGetCharCheckValue()
    {
        $this->assertEquals(0, RFC::getCharCheckValue('0'));
        $this->assertEquals(1, RFC::getCharCheckValue('1'));
        $this->assertEquals(2, RFC::getCharCheckValue('2'));
        $this->assertEquals(3, RFC::getCharCheckValue('3'));
        $this->assertEquals(4, RFC::getCharCheckValue('4'));
        $this->assertEquals(5, RFC::getCharCheckValue('5'));
        $this->assertEquals(6, RFC::getCharCheckValue('6'));
        $this->assertEquals(7, RFC::getCharCheckValue('7'));
        $this->assertEquals(8, RFC::getCharCheckValue('8'));
        $this->assertEquals(9, RFC::getCharCheckValue('9'));
        $this->assertEquals(10, RFC::getCharCheckValue('A'));
        $this->assertEquals(11, RFC::getCharCheckValue('B'));
        $this->assertEquals(12, RFC::getCharCheckValue('C'));
        $this->assertEquals(13, RFC::getCharCheckValue('D'));
        $this->assertEquals(14, RFC::getCharCheckValue('E'));
        $this->assertEquals(15, RFC::getCharCheckValue('F'));
        $this->assertEquals(16, RFC::getCharCheckValue('G'));
        $this->assertEquals(17, RFC::getCharCheckValue('H'));
        $this->assertEquals(18, RFC::getCharCheckValue('I'));
        $this->assertEquals(19, RFC::getCharCheckValue('J'));
        $this->assertEquals(20, RFC::getCharCheckValue('K'));
        $this->assertEquals(21, RFC::getCharCheckValue('L'));
        $this->assertEquals(22, RFC::getCharCheckValue('M'));
        $this->assertEquals(23, RFC::getCharCheckValue('N'));
        $this->assertEquals(24, RFC::getCharCheckValue('&'));
        $this->assertEquals(25, RFC::getCharCheckValue('O'));
        $this->assertEquals(26, RFC::getCharCheckValue('P'));
        $this->assertEquals(27, RFC::getCharCheckValue('Q'));
        $this->assertEquals(28, RFC::getCharCheckValue('R'));
        $this->assertEquals(29, RFC::getCharCheckValue('S'));
        $this->assertEquals(30, RFC::getCharCheckValue('T'));
        $this->assertEquals(31, RFC::getCharCheckValue('U'));
        $this->assertEquals(32, RFC::getCharCheckValue('V'));
        $this->assertEquals(33, RFC::getCharCheckValue('W'));
        $this->assertEquals(34, RFC::getCharCheckValue('X'));
        $this->assertEquals(35, RFC::getCharCheckValue('Y'));
        $this->assertEquals(36, RFC::getCharCheckValue('Z'));
        $this->assertEquals(37, RFC::getCharCheckValue(' '));
        $this->assertEquals(38, RFC::getCharCheckValue('Ñ'));
    }

    public function testGetCharCheckCode()
    {
        $this->assertEquals('1', RFC::getCharCheckCode(0));
        $this->assertEquals('2', RFC::getCharCheckCode(1));
        $this->assertEquals('3', RFC::getCharCheckCode(2));
        $this->assertEquals('4', RFC::getCharCheckCode(3));
        $this->assertEquals('5', RFC::getCharCheckCode(4));
        $this->assertEquals('6', RFC::getCharCheckCode(5));
        $this->assertEquals('7', RFC::getCharCheckCode(6));
        $this->assertEquals('8', RFC::getCharCheckCode(7));
        $this->assertEquals('9', RFC::getCharCheckCode(8));
        $this->assertEquals('A', RFC::getCharCheckCode(9));
        $this->assertEquals('B', RFC::getCharCheckCode(10));
        $this->assertEquals('C', RFC::getCharCheckCode(11));
        $this->assertEquals('D', RFC::getCharCheckCode(12));
        $this->assertEquals('E', RFC::getCharCheckCode(13));
        $this->assertEquals('F', RFC::getCharCheckCode(14));
        $this->assertEquals('G', RFC::getCharCheckCode(15));
        $this->assertEquals('H', RFC::getCharCheckCode(16));
        $this->assertEquals('I', RFC::getCharCheckCode(17));
        $this->assertEquals('J', RFC::getCharCheckCode(18));
        $this->assertEquals('K', RFC::getCharCheckCode(19));
        $this->assertEquals('L', RFC::getCharCheckCode(20));
        $this->assertEquals('M', RFC::getCharCheckCode(21));
        $this->assertEquals('N', RFC::getCharCheckCode(22));
        $this->assertEquals('P', RFC::getCharCheckCode(23));
        $this->assertEquals('Q', RFC::getCharCheckCode(24));
        $this->assertEquals('R', RFC::getCharCheckCode(25));
        $this->assertEquals('S', RFC::getCharCheckCode(26));
        $this->assertEquals('T', RFC::getCharCheckCode(27));
        $this->assertEquals('U', RFC::getCharCheckCode(28));
        $this->assertEquals('V', RFC::getCharCheckCode(29));
        $this->assertEquals('W', RFC::getCharCheckCode(30));
        $this->assertEquals('X', RFC::getCharCheckCode(31));
        $this->assertEquals('Y', RFC::getCharCheckCode(32));
        $this->assertEquals('Z', RFC::getCharCheckCode(33));
    }

    public function testGetCharValue()
    {
        $this->assertEquals('00', RFC::getCharValue(' '));
        $this->assertEquals('00', RFC::getCharValue('0'));
        $this->assertEquals('01', RFC::getCharValue('1'));
        $this->assertEquals('02', RFC::getCharValue('2'));
        $this->assertEquals('03', RFC::getCharValue('3'));
        $this->assertEquals('04', RFC::getCharValue('4'));
        $this->assertEquals('05', RFC::getCharValue('5'));
        $this->assertEquals('06', RFC::getCharValue('6'));
        $this->assertEquals('07', RFC::getCharValue('7'));
        $this->assertEquals('08', RFC::getCharValue('8'));
        $this->assertEquals('09', RFC::getCharValue('9'));
        $this->assertEquals('10', RFC::getCharValue('&'));
        $this->assertEquals('11', RFC::getCharValue('A'));
        $this->assertEquals('12', RFC::getCharValue('B'));
        $this->assertEquals('13', RFC::getCharValue('C'));
        $this->assertEquals('14', RFC::getCharValue('D'));
        $this->assertEquals('15', RFC::getCharValue('E'));
        $this->assertEquals('16', RFC::getCharValue('F'));
        $this->assertEquals('17', RFC::getCharValue('G'));
        $this->assertEquals('18', RFC::getCharValue('H'));
        $this->assertEquals('19', RFC::getCharValue('I'));
        $this->assertEquals('21', RFC::getCharValue('J'));
        $this->assertEquals('22', RFC::getCharValue('K'));
        $this->assertEquals('23', RFC::getCharValue('L'));
        $this->assertEquals('24', RFC::getCharValue('M'));
        $this->assertEquals('25', RFC::getCharValue('N'));
        $this->assertEquals('26', RFC::getCharValue('O'));
        $this->assertEquals('27', RFC::getCharValue('P'));
        $this->assertEquals('28', RFC::getCharValue('Q'));
        $this->assertEquals('29', RFC::getCharValue('R'));
        $this->assertEquals('32', RFC::getCharValue('S'));
        $this->assertEquals('33', RFC::getCharValue('T'));
        $this->assertEquals('34', RFC::getCharValue('U'));
        $this->assertEquals('35', RFC::getCharValue('V'));
        $this->assertEquals('36', RFC::getCharValue('W'));
        $this->assertEquals('37', RFC::getCharValue('X'));
        $this->assertEquals('38', RFC::getCharValue('Y'));
        $this->assertEquals('39', RFC::getCharValue('Z'));
        $this->assertEquals('40', RFC::getCharValue('Ñ'));
    }

    public function testEsValido()
    {
        $rfc = new RFC('GODE561231GR8');
        $this->assertTrue($rfc->esValido());
        $this->assertTrue($rfc->esNombreValido('Emma', 'Gómez', 'Díaz'));
        $this->assertEquals(
            new DateTimeImmutable('1956-12-31'),
            $rfc->getFechaNacimiento()
        );

        $rfc = new RFC('BAFJ701213SBA');
        $this->assertTrue($rfc->esValido());
        $this->assertTrue($rfc->esNombreValido('Juan', 'Barrios', 'Fernández'));
        $this->assertEquals(
            new DateTimeImmutable('1970-12-13'),
            $rfc->getFechaNacimiento()
        );

        $rfc = new RFC('IIME691117CS2');
        $this->assertTrue($rfc->esValido());
        $this->assertTrue($rfc->esNombreValido('Eva', 'Iriarte', 'Méndez'));
        $this->assertEquals(
            new DateTimeImmutable('1969-11-17'),
            $rfc->getFechaNacimiento()
        );

        $rfc = new RFC('CAGM2406181Y1');
        $this->assertTrue($rfc->esValido());
        $this->assertTrue($rfc->esNombreValido('Manuel', 'Chávez', 'González'));
        $this->assertEquals(
            new DateTimeImmutable('1924-06-18'),
            $rfc->getFechaNacimiento()
        );

        $rfc = new RFC('CALF450228LK1');
        $this->assertTrue($rfc->esValido());
        $this->assertTrue($rfc->esNombreValido('Felipe', 'Camargo', 'Llamas'));
        $this->assertEquals(
            new DateTimeImmutable('1945-02-28'),
            $rfc->getFechaNacimiento()
        );

        $rfc = new RFC('KETC511012KR0');
        $this->assertTrue($rfc->esValido());
        $this->assertTrue($rfc->esNombreValido('Charles', 'Kennedy', 'Truman'));
        $this->assertEquals(
            new DateTimeImmutable('1951-10-12'),
            $rfc->getFechaNacimiento()
        );

        $rfc = new RFC('OLAL401201HS2');
        $this->assertTrue($rfc->esValido());
        $this->assertTrue($rfc->esNombreValido('Álvaro', 'de la O', 'Lozano'));
        $this->assertEquals(
            new DateTimeImmutable('1940-12-01'),
            $rfc->getFechaNacimiento()
        );

        $rfc = new RFC('ERER0711209E3');
        $this->assertTrue($rfc->esValido());
        $this->assertTrue($rfc->esNombreValido('Ernesto', 'Ek', 'Rivera'));
        $this->assertEquals(
            new DateTimeImmutable('1907-11-20'),
            $rfc->getFechaNacimiento()
        );

        $rfc = new RFC('SADD1808121G7');
        $this->assertTrue($rfc->esNombreValido('Dolores', 'San Martín', 'Dávalos'));
        $this->assertTrue($rfc->esValido());
        $this->assertEquals(
            new DateTimeImmutable('1918-08-12'),
            $rfc->getFechaNacimiento()
        );

        $rfc = new RFC('SAGM190224752');
        $this->assertTrue($rfc->esNombreValido('Mario', 'Sánchez de la Barquera', 'Gómez'));
        $this->assertTrue($rfc->esValido());
        $this->assertEquals(
            new DateTimeImmutable('1919-02-24'),
            $rfc->getFechaNacimiento()
        );

        $rfc = new RFC('JIPA170808H19');
        $this->assertTrue($rfc->esNombreValido('Antonio', 'Jiménez', 'Ponce de León'));
        $this->assertTrue($rfc->esValido());
        $this->assertEquals(
            new DateTimeImmutable('1917-08-08'),
            $rfc->getFechaNacimiento()
        );
    }
}
