<?php namespace thiagoalessio\TesseractOCR\Tests\Unit;

use thiagoalessio\TesseractOCR\Tests\Common\TestCase;
use thiagoalessio\TesseractOCR\Option;

class OptionTest extends TestCase
{
	public function testPsm()
	{
		$psm = Option::psm(8);
		$this->assertEquals('-psm 8', $psm('3.05.01'));
		$this->assertEquals('--psm 8', $psm('4.0.0-beta.1'));
	}

	public function testOem()
	{
		$oem = Option::oem(2);
		$this->assertEquals('--oem 2', $oem('3.05.01'));
		try {
			$oem('3.04.01');
		} catch (\Exception $e) {
			$expected = 'oem option is only available on Tesseract 3.05 or later.';
			$expected.= PHP_EOL."Your version of Tesseract is 3.04.01";
			$this->assertEquals($expected, $e->getMessage());
		}
	}
}
