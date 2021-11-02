<?php
$namafile = "6ad22831e8c0293aee250a797a18e3db";
			$dir = "assets";
			if ($handle = opendir($dir)) {
				while (false !== ($file = readdir($handle))) {
					$cek = preg_match("/^[a-zA-Z0-9._-]+\.txt$/", $file);
					if ($cek == TRUE) {
						$nama = str_replace(".txt","",$file);
						$ubah = md5($nama);
						if ($namafile == $ubah) {
							$file_dir = $dir."/".$file;
							$readfile = fopen($file_dir,"r");
							$filedata = fread($readfile,filesize($file_dir));
							fclose($readfile);
							$encrypt = md5($filedata).md5($filedata); 
							$key = "2c67cf629600b9cecc235d720df2bf3e2c67cf629600b9cecc235d720df2bf3e";
							
							
							if ($encrypt != $key) {
								
								$_SESSION['keluar'] = "isi file berbeda";
								redirect("keluar"); 
							}
						} else {
							$_SESSION['keluar'] = "nama file berbeda";
							redirect("keluar"); 
						}
					} 
				}
				if ($cek == FALSE) { 
						$_SESSION['keluar'] = "tidak ada file txt";
						redirect("keluar"); 
					}
				
			}