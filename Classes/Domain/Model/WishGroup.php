<?php
namespace Tamtec\Wishlist\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Michel Georgy <mgeorgy@tamtec.ch>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Wish
 */
class WishGroup extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * registrationRepository
	 *
	 * @var \Tamtec\Wishlist\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository = NULL;

	/**
	 * wishRepository
	 *
	 * @var \Tamtec\Wishlist\Domain\Repository\WishRepository
	 * @inject
	 */
	protected $wishRepository = NULL;

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * subtitle
	 *
	 * @var string
	 */
	protected $subtitle = '';

	/**
	 * image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $image = NULL;

	/**
	 *
	 * @lazy
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tamtec\Wishlist\Domain\Model\Wish>
	 */
	protected $wishes;

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the subtitle
	 *
	 * @return string $subtitle
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * Sets the subtitle
	 *
	 * @param string $subtitle
	 * @return void
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->image = $image;
	}

	/**
	 *
	 * @param \Tamtec\Wishlist\Domain\Model\Wish $wish
	 */
	public function addWish($wish) {
		$this->wishes->attach($wish);
	}

	/**
	 *
	 * @param \Tamtec\Wishlist\Domain\Model\Wish $wishToRemove
	 */
	public function removeWish($wishToRemove) {
		$this->wishes->detach($wishToRemove);
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tamtec\Wishlist\Domain\Model\Wish>
	 */
	public function getWishes()
	{
		return $this->wishes;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tamtec\Wishlist\Domain\Model\Wish>
	 */
	public function getWishesSorted(){
		return $this->wishRepository->findByWishgroup($this->getUid());
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tamtec\Wishlist\Domain\Model\Wish> $wishes
	 */
	public function setWishes($wishes)
	{
		$this->wishes = $wishes;
	}

	/**
	 * @return bool
	 */
	public function getIsGifted(){
		$allGifted = true;
		foreach ($this->wishes as $wish) {
			$allGifted = $allGifted && $wish->getIsGifted();
		}
		return $allGifted;
	}
}