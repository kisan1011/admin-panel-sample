<?php 
    function FileUploadHelper($file,$folder) {
  		if ($file) {
            $fileName = rand(1000000,9999999).time().uniqid().'.'.$file->extension();  
            if (!is_dir(public_path($folder))) {
              mkdir(public_path($folder),0755,true);
            }
	        $file->move(public_path($folder), $fileName);
	        return 'public/'.$folder.'/'.$fileName;
	    }
    }

    function destroyFileHelper($image_path)
    {
    	if(file_exists($image_path)){
	        File::delete($image_path);
	    }
    }
?>