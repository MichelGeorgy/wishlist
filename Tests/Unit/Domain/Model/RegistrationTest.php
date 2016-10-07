<?php

namespace Tamtec\Wishlist\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Michel Georgy <mgeorgy@tamtec.ch>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \Tamtec\Wishlist\Domain\Model\Registration.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Michel Georgy <mgeorgy@tamtec.ch>
 */
class RegistrationTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Tamtec\Wishlist\Domain\Model\Registration
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Tamtec\Wishlist\Domain\Model\Registration();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFirstnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFirstname()
		);
	}

	/**
	 * @test
	 */
	public function setFirstnameForStringSetsFirstname() {
		$this->subject->setFirstname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLastname()
		);
	}

	/**
	 * @test
	 */
	public function setLastnameForStringSetsLastname() {
		$this->subject->setLastname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() {
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAmountReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getAmount()
		);
	}

	/**
	 * @test
	 */
	public function setAmountForIntegerSetsAmount() {
		$this->subject->setAmount(12);

		$this->assertAttributeEquals(
			12,
			'amount',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGiftReturnsInitialValueForWish() {
		$this->assertEquals(
			NULL,
			$this->subject->getWish()
		);
	}

	/**
	 * @test
	 */
	public function setGiftForWishSetsGift() {
		$giftFixture = new \Tamtec\Wishlist\Domain\Model\Wish();
		$this->subject->setWish($giftFixture);

		$this->assertAttributeEquals(
			$giftFixture,
			'gift',
			$this->subject
		);
	}
}
