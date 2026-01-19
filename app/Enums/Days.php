<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Days extends Enum
{
    const Monday    = 1 << 0;
	const Tuesday   = 1 << 1;
	const Wednesday = 1 << 2;
	const Thursday  = 1 << 3;
	const Friday    = 1 << 4;
	const Saturday  = 1 << 5;
	const Sunday    = 1 << 6;
  
	// Shortcuts
	const Weekdays = self::Monday | self::Tuesday | self::Wednesday | self::Thursday | self::Friday;
	const Weekend = self::Saturday | self::Sunday;
}
