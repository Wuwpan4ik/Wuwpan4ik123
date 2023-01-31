<?php
    trait CheckDirSize {
        public function dir_size($path) {
            $path = ($path . '/');
            $size = 0;
            $dir = opendir($path);
            if (!$dir) {
                return 0;
            }

            while (false !== ($file = readdir($dir))) {
                if ($file == '.' || $file == '..') {
                    continue;
                } elseif (is_dir($path . $file)) {
                    $size += $this->dir_size($path . '//' . $file);
                } else {
                    $size += filesize($path . '//' . $file);
                }
            }
            closedir($dir);
            return $size;
        }

    }