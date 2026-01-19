<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Months extends Enum
{
    const January   = 1;
    const February  = 2;
    const March     = 3;
    const April     = 4;
    const May       = 5;
    const June      = 6;
    const July      = 7;
    const August    = 8;
    const September = 9;
    const October   = 10;
    const November  = 11;
    const December  = 12;
}
