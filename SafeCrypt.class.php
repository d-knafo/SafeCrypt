<?php
	class SafeCrypt {
		
		private static $cipher = MCRYPT_RIJNDAEL_128;          // Algorithme use for encrypte
		private static $key    = 'key';                        // string
		private static $mode   = 'str';                        // string
		
		public static function encrypt($data) {
			$keyHash = md5(self::$key);
			$key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
			$iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
			
			$data = mcrypt_encrypt(self::$cipher, $key, $data, self::$mode, $iv);
			return base64_encode($data);
		}
		
		public static function decrypt($data) {
			$keyHash = md5(self::$key);
			$key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
			$iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
			
			$data = base64_decode($data);
			$data = mcrypt_decrypt(self::$cipher, $key, $data, self::$mode, $iv);
			return rtrim($data);
		}
	}
	
	/******************************************************************/
	/*                   How to use                                   */
	/*		 	$string     = "test !";                               */
	/*			$encrypt   = SafeCrypt::encrypt($string);             */
	/*			$decrypt   = SafeCrypt::decrypt($encrypt);            */
	/******************************************************************/
