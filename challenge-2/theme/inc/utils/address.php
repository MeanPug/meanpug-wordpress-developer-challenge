<?php

function inf_format_address( $postal_code, $state, $city, $address1, $address2 = null ) {
    $formatted = $address1;
    if ($address2) {
        $formatted .= ', ' . $address2;
    }

    $formatted .= '<br />';

    $formatted .= sprintf('%s, %s %s', $city, $state, $postal_code);

    return $formatted;
}

function inf_format_local_address_html( $address ) {
	if ( ! $address || ! is_array( $address ) ) {
		return '';
	}

	return inf_format_address(
		$address['postal_code'] ?? '',
		$address['state'] ?? '',
		$address['city'] ?? '',
		$address['street'] ?? '',
		$address['street2'] ?? null
	);
}
