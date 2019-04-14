<?php 
function hmacsha1($key,$data) {
   $blocksize = 64;
   $hashfunc  = 'md5';
   
   if(strlen($key) > $blocksize)
     $key = pack('H*', $hashfunc($key));
   
   $key  = str_pad($key, $blocksize, chr(0x00));
   $ipad = str_repeat(chr(0x36), $blocksize);
   $opad = str_repeat(chr(0x5c), $blocksize);
   
   $hmac = pack('H*', $hashfunc(($key ^ $opad) . pack('H*', $hashfunc(($key ^ $ipad) . $data))));
   return bin2hex($hmac);

}

// ===========================================================================================
function euplatesc_mac($data, $key)
{
  $str = NULL;

  foreach($data as $d)
  {
   	if($d === NULL || strlen($d) == 0)
  	  $str .= '-'; // valorile nule sunt inlocuite cu -
  	else
  	  $str .= strlen($d) . $d;
  }
     
  // ================================================================
  $key = pack('H*', $key); // convertim codul secret intr-un string binar
  // ================================================================

// echo " $str " ;

  return hmacsha1($key, $str);
}


?>
