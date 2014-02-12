<?php

class Text
{
    public static function teaser($s, $l=256 ,$etc="..." , $strip_tags = true, $fullwords=true) {
	  $s = $strip_tags ? strip_tags($s) : $s;
      $s1 = str_replace(array("\n","\r"),array(" "," "), $s); // replace new line with spaces
      $s2 = mb_substr($s1." ", 0, $l, "utf-8");
      if ($fullwords) {
	    $i=strrpos($s2, " ");
		if ($i) $s2=substr($s2, 0, $i);
	  } else $s2=trim($s2);
      if ($s1 == $s2) return $s1;
      return $s2.$etc;
    }

    public static function truncate($text = '', $length = 100, $suffix = 'Read more&hellip;', $isHTML = true)
	{
        $i = 0;
        $tags = array();
        if($isHTML){
            preg_match_all('/<[^>]+>([^<]*)/', $text, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            foreach($m as $o){
                if($o[0][1] - $i >= $length)
                    break;
                $t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
                if($t[0] != '/')
                    $tags[] = $t;
                elseif(end($tags) == substr($t, 1))
                    array_pop($tags);
                $i += $o[1][1] - $o[0][1];
            }
        }
       
        $output = substr($text, 0, $length = min(strlen($text),  $length + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '');
       
        // Get everything until last space
        $one = substr($output, 0, strrpos($output, " "));
        // Get the rest
        $two = substr($output, strrpos($output, " "), (strlen($output) - strrpos($output, " ")));
        // Extract all tags from the last bit
        preg_match_all('/<(.*?)>/s', $two, $tags);
        // Add suffix if needed
        if (strlen($text) > $length) { $one .= '&nbsp;' . $suffix; } else { $one .= '&nbsp;read'; }
        // Re-attach tags
        $output = $one . implode($tags[0]);
       
        return $output;
    }

    public static function truncateSharp($text, $limit) {
      if (strlen($text) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $limit) . '...';
      }
      return $text;
    }

    public static function getTextBetweenTags($string, $tagname)
    {
      $matches=array();
        $pattern = "/\<$tagname\>([^\<\>]*)\<\/$tagname\>/";
        preg_match($pattern, $string, $matches);
        return $matches[1];
    }

    public static function autolink( &$text, $target='_blank', $nofollow=true )
    {
      $pattern = "/(((http[s]?:\/\/)|(www\.))(([a-z][-a-z0-9]+\.)?[a-z][-a-z0-9]+\.[a-z]+(\.[a-z]{2,2})?)\/?[a-z0-9._\/~#&=;%+?-]+[a-z0-9\/#=?]{1,1})/is";
      $text = preg_replace($pattern, " <a href='$1'>$1</a>", $text);
      // fix URLs without protocols
      $text = preg_replace("/href='www/", "href='http://www", $text);
      return $text;
    }


    static public function slugify($text)
    {
        // replace non letter or digits by -
        $text = str_replace(array(' & ', '&', "'"), array(' and ', ' and ', ''), $text);
        // sequeze spaces
        $text = preg_replace('/\s+/', ' ', $text);
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // sequeze dashes
        $text = preg_replace('/-{2,}/', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT//IGNORE', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // remove leading and tailing spaces
        // trim
        $text = trim($text, '-');
        $text = trim($text);
/*
        if (empty($text))
        {
            return 'n-a';
        }
*/
        return $text; // WARNING: might be empty
    }

    public static function is_arabic($string)
	{
      if(preg_match('/\p{Arabic}/u', $string))
      return true;
      return false;
    }

    public static function getEmailDomain($em){
      $ar=split("@",$em);
      return $ar[1];
    }
	
	public static function slug($string)
	{
		$slug = str_replace('\'','', $string);
		$slug = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '_', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($slug, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '_'));
		return $slug;
	}
    
}