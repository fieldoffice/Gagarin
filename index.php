<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Field Office | Framework | Patterns</title>
	
	 <style>
		* {
			margin:0;
			padding:0;
		}
		
		body {
			background:#fff;
			font-family: 'helvetica-neue', arial, sans-serif;
			font-size:1em;
			padding:1em;
		}
		
		.pattern {
			background:#f7f7f7;
	       	border-bottom:1px solid #ddd;
			clear:both;
			float:left;
			padding:2%;
			width:96%;
		}
       
		.pattern-example {
			float:left;
       		width:60%;
       	}
       	
		.pattern-source {
			float:right;
       		width:35%;
       	}
       
		.pattern-source textarea {
            font:0.75em/1.5 Menlo,Monaco,Courier,monospace;
            width:100%;
        }
    </style>
	
</head>
<body>

	<h1>Pattern Library</h1>
	
	<?php

	    
	    $files = array();
    	$patterns_dir = "patterns";
		$handle = opendir($patterns_dir);
    	while (false !== ($file = readdir($handle))):
        	if(stristr($file,'.html')):
            	$files[] = $file;
        endif;
    	endwhile;
    	sort($files);
    	foreach ($files as $file):
			echo '<div class="pattern">';	
			
			$fileContentsRaw = file_get_contents($patterns_dir.'/'.$file);
			preg_match('{{title:(.*?)}}', $fileContentsRaw, $titleMatch);
		
			
			if (isset($titleMatch[1])){
				$title = $titleMatch[1];
				$fileContentsRaw = str_replace('{{title:'.$title.'}}', '', $fileContentsRaw);
			}
			if (isset($title) && $title != ''){
				echo '<h3>'.$title.'</h3>';
			}
		    echo '<div class="pattern-example">';
		    	echo $fileContentsRaw;
		        echo '</div>';
        		echo '<div class="pattern-source">';
		        echo '<textarea rows="10" cols="30" onclick="this.focus();this.select()" readonly="readonly">';
        		echo htmlspecialchars($fileContentsRaw);
		        echo '</textarea>';
        		echo '<p><a href="'.$patterns_dir.'/'.$file.'">'.$file.'</a></p>';
		        echo '</div>';
        	echo '</div>';
    	endforeach;
	?>
		
</body>	
</html>