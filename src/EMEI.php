<?php

declare(strict_types=1);

namespace Structures\Utilities;

use Exception;

/**
 * Class IMEI
 */
class IMEI {

	/**
	 * Generates IMEI code valid and random
	 * Generates 14 aleatory digits. These 14, multiplies the multiples of 2 by 2 and sum the result
	 * The result Must be divisible by 10,
	 * Then get the difference and generates the last digit
	 *
	 * @return string
	 */
	public static function generateRandom(): string {

		try {
			$code = IMEI::intRandom( 14 );
		}
		catch( Exception $e ) {
			die( $e );
		}
		$position = 0;
		$total = 0;
		while( $position < 14 ) {
			if( $position % 2 == 0 ) {
				$prod = 1;
			}
			else {
				$prod = 2;
			}
			$actualNum = $prod * $code[$position];
			if( $actualNum > 9 ) {
				$strNum = strval( $actualNum );
				$total += $strNum[0] + $strNum[1];
			}
			else {
				$total += $actualNum;
			}
			$position++;
		}
		$last = 10 - ($total % 10);
		if( $last == 10 )
			$IMEI = $code . 0;
		else
			$IMEI = $code . $last;

		return $IMEI;
	}

	/**
	 * @param int $size
	 *
	 * @return string
	 * @throws Exception
	 */
	private static function intRandom( $size ): string {

		$validCharacters = utf8_decode( "0123456789" );
		$validCharNumber = strlen( $validCharacters );
		$int = '';
		while( strlen( $int ) < $size ) {
			$index = random_int( 0, $validCharNumber - 1 );
			$int .= $validCharacters[$index];
		}
		return $int;
	}

}