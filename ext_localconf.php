<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Tamtec.' . $_EXTKEY,
	'Wishlist',
	array(
		'Wish' => 'list, register',
		
	),
	// non-cacheable actions
	array(
		'Wish' => 'list, register',
		
	)
);
