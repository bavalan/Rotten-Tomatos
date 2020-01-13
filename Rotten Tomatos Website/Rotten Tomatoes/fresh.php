<!--
Bavalan Thangarajah
CSCB20
Student# 1002194564
This assignment is for the purpose of creating a movie review website Rancid Tomatoes for several movies. 
This file is the php document which contains the grouping of the pictures,reviews 
and overall content for the selected movie. 
This file will lead you to the website that will contain the review for the chosen movie.-->

<!DOCTYPE html>
<html lang = "en">
	<!-- CSCB20 Assignment 2: Fresh Tomatoes Web page -->
	<head>
		<!-- Link to CSS file that you should create -->
		<link href="fresh.css" type="text/css" rel="stylesheet"/>
		<link href="https://mathlab.utsc.utoronto.ca/courses/cscb20w17/bretsche/assignments/a2/img/rotten.gif" type="image/gif" rel="icon"/>
		
		<?php $movie = $_REQUEST["film"];
		$info = $movie . "/info.txt"; // Attach the movie and the info.txt file
		$open_info = file($info); // Open the info.txt file
		?>

		<title> <?=$open_info[0]."- Rancid Tomatoes";
		/*
		Take the first row of the info.txt file and add the 
		phrase "- Rancid Tomatoes".
		*/
		?></title>

		<meta charset="utf-8" />
		<!-- this "base" element allows all image references below to be "relative",
		     meaning that you the image name, such as "overview.png", is appended
		     to this base URL.  NOTE however, that the same behavior will apply
		     to any other URL's below, and so those will have to be replaced with
		     absolute URL's written as "https://mathlab.../path_to_your_files".-->
		
	</head>
	<!-- The body of the entire page -->
	<body>	

		<?php $movie = $_REQUEST["film"]; 
		$info = $movie . "/info.txt"; // Attach the movie and the info.txt file
		$open_info = file($info); // Open the info.txt file
		$year = trim($open_info[1]); // Trim the second row(year of movie) from info.txt to remove any whitespace.
		?>


		<!-- The banner at the top of the page -->
		<div class='banner' id="ban">

			<img src="https://mathlab.utsc.utoronto.ca/courses/cscb20w17/bretsche/assignments/a2/img/banner.png" alt="Rancid Tomatoes" />
		</div>

		<!-- The header that has the movie name and year -->
		<h1><?=$open_info[0] . "(".$year.")";
		/*
		Display the header of the movie by
		getting the movie title($open_info[0]) and 
		appending the year of the movie.
		*/
		?></h1>
		
		<!-- Includes the border itself and all the information within it -->
		<div class="box" id="boxed">
			<!-- Contains the information thats only IN the border-->
			<div class="overall" id="all">
				<?php $overview = $movie . "/overview.txt"; // Attach the movie and the overview.txt file
				$overviews = file($overview); // Open the overview.txt file ?> 
				<!-- Contains all the information that will appear on the right side within the border-->
				<div class="rs" id="right">
					<!-- The poster image-->
					<div class="poster" id="post">
						<!-- The display the movie poster image by
						getting the movie link and appending overview.png-->
                   		<img src="<?=$movie."/overview.png"?>" alt="general overview"/>
 					</div>
					<!-- All the information about the movie(Cast,directors,rating,genre, etc)-->
					<dl>
						<? for($i=0;$i<count($overviews);$i++){ // For loop that will loop until the number of overview headings?>
							<dt><?=substr($overviews[$i], 0, strpos($overviews[$i], ':'));
							/*
							Remove the semicolon from each over view header by frinding the position of ":" from each overview info (an array) using strpos. Then display the heading using substr(string,start,length).
							*/
							?></dt>
							<dd><?=trim(substr($overviews[$i], strpos($overviews[$i], ':') + 1));
							/*
							Add one position from the semi colon then display every infor after the semi colon.
							*/
							?></dd>
						<?}?>
					</dl>
				</div>
				<!-- Contains all the information that will appear on the left side within the border-->
				<div class="ls" id="left">
					<!--The rating of the movie and tomatoe image-->
					<div class="tom" id="tomtoe">
						<img src="https://mathlab.utsc.utoronto.ca/courses/cscb20w17/bretsche/assignments/a2/img/<?=rateimg($open_info)
						//call the rateimg funtion?>" alt= "<?=alternateimg($open_info) //Alt img?>" >
						<?=$open_info[2]."%" //Rating of the movie?>
					</div>
					<!--All the review that appear on the left column -->
					<?php $reviews=(glob($movie."/"."review*.txt"));// Find all files with the name review().txt
					$length = count($reviews);//Count the number of review file
					$ls = array_slice($reviews, 0, round(($length / 2)));//Divide the number of reviews by 2 for left side
					$rscalc= ($length - count($ls));
					/* Calculate the number of right sides by substractiing total # of reviews from left
					inorder to get the rightside.*/
					$rs = array_slice($reviews,0, $rscalc);// Store number of reviews for the right side
					?>					
					<div class="tot-rev" id="totalsleft">
					<!--Individual reviews each review is labeled from 1-5 accordinglly-->
					<!--Span contains the name of reviewers and company-->
						<? for ($i=1; $i <= count($ls) ; $i++) { //Apply loop until the number of left-side reviews is met
							$all_ls[$i]=$reviews[$i-1]; //Store each individual review.txt file seprately in an array for the left side
							?>
								<div class="rev">
									<?$open_ls = file($all_ls[$i]);//Open each individual review?>
									<p>
									
									<img src="https://mathlab.utsc.utoronto.ca/courses/cscb20w17/bretsche/assignments/a2/img/<?=rotten_fresh($open_ls)
									 //Called the rotten_fresh functions?>" alt= "<?=alt_rotten_fresh($open_ls)//Alt img?>">
										<q>	<?=$open_ls[0];//Display the first row(review) of each review file?> </q>
									</p>
								</div>

							<div class="reviewd">
								<p>
									<img src="https://mathlab.utsc.utoronto.ca/courses/cscb20w17/bretsche/assignments/a2/img/critic.gif" alt="Critic">
									<span class="names"> 
										<?=$open_ls[2];//Display the third row(name of reviewer) of each review file?>
									 <br> </span>
									<span class="company">
										<?=$open_ls[3];//Display the fourth row(publisher company) of each review file?>
									 </span>
								</p>
							</div>
						<?}?>

					</div>
					<div class="tot-rev" id="totalsright">
					<!--Individual reviews each review is labeled from 1-5 accordinglly-->
					<!--Span contains the name of reviewers and company-->

						<? for ($i=1; $i <= count($rs) ; $i++) { //Apply loop until the number of right-side reviews is met
							$all_rs[$i]=$reviews[$i+count($ls)-1];//Store each individual review.txt file seprately in an array for the right side
							?>
							
							<div class="rev">
								<?$open_rs = file($all_rs[$i]);//Open each individual review?>
								<p>
									<img src="https://mathlab.utsc.utoronto.ca/courses/cscb20w17/bretsche/assignments/a2/img/<?=rotten_fresh($open_rs)
									 //Called the rotten_fresh functions?>" alt= "<?=alt_rotten_fresh($open_rs)//Alt img?>">
									
									<q> <?=$open_rs[0];//Display the first row(review) of each review file?> </q>
								</p>
							</div>
							
							<div class="reviewd">
								<p>
									<img src="https://mathlab.utsc.utoronto.ca/courses/cscb20w17/bretsche/assignments/a2/img/critic.gif" alt="Critic">
									<span class="names"> 
										<?=$open_rs[2];//Display the third row(name of reviewer) of each review file?>
									 <br> </span>
									<span class="company">
										<?=$open_rs[3];//Display the fourth row(publisher company) of each review file?>
									 </span>
								</p>
							</div>
						<?}?>

					</div>				
				</div>
				<!--Number of review in each page-->
				<div class="pages">
					<p> <?=revlength($length)//Call the number of review per page function?></p>
				</div>
			</div>
		</div>
		<!--The links to the CSS and HTML checkers-->
		<div class="links" id="lnk">
			<p>
		      <a href="http://validator.w3.org/check?uri=referer"><img
		         src="http://www.w3.org/Icons/valid-xhtml10"
		         alt="Valid XHTML 1.0!" height="31" width="88" /></a>
		    </p>
		  
				<a href="../../css_validator.php"><img src="https://mathlab.utsc.utoronto.ca/courses/cscb20w17/bretsche/assignments/a2/img/w3c-css.png" alt="Valid CSS" /></a>
		</div>
	</body>
