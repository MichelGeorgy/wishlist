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
class Wish extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * registrationRepository
	 *
	 * @var \Tamtec\Wishlist\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository = NULL;

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * price
	 *
	 * @var integer
	 */
	protected $price = 0;

	/**
	 * isMultiple
	 *
	 * @var boolean
	 */
	protected $isMultiple = FALSE;

	/**
	 * isShared
	 *
	 * @var boolean
	 */
	protected $isShared = FALSE;

	/**
	 * @var array
	 */
	protected $registrations = NULL;

	/**
	 * @var \Tamtec\Wishlist\Domain\Model\WishGroup
	 */
	protected $wishgroup;

	/**
	 * image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $image = NULL;

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
	 * Returns the price
	 *
	 * @return integer $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param integer $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Returns the isMultiple
	 *
	 * @return boolean $isMultiple
	 */
	public function getIsMultiple() {
		return $this->isMultiple;
	}

	/**
	 * Sets the isMultiple
	 *
	 * @param boolean $isMultiple
	 * @return void
	 */
	public function setIsMultiple($isMultiple) {
		$this->isMultiple = $isMultiple;
	}

	/**
	 * Returns the isShared
	 *
	 * @return boolean $isShared
	 */
	public function getIsShared() {
		return $this->isShared;
	}

	/**
	 * Sets the isShared
	 *
	 * @param boolean $isShared
	 * @return void
	 */
	public function setIsShared($isShared) {
		$this->isShared = $isShared;
	}

	/**
	 * Returns the isGifted
	 *
	 * @return boolean $isGifted
	 */
	public function getIsGifted() {
		if($this->getIsMultiple() || $this->price === 0){
			return false;
		}

		return $this->price <= $this->getAmountGifted();
	}

	/**
	 * @return int
	 */
	public function getOpenAmount(){
		return $this->price - $this->getAmountGifted();
	}

	public function getAmountGifted(){
		$registrations = $this->getRegistrations();
		$amountGifted = 0;
		if($registrations) {
			foreach ($registrations as $registration) {
				$amountGifted += intval($registration->getAmount());
			}
		}

		return $amountGifted;
	}

	public function getRegistrations(){
		if($this->registrations === NULL){
			$this->registrations = $this->registrationRepository->findByWish($this->getUid());
		}
		return $this->registrations;
	}

	/**
	 * @return \Tamtec\Wishlist\Domain\Model\WishGroup
	 */
	public function getWishgroup()
	{
		return $this->wishgroup;
	}

	/**
	 * @param \Tamtec\Wishlist\Domain\Model\WishGroup $wishGroup
	 */
	public function setWishgroup($wishgroup)
	{
		$this->wishgroup = $wishgroup;
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
}