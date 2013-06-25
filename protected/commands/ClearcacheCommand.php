<?php
Yii::import('application.commands.AbstractCommand');

/**
 * Yiic command to delete assets and cache
 */
class ClearcacheCommand extends AbstractCommand
{

	/**
	 * @see CConsoleCommand::init()
	 * @return void
	 */
	public function init()
	{
		parent::init();
		$this->defaultAction = 'help';
	}

	/**
	 * clear cache and assets folder
	 *
	 * @param string $cacheID=cache name of property in configuration, comma seperated for multiple caches
	 * @param string $assetPath=null defaults to /assets
	 * @return void
	 */
	public function actionAll($cacheID = 'cache', $assetPath = null)
	{
		$this->actionCache($cacheID);
		$this->actionAssets($assetPath);
	}

	/**
	 * flush cache
	 *
	 * @param string $cacheID=cache name of property in configuration, comma seperated for multiple caches
	 * @return void
	 */
	public function actionCache($cacheID = 'cache')
	{
		$this->printf("Run action cache");
		$cacheIDs = explode(',', $cacheID);
		foreach($cacheIDs as $cache)
		{
			$cache = trim($cache);
			if (isset(Yii::app()->$cache))
			{
				if (Yii::app()->$cache instanceof CApcCache)
				{
					$this->printf("Cache '%s' is CApcCache and therefor unsupported", $cache);
				}
				else if (Yii::app()->$cache->flush())
				{
					$this->printf("Cache '%s' cleared", $cache);
				}
				else
				{
					$this->printf("Clear '%s' cache failed", $cache);
				}
			}
			else
			{
				$this->printf("No cache configured for '%s'.", $cache);
			}
		}
	}

	/**
	 * clear assets folder
	 *
	 * @param string $assetPath=null defaults to /assets
	 * @return void
	 */
	public function actionAssets($assetPath = null)
	{
		$this->printf("Run action assets");
		if ($assetPath === null)
		{
			$assetPath = realpath(__DIR__.'/../../assets');
			$this->printf("No asset path submitted. Assuming '%s'", $assetPath);
			if (!$this->confirm('Continue deleting assets?'))
			{
				return; // no exit, otherwise chained command will not be executed
			}
		}
		if (!is_dir($assetPath))
		{
			$this->printf("Submitted asset path '%' is invalid", $assetPath);
		}
		else
		{
			$dirs = array();
			$files = array();
			$this->collectAssetTargets($assetPath, $dirs, $files);
			$this->printf("Found %d directories and %d files", count($dirs), count($files));
			if (!empty($dirs) ||!empty($files))
			{
				if (!$this->confirm('Continue deleting assets?'))
				{
					return; // no exit, otherwise chained command will not be executed
				}
				foreach($files as $file)
				{
					$this->verbose('Trying to remove file "%s"', $file);
					if (!unlink($file))
					{
						$this->printf("Deleting of asset file '%s' failed", $file);
					}
				}
				// inverse order of directories to avoid can not delete non-empty directory
				$dirs = array_reverse($dirs);
				foreach($dirs as $dir)
				{
					$this->verbose('Trying to remove dir "%s"', $dir);
					if (!rmdir($dir))
					{
						$this->printf("Deleting of asset dir '%s' failed", $dir);
					}
				}
			}
		}
		$this->printf("Done.");
	}

	/**
	 * recurse into given path and collect files and folders
	 *
	 * @param string $assetPath
	 * @param array $dirs
	 * @param array $files
	 * @return void
	 */
	protected function collectAssetTargets($assetPath, &$dirs, &$files)
	{
		$assetfiles = scandir($assetPath);
		foreach($assetfiles as $assetFile)
		{
			if (substr($assetFile, 0, 1) == '.')
			{
				continue;
			}
			else if (is_dir($assetPath . DIRECTORY_SEPARATOR . $assetFile))
			{
				$dirs[] = $assetPath . DIRECTORY_SEPARATOR . $assetFile;
				$this->collectAssetTargets($assetPath . DIRECTORY_SEPARATOR . $assetFile, $dirs, $files);
			}
			else if (is_file($assetPath . DIRECTORY_SEPARATOR . $assetFile))
			{
				$files[] = $assetPath . DIRECTORY_SEPARATOR . $assetFile;
			}
		}
	}
}
