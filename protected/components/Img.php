<?php

/*

	Copy this code to your model:

	public function img($w=false, $h=false, $htmlOptions=array()) {
		$img = 0;
		$htmlOptions['title']=$this->title;
		if ($this->image_uri != NULL){ $img = $this->image_uri; }
		return Img::embed('/news/'.$img, $w, $h, 'default.png',$htmlOptions);
	}

*/

class Img
{
    public static function uri($img, $w = false, $h = false, $def = false)
    {
        if ($def === false)
            $def = Yii::app()->baseUrl . '/app/default.png';
        if (!$img || !file_exists(Yii::app()->basePath . "/../images/${img}")) {
            return Yii::app()->baseUrl . "/images/${def}";
        }
        if (!$w)
            return "/images/${img}";
        return Yii::app()->baseUrl . "/images/thumb/${w}x${h}/${img}.jpg";
    }
    
    public static function embed($img, $w = false, $h = false, $def = false, $attr = false)
    {
        if (!is_array($attr))
            $attr = array();
        if (!isset($attr["alt"]) && isset($attr["title"]))
            $attr["alt"] = $attr["title"];
        if (!isset($attr["alt"]) && !isset($attr["title"])) {
            $attr["alt"] = $attr["title"] = Yii::t('core', 'image');
        }
        if (!$w)
            $size = "";
        else
            $size = ' width="' . $w . 'px" height="' . $h . 'px" ';
        $a = " ";
        foreach ($attr as $k => $v)
            $a .= " $k=\"" . CHtml::encode($v) . "\"";
        return '<img src="' . Img::uri($img, $w, $h, $def) . '" ' . $size . $a . ' />';
    }
    
    public static function a($img, $w = false, $h = false, $def = false, $attr = false, $aattr = false)
    {
        if (!is_array($attr))
            $attr = array();
        if (!is_array($aattr))
            $aattr = array();
        if (!isset($aattr["href"]))
            $aattr["href"] = Img::uri($img, false, false, $def);
        if (!isset($aattr["title"]) && isset($attr["title"]))
            $aattr["title"] = $attr["title"];
        $a = " ";
        foreach ($aattr as $k => $v)
            $a .= " $k=\"" . CHtml::encode($v) . "\"";
        return "<a $a>" . Img::embed($img, $w, $h, $def, $attr) . "</a>";
    }
    
    public static function clearPreview($img, $mode = 'thumb')
    {
        $prefix = Yii::app()->getBasePath() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $mode . DIRECTORY_SEPARATOR . "*x*";
        foreach (glob($prefix) as $d) {
					if (!is_dir($d))
							continue;
					@unlink($d . DIRECTORY_SEPARATOR . $img . ".jpg");
        }
    }
}