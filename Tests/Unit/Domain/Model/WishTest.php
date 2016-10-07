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
 * Test case for class \Tamtec\Wishlist\Domain\Model\Wish.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Michel Georgy <mgeorgy@tamtec.ch>
 */
class WishTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Tamtec\Wishlist\Domain\Model\Wish
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Tamtec\Wishlist\Domain\Model\Wish();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSubtitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSubtitle()
		);
	}

	/**
	 * @test
	 */
	public function setSubtitleForStringSetsSubtitle() {
		$this->subject->setSubtitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'subtitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPriceReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getPrice()
		);
	}

	/**
	 * @test
	 */
	public function setPriceForIntegerSetsPrice() {
		$this->subject->setPrice(12);

		$this->assertAttributeEquals(
			12,
			'price',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIsMultipleReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getIsMultiple()
		);
	}

	/**
	 * @test
	 */
	public function setIsMultipleForBooleanSetsIsMultiple() {
		$this->subject->setIsMultiple(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'isMultiple',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIsSharedReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getIsShared()
		);
	}

	/**
	 * @test
	 */
	public function setIsSharedForBooleanSetsIsShared() {
		$this->subject->setIsShared(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'isShared',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getImage()
		);
	}

	/**
	 * @test
	 */
	public function setImageForFileReferenceSetsImage() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'image',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIsGiftedReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getIsGifted()
		);
	}

	/**
	 * @test
	 */
	public function setIsGiftedForBooleanSetsIsGifted() {
		$this->subject->setIsGifted(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'isGifted',
			$this->subject
		);
	}
}