</html>

<!--PHP functions-->
<?php

function rateimg($rate){
	/*
	(Array[int]) -> str
	
	Returns the corect image depending on the rating of the movie.

	>>> rateimg(45)
	"rottenbig.png"
    >>> rateimg($89)
    freshbig.png
	*/

	if ($rate[2] < 60){ // If the rating of the movie is less than 60, then display the rotten img
		 return "rottenbig.png";
	} else { // else display the fresh img
		return  "freshbig.png";
	}
}

function alternateimg($altimg){
	/*
	(Array[int]) -> str
	
	Returns the alternate image depending on rating.
	>>> alternateimg(45)
	"Rotten"
    >>> alternateimg($89)
    "Fresh"
	*/

	if ($rate[2] < 60){ // If the rating of the movie is less than 60, then display the rotten img
		 return "Rotten";
	} else { // else display the fresh img
		return  "Fresh";
	}
}


function rotten_fresh($img){
	/*
	(Array[string]) -> str
	
	Returns the fresh/rotten img depending on the 2nd line on the review files

	>>> rotten_fresh("FRESH")
   	"rotten.gif"
    >>> rotten_fresh("ROTTEN")
   	"fresh.gif"
	*/
	
	/* 
	Trim the word from the second row of review files, from the word from "FRESH"
	If the result is 0 display the rotten.gif.
	*/
	if (strcmp(trim($img[1]), "FRESH")){
			return "rotten.gif";			
		}
	/* 
	Trim the word from the second row of review files, from the word from "ROTTEN"
	If the result is 0 display the fresh.gif.
	*/
	else if (strcmp(trim($img[1]), "ROTTEN")){
		return "fresh.gif";
	}
}

function alt_rotten_fresh($img){
	/*
	(Array[string]) -> img
	
	Returns the alternate fresh/rotten img

	>>> alt_rotten_fresh("FRESH")
   	"Rotten"
    >>> alt_rotten_fresh("ROTTEN")
   	"Fresh"
	*/
	
	/* 
	Trim the word from the second row of review files, from the word from "FRESH"
	If the result is 0 display the rotten alt img.
	*/
	if (strcmp(trim($img[1]), "FRESH")){
			return "Rotten";			
		}
	/* 
	Trim the word from the second row of review files, from the word from "ROTTEN"
	If the result is 0 display the fresh alt img.
	*/
	else if (strcmp(trim($img[1]), "ROTTEN")){
		return "Fresh";
	}
}


function revlength($length){
	/*
	(int) -> string
	
	Returns the number of reviews per page

	>>> revlength(10)
	"(1-10) of 10"
    >>> revlength(3)
	"(1-3) of 3"
	*/

	return "(1-".$length.") of " . $length; //Display the number of reviews per page

}


?>