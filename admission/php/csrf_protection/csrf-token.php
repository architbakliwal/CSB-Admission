<?php
	
	class CSRF_Token{
		
		private $id;

		/**
		 * When to timeout in minutes
		 * @var number
		 */
		private $timeout;

		/**
		 * Token name of the session / html form field
		 * @var string
		 */
		private $token_name;

		/**
		 * Token generated time name for the session
		 * @var string
		 */
		private $token_generated_time_name;

		/**
		 * @param number $id
		 * @param number $timeout
		 * @param string $token_name
		 * @param string $token_generated_time_name
		 */
		public function __construct($id, $timeout, $token_name, $token_generated_time_name){
			$this->id = $id;
			$this->timeout = $timeout;
			$this->token_name = $token_name;
			$this->token_generated_time_name = $token_generated_time_name;
		}

		/**
		 * Determines whether the POST or GET requests contain a
		 * valid csrf token we generated previously
		 * @return boolean
		 */
		public function check(){
			/**
			 * Ensure session_start() was called
			 */
			$session_id = session_id();

			if(empty($session_id))
				die('Session ID not found was session_start() called?');

			$token_name = $this->get_token_name();
			$token_generated_time_name = $this->get_token_generated_time_name();

			/**
			 * Ensure the hash components are in the session
			*/
			if(!isset($_SESSION[$token_name]) || !isset($_SESSION[$token_generated_time_name]))
				return false;

			/**
			 * Ensure the session hasn't timed out
			 */
			$minutes_taken = round(((time() - $_SESSION[$token_generated_time_name])) / 60);

			if($minutes_taken > $this->timeout)
				return false;

			/**
			 * Determine if we need to check the POST or GET request
			 * then check to ensure the hash contents are valid
			 */
			$post = (isset($_POST[$token_name]));
			$get = (isset($_GET[$token_name]));

			if($post)
				return ($_POST[$token_name] == $_SESSION[$token_name]) ? true : false;
			else if($get)
				return ($_GET[$token_name] == $_SESSION[$token_name]) ? true : false;
		}

		/**
		 * Returns as hidden html form field containing the hashed token
		 * @param request type post or get
		 * @return string
		 */
		public function protect($type = 'post'){
			if($type == 'post')
				return '<input type="hidden" value="'.$this->get_new_token().'" name="'.$this->get_token_name().'">';
			else if($type == 'get')
				return $this->token_name.'='.$this->get_new_token();
		}
		
		/**
		 * Builds a new token and stores it in the session
		 * @return string
		 */
		public function get_new_token(){
			$token = sha1(uniqid(true).time().mt_rand(0, 10000));
		
			$_SESSION[$this->get_token_name()] = $token;
			$_SESSION[$this->get_token_generated_time_name()] = time();
		
			return $token;
		}

		/**
		 * Returns the token name for this CSRF instance contains a standard
		 * prefix and then a postfix provided by the user
		 * @return string
		 */
		public function get_token_name(){
			return $this->token_name.'_'.$this->id;
		}

		/**
		 * Returns the name used to store the token generated time in the session contains a standard
		 * prefix and then a postfixed provided by the user
		 * @return string
		 */
		public function get_token_generated_time_name(){
			return $this->token_generated_time_name.'_'.$this->id;
		}
	}
?>