<?php

if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "CSBAdmission" );
	session_start();
}

abstract class CSRF {
	/**
	 * When to timeout in minutes
	 *
	 * @var number
	 */
	const timeout = 5;

	/**
	 * Prefix for the session token name
	 *
	 * @var string
	 */
	const token_name = 'token';

	/**
	 * Prefix for session name containing the generated time of a token instance
	 *
	 * @var string
	 */
	const token_generated_time_name = 'token_at';

	/**
	 * Creates a unique CSRF instance
	 *
	 * @param number  $id
	 * @return CSRF_Token
	 */
	public static function make( $id ) {
		$token = new CSRF_Token( $id, self::timeout, self::token_name, self::token_generated_time_name );

		$_SESSION['csrf_token_'.$id] = $token;

		return $token;
	}

	/**
	 * Returns a unique CSRF instance based on the make id
	 *
	 * @param number  $id
	 * @return CSRF_Token
	 */
	public static function get( $id ) {
		if ( isset( $_SESSION['csrf_token_'.$id] ) )
			return $_SESSION['csrf_token_'.$id];
	}

	/**
	 * Returns a unique CSRF instance based on make id
	 *
	 * @param number  $id
	 * @return CSRF_Token
	 */
	public static function check( $id ) {
		$csrf_token = self::get( $id );

		if ( $csrf_token )
			return $csrf_token->check();

		return;
	}
}
?>
