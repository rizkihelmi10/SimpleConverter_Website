<?php
    $target_dir="C:\PDFuntukCAT201\CAT201";
    $filename = $_FILES['fileupload']['name'];
    $tmpname = $_FILES['fileupload']['tmp_name'];
    $errors= [];

    $fileextensions=["pdf"];
    $arr=explode(".",$filename);
    $ext=strtolower(end($arr));

    $uploadpath=$target_dir.basename($filename);
    $text ="";
    if(! in_array($ext,$fileextensions)) {
        $errors[]="Invalid filename";
        exit("You cannot put this type of File");

    } else if(empty($errors)) {
        if(move_uploaded_file($tmpname,$uploadpath))
        {
            echo "file uploaded successfully <br>";
            $fileForText = basename($filename,".pdf");
            $fileForText = $fileForText . ".txt";
            $text = shell_exec("cd C:\Users\alexa\PDFText\src && javac -cp pdfbox-app-2.0.24.jar; PDFConvert.java && java -cp pdfbox-app-2.0.24.jar; PDFConvert $uploadpath" );
            $myfile = fopen($fileForText, "w") or die("Unable to open file!");
            fwrite($myfile, $text);
            fclose($myfile);
            $targetTxt = "C:\Users\alexa\Downloads";

            echo "<br>";
            echo "<a href= $fileForText download = $fileForText target = $targetTxt > Click this link to Download </a>";

        }
        else
        {
            echo "not successfull";
        }
    } else {
        foreach($errors as $value)
        {
            echo "$value";
        }
    }

?>
