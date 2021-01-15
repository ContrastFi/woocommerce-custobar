<?php

namespace WooCommerceCustobar\DataSource;

use WooCommerceCustobar\DataType\Utilities;

defined( 'ABSPATH' ) or exit;

class Customer extends AbstractDataSource {

	const ID             = 'id';
	const FIRST_NAME     = 'first_name';
	const LAST_NAME      = 'last_name';
	const EMAIL          = 'email';
	const PHONE          = 'phone';
	const COMPANY        = 'company';
	const STREET_ADDRESS = 'street_address';
	const CITY           = 'city';
	const ZIP_CODE       = 'postcode';
	const STATE          = 'state';
	const COUNTRY        = 'country';
	const DATE_JOINED    = 'date_joined';
	const CAN_SMS        = 'can_sms';
	const CAN_EMAIL      = 'can_email';

	public static $sourceKey = 'customer';

	/**
	 * Maps the customer properties found in the WC_Customer object to match
	 * the ones used in Custobar.
	 *
	 * @param \WC_Customer $order
	 */
	public function __construct( $customer ) {
		parent::__construct();

		$this->customer = $customer;
	}

	public function getId() {
		return (string) $this->customer->get_id();
	}

	public function getFirstName() {
		return $this->customer->get_first_name();
	}

	public function getLastName() {
		return $this->customer->get_last_name();
	}

	public function getEmail() {
		return $this->customer->get_email();
	}

	public function getPhone() {
		return $this->customer->get_billing_phone();
	}

	public function getCompany() {
		return $this->customer->get_billing_company();
	}

	public function getCity() {
		return $this->customer->get_billing_city();
	}

	public function getPostcode() {
		return $this->customer->get_billing_postcode();
	}

	public function getState() {
		return $this->customer->get_billing_state();
	}

	public function getCountry() {
		return $this->customer->get_billing_country();
	}

	public function getCanEmail() {
		$can_email = get_post_meta( $this->customer->get_id(), '_woocommerce_custobar_can_email', true );
		if ( $can_email ) {
			return true;
		}

		// Never return false as it would override the current value in
		// Custobar. We don't offer functionality to remove the permission.
		return null;
	}

	public function getCanSms() {
		$can_sms = get_post_meta( $this->customer->get_id(), '_woocommerce_custobar_can_sms', true );
		if ( $can_sms ) {
			return true;
		}

		// Never return false as it would override the current value in
		// Custobar. We don't offer functionality to remove the permission.
		return null;
	}

	public function getStreetAddress() {
		$address = $this->customer->get_billing_address_1();
		if ( $billing_address_2 = $this->customer->get_billing_address_2() ) {
			$address .= '\n' . $billing_address_2;
		}
		return $address;
	}

	public function getDateJoined() {
		if ( isset( $this->created_at ) ) {
			$created_at = new \DateTime( $this->created_at );
			return Utilities::formatDateTime( $created_at );
		} else {
			return null;
		}
	}
}