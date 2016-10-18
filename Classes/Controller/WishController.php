<?php
namespace Tamtec\Wishlist\Controller;


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


use \Tamtec\Wishlist\Domain\Model\Registration;
use \X4e\X4ebase\Utility\EmailUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * WishController
 */
class WishController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * wishRepository
	 *
	 * @var \Tamtec\Wishlist\Domain\Repository\WishGroupRepository
	 * @inject
	 */
	protected $wishGroupRepository = NULL;

	/**
	 * wishRepository
	 *
	 * @var \Tamtec\Wishlist\Domain\Repository\WishRepository
	 * @inject
	 */
	protected $wishRepository = NULL;

	/**
	 * registrationRepository
	 *
	 * @var \Tamtec\Wishlist\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$wishes = $this->wishRepository->findAll();

		$this->view->assign('wishes', $wishes);
	}

	/**
	 * action register
	 *
	 * @param \Tamtec\Wishlist\Domain\Model\Registration $registration
	 * @return void
	 */
	public function registerAction($registration) {
		$status = "error";
		$message = "Ein unbekannter Fehler ist aufgetreten";

		$this->registrationRepository->add($registration);

		$this->sendConfirmation($registration);
		$this->sendNotification($registration);

		$status = "success";
		$message = "Vielen Dank. Es wurde eine E-Mail mit den notwendigen Informationen an " . $registration->getEmail() .
			" versandt!";

		$this->view->assign('status', $status);
		$this->view->assign('message', $message);
	}

	/**
	 * @param $registration
	 * @return boolean
	 */
	public function sendNotification($registration){
		return $this->sendMail(
			array($this->settings['email']['notification']['recipient']),
			array(
				$this->settings['email']['notification']['sender']['email'] => $this->settings['email']['notification']['sender']['name']
			),
			$this->settings['email']['notification']['subject'],
			'Notification',
			array(
				'registration' => $registration
			)
		);
	}

	/**
	 * @param $registration
	 * @return boolean
	 */
	public function sendConfirmation($registration){
		return $this->sendMail(
			array($registration->getEmail()),
			array(
				$this->settings['email']['confirmation']['sender']['email'] => $this->settings['email']['confirmation']['sender']['name']
			),
			$this->settings['email']['confirmation']['subject'],
			'Confirmation',
			array(
				'registration' => $registration
			)
		);
	}

	/**
	 * @param $recipient
	 * @param $sender
	 * @param $subject
	 * @param $templateName
	 * @param array $arguments
	 */
	public function sendMail($recipient, $sender, $subject, $templateName, $arguments = array()){
		EmailUtility::sendTemplateEmail(
			$recipient,
			$sender,
			$subject,
			$templateName,
			ExtensionManagementUtility::extPath('wishlist') . 'Resources/Private/Templates/',
			ExtensionManagementUtility::extPath('wishlist') . 'Resources/Private/Layouts/',
			ExtensionManagementUtility::extPath('wishlist') . 'Resources/Private/Partials/',
			$arguments,
			'wishlist',
			'Wish/Email',
			true
		);
	}
}
