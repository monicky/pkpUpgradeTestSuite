<?php

/**
 * @defgroup donations
 */
 
/**
 * @file DonationsHandler.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class DonationsHandler
 * @ingroup donations
 *
 * @brief Display a form for accepting donations
 *
 */

// $Id: DonationsHandler.inc.php,v 1.11 2009/05/13 00:14:46 asmecher Exp $


import('handler.Handler');

class DonationsHandler extends Handler {
	/**
	 * Constructor
	 **/
	function DonationsHandler() {
		parent::Handler();
	}
	function index( $args ) {
		import('payment.ojs.OJSPaymentManager');
		$paymentManager =& OJSPaymentManager::getManager();
		$journal =& Request::getJournal();

		if (!Validation::isLoggedIn()) {
			Validation::redirectLogin("payment.loginRequired.forDonation");
		}

		$user =& Request::getUser();

		$queuedPayment =& $paymentManager->createQueuedPayment($journal->getJournalId(), PAYMENT_TYPE_DONATION, $user->getId(), 0, 0);
		$queuedPaymentId = $paymentManager->queuePayment($queuedPayment);
	
		$paymentManager->displayPaymentForm($queuedPaymentId, $queuedPayment);		
	}	
	
	function thankYou( $args ) {
		$templateMgr =& TemplateManager::getManager();
		$this->setupTemplate();
		$journal =& Request::getJournal();
		
		$templateMgr->assign(array(
			'currentUrl' => Request::url(null, null, 'donations'),
			'pageTitle' => 'donations.thankYou',
			'journalName' => $journal->getLocalizedTitle(),
			'message' => 'donations.thankYouMessage'
		));
		$templateMgr->display('common/message.tpl');
	}
}

?>
