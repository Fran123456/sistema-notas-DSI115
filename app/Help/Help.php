<?php

namespace App\Help;

class Help
{

	public static function uploadFile($request, $folder,$input){
		//$request: variable with all the data
		//$folder: folder where you put the file, example "imagenes/"
	  $file  = $request->file($input);
	  $original = Help::replaceCharacter($file->getClientOriginalName());
      $name = Help::shortCode().'-'.time().'-'.$original;
      $file->move(public_path().'/'.$folder,$name);
      return $name;
	}

	public static function replaceCharacter($string){
    $data = array('á','é','í','ó','ú','ñ',' ');
    $sup = array('a','e','i','o','u','n','-');
    $a = $string;

    for ($i=0; $i <count($data) ; $i++) {
      $a = str_replace($data[$i],$sup[$i], $a);
    }

    $a = strtolower($a);
    return $a;
	}


	public static function medium_code(){
     $code = array();
     $code[0] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
     $code[1] = rand(10, 99);
		 $code[2] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);

    return $code[0].$code[1].$code[2];
   }

	 public static function Today(){
		 $today = getdate();
     return $today['mday'].'-'.$today['mon'].'-'.$today['year'];
	 }

	 public static function fechaHoyPorYear(){
		 $today = getdate();
     return $today['year'].'-'.$today['mon'].'-'.$today['mday'];
	 }

	 public static function yearActual(){
	 	$today = getdate();
	 	return $today['year'];
	 }

	 public static function dateFormatter($date){
		 $c =  substr($date, 0, 10);
		 $date = new \DateTime($c);
		 return $date->format('d/m/Y') ;
	 }

	 public static function shortCode(){
		 $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
		 return $code;
	 }

	 public static function MakeJson($filename, $mode, $json){
		 $json = json_encode($json);
		 $fp = fopen($filename,$mode);
		 fwrite($fp, $json);
	 }

	 public static function ReadJson($path){
        $data = file_get_contents($path);
        $data = json_decode($data, true);
        return $data;
	 }

	
}
 ?>
