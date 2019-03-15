<?PHP
	CLASS Directory_Calculator {
		VAR $size_in;
		VAR $decimals;
		FUNCTION calculate_whole_directory($directory) {
			IF ($handle = OPENDIR($directory)) {
				$size = 0;
				$folders = 0;
				$files = 0;
				WHILE (FALSE !== ($file = READDIR($handle))) {
					IF ($file != "." && $file != "..") {
						IF(IS_DIR($directory.$file)) {
							$array = $this->calculate_whole_directory($directory.$file.'/');
							$size += $array['size'];
							$files += $array['files'];
							$folders += $array['folders'];
						} ELSE {
							$size += FILESIZE($directory.$file);
							$files++;
						}
					}
				}
				CLOSEDIR($handle);
			}
			$folders++;
			RETURN ARRAY('size' => $size, 'files' => $files, 'folders' => $folders);
		}
		FUNCTION size_calculator($size_in_bytes) {
			IF($this->size_in == 'B') {
				$size = $size_in_bytes;
			} ELSEIF($this->size_in == 'KB') {
				$size = (($size_in_bytes / 1024));
			} ELSEIF($this->size_in == 'MB') {
				$size = (($size_in_bytes / 1024) / 1024);
			} ELSEIF($this->size_in == 'GB') {
				$size = (($size_in_bytes / 1024) / 1024) / 1024;
			}
			$size = ROUND($size, $this->decimals);
			RETURN $size;
		}
		FUNCTION size($directory) {
			$array = $this->calculate_whole_directory($directory);
			$bytes = $array['size'];
			$size = $this->size_calculator($bytes);
			$files = $array['files'];
			$folders = $array['folders'] - 1;
			RETURN ARRAY('size' => $size, 'files' => $files, 'folders' => $folders);
		}
	}
?>