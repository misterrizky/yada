<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class LogLevel extends Enum
{
    const Emergency = 0;
    const Alert = 1;
    const Critical = 2;
    const Error = 3;
    const Warning = 4;
    const Notice = 5;
    const Info = 6;
    const Debug = 7;
}
