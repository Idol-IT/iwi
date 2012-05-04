<?php
class EasyPhpThumb extends CApplicationComponent {

	private $image;
	private $thumbsDirectory;
	
	public function load($imagePath){
		$image = PhpThumbFactory::create($imagePath);
		$this->image = $image;
		return $this;
	}
	
	public function crop($x, $y, $width, $height){
		$this->image->crop($x, $y, $width, $height);
		return $this;
	}
	
	public function resize($width, $height){
		$this->image->resize($width, $height);
		return $this;
	}

    public function adaptiveResize($width, $height)
    {
        $this->image->adaptiveResize($width, $height);
        return $this;
    }
	
	public function resizePercent($procent){
		$this->image->resizePercent($procent);
		return $this;
	} 

	/**
	 * 
	 * @param String $filename
	 * @param String $format - non-casesenssitive allowed values (GIF, JPG, PNG)
	 * @return void
	 */
	public function save($filename = null, $format = null){
		
		if (empty($filename)){
			$filename = basename($this->image->getFileName());
			//replace extension in case of converting to other format
			if (!empty($format)){
				$ext = pathinfo($this->image->getFileName());
				if (strtoupper($ext['extension']) != strtoupper($format)){
					$filename = basename($filename, ".".$ext['extension']).".".strtolower($format);
				}
			}
		}	
	
		if (empty($format))
			$format = $this->image->getFormat();
		else {
			$format = strtoupper($format);
			if (array_search($format, array('GIF','JPG', 'PNG'))==null) {
				throw new Exception("Given format not found in allowed (GIF, JPG, PNG) - received ".$format);
			}
		}
		$this->image->save($this->thumbsDirectory."/".$filename, $format);
	}
	
	public function show(){
		$this->image->show();
	}
	
	public function setThumbsDirectory($relPath){
		
		$webrootDir = YiiBase::getPathOfAlias('webroot');
		if (is_link($webrootDir)) {
			$webrootDir = readlink($webrootDir);
		}
		
		$destDir = $webrootDir.$relPath;
		
		if (!is_dir($destDir) && !is_writeable($destDir)) {
			throw new CException('Target directory('.$destDir.') does not exist or is not writeable.');
		}
		
		$this->thumbsDirectory = $destDir;
		
	}
	
	public function info(){
		return "Php Thumb 3.0 - Yii extension wrapper";
	}
	
	public function init() {
		parent::init();
		include_once('ThumbLib.inc.php');
	}
	

}
