<?php 
	//$path = "http://www.glencheney.com/transformers/";
?>
</head>
<body style="
<?php 
	switch ($_SESSION['background'])
	{
		case 'decepticon': 
			echo 'background: #000 url('.$path.'images/decepticon1.jpg) no-repeat top center;';
			break;
		case 'optimus': 
			echo 'background: #000 url('.$path.'images/optimusbg.jpg) no-repeat top center;';
			break;
		case 'bumblebee': 
			echo 'background: #000 url('.$path.'images/bumblebeebg.jpg) no-repeat top center;';
			break;
		case 'fox': 
			echo 'background: #000 url('.$path.'images/mfox1.jpg) no-repeat top center;';
			break;
	}
	?>" onLoad="init()<?php echo $doneFunc?>">
<div id="container">
    <div id="header">
        <div id="nav">
            <ul>
            <?php 
			switch ($page)
			{
			case 'home': echo '
                <li class="currentPage">
                	<a href="'.$path . 'index.php">Home</a>
 					<ul id="homelist">
                    	<li><a href="'.$path.'comment/comment.php">Site Comments</a></li>
                    	<li><a href="'.$path.'annotatedcss.php">Annotated CSS</a></li>
                    </ul>               
                </li>
                <li>
                	<a href="'.$path.'cast.php">People</a>
                	<ul id="peoplelist">
                        <li><a href="'.$path.'cast.php">Cast</a></li>
                        <li><a href="'.$path.'bay.php">Michael Bay</a></li>
               		</ul>
                </li>
                <li>
                	<a href="'.$path.'filming.php">Production</a>
                	<ul id="productionlist">
                    	<li><a href="'.$path.'filming.php">Filming</a></li>
                        <li><a href="'.$path.'fx.php">Special FX</a></li>
                        <li><a href="'.$path.'development.php">Development</a></li>
                    </ul>
                </li>
                <li>
                	<a href="'.$path.'plot.php">The Movie</a>
                    <ul id="movielist">
                    	<li><a href="'.$path.'plot.php">Plot</a></li>
                        <li><a href="'.$path.'quotes.php">Quotes</a></li>
                        <li><a href="'.$path.'boxoffice.php">Box Office</a></li>
                        <li><a href="'.$path.'reviews.php">Reviews</a></li>
                    </ul>
                </li> ';
				break;
				case 'bay':
				case 'cast':
				echo '
                <li>
                	<a href="'.$path . 'index.php">Home</a>
 					<ul id="homelist">
                    	<li><a href="'.$path.'comment/comment.php">Site Comments</a></li>
                    	<li><a href="'.$path.'annotatedcss.php">Annotated CSS</a></li>
                    </ul>               
                </li>
                <li class="currentPage">
                	<a href="'.$path.'cast.php">People</a>
					<img src="'.$path.'images/t2logo.png" alt="t2 logo" style="position: absolute; top: 0px; left: 120px;" />
                	<ul id="peoplelist">
                        <li><a href="'.$path.'cast.php">Cast</a></li>
                        <li><a href="'.$path.'bay.php">Michael Bay</a></li>
               		</ul>
                </li>
                <li>
                	<a href="'.$path.'filming.php">Production</a>
                	<ul id="productionlist">
                    	<li><a href="'.$path.'filming.php">Filming</a></li>
                        <li><a href="'.$path.'fx.php">Special FX</a></li>
                        <li><a href="'.$path.'development.php">Development</a></li>
                    </ul>
                </li>
                <li>
                	<a href="'.$path.'plot.php">The Movie</a>
                    <ul id="movielist">
                    	<li><a href="'.$path.'plot.php">Plot</a></li>
                        <li><a href="'.$path.'quotes.php">Quotes</a></li>
                        <li><a href="'.$path.'boxoffice.php">Box Office</a></li>
                        <li><a href="'.$path.'reviews.php">Reviews</a></li>
                    </ul>
                </li> ';
					break;
			case 'comments':
			case 'css': echo '
                <li class="currentPage">
                	<a href="'.$path . 'index.php">Home</a>
					<img src="'.$path.'images/t2logo.png" alt="t2 logo" style="position: absolute; top: 0px; left: 105px;" />
 					<ul id="homelist">
                    	<li><a href="'.$path.'comment/comment.php">Site Comments</a></li>
                    	<li><a href="'.$path.'annotatedcss.php">Annotated CSS</a></li>
                    </ul>               
                </li>
                <li>
                	<a href="'.$path.'cast.php">People</a>
                	<ul id="peoplelist">
                        <li><a href="'.$path.'cast.php">Cast</a></li>
                        <li><a href="'.$path.'bay.php">Michael Bay</a></li>
               		</ul>
                </li>
                <li>
                	<a href="'.$path.'filming.php">Production</a>
                	<ul id="productionlist">
                    	<li><a href="'.$path.'filming.php">Filming</a></li>
                        <li><a href="'.$path.'fx.php">Special FX</a></li>
                        <li><a href="'.$path.'development.php">Development</a></li>
                    </ul>
                </li>
                <li>
                	<a href="'.$path.'plot.php">The Movie</a>
                    <ul id="movielist">
                    	<li><a href="'.$path.'plot.php">Plot</a></li>
                        <li><a href="'.$path.'quotes.php">Quotes</a></li>
                        <li><a href="'.$path.'boxoffice.php">Box Office</a></li>
                        <li><a href="'.$path.'reviews.php">Reviews</a></li>
                    </ul>
                </li> ';
				break;
				case 'bay':
				case 'cast':
				echo '
                <li>
                	<a href="'.$path . 'index.php">Home</a>
 					<ul id="homelist">
                    	<li><a href="'.$path.'comment/comment.php">Site Comments</a></li>
                    	<li><a href="'.$path.'annotatedcss.php">Annotated CSS</a></li>
                    </ul>               
                </li>
                <li class="currentPage">
                	<a href="'.$path.'cast.php">People</a>
					<img src="'.$path.'images/t2logo.png" alt="t2 logo" style="position: absolute; top: 0px; left: 120px;" />
                	<ul id="peoplelist">
                        <li><a href="'.$path.'cast.php">Cast</a></li>
                        <li><a href="'.$path.'bay.php">Michael Bay</a></li>
               		</ul>
                </li>
                <li>
                	<a href="'.$path.'filming.php">Production</a>
                	<ul id="productionlist">
                    	<li><a href="'.$path.'filming.php">Filming</a></li>
                        <li><a href="'.$path.'fx.php">Special FX</a></li>
                        <li><a href="'.$path.'development.php">Development</a></li>
                    </ul>
                </li>
                <li>
                	<a href="'.$path.'plot.php">The Movie</a>
                    <ul id="movielist">
                    	<li><a href="'.$path.'plot.php">Plot</a></li>
                        <li><a href="'.$path.'quotes.php">Quotes</a></li>
                        <li><a href="'.$path.'boxoffice.php">Box Office</a></li>
                        <li><a href="'.$path.'reviews.php">Reviews</a></li>
                    </ul>
                </li> ';
					break;
				case 'development':
				case 'fx':
				case 'filming':
				echo '
                <li>
                	<a href="'.$path . 'index.php">Home</a>
 					<ul id="homelist">
                    	<li><a href="'.$path.'comment/comment.php">Site Comments</a></li>
                    	<li><a href="'.$path.'annotatedcss.php">Annotated CSS</a></li>
                    </ul>               
                </li>
                <li>
                	<a href="'.$path.'cast.php">People</a>
                	<ul id="peoplelist">
                        <li><a href="'.$path.'cast.php">Cast</a></li>
                        <li><a href="'.$path.'bay.php">Michael Bay</a></li>
               		</ul>
                </li>
                <li class="currentPage">
                	<a href="'.$path.'filming.php">Production</a>
					<img src="'.$path.'images/t2logo.png" alt="t2 logo" style="position: absolute; top: 0px; left: 185px;" />
                	<ul id="productionlist">
                    	<li><a href="'.$path.'filming.php">Filming</a></li>
                        <li><a href="'.$path.'fx.php">Special FX</a></li>
                        <li><a href="'.$path.'development.php">Development</a></li>
                    </ul>
                </li>
                <li>
                	<a href="'.$path.'plot.php">The Movie</a>
                    <ul id="movielist">
                    	<li><a href="'.$path.'plot.php">Plot</a></li>
                        <li><a href="'.$path.'quotes.php">Quotes</a></li>
                        <li><a href="'.$path.'boxoffice.php">Box Office</a></li>
                        <li><a href="'.$path.'reviews.php">Reviews</a></li>
                    </ul>
                </li> ';
					break;
				case 'quotes':
				case 'plot':
				case 'boxOffice':
				case 'reviews':
				echo '
                <li>
                	<a href="'.$path . 'index.php">Home</a>
 					<ul id="homelist">
                    	<li><a href="'.$path.'comment/comment.php">Site Comments</a></li>
                    	<li><a href="'.$path.'annotatedcss.php">Annotated CSS</a></li>
                    </ul>               
                </li>
                <li>
                	<a href="'.$path.'cast.php">People</a>
                	<ul id="peoplelist">
                        <li><a href="'.$path.'cast.php">Cast</a></li>
                        <li><a href="'.$path.'bay.php">Michael Bay</a></li>
               		</ul>
                </li>
                <li>
                	<a href="'.$path.'filming.php">Production</a>
                	<ul id="productionlist">
                    	<li><a href="'.$path.'filming.php">Filming</a></li>
                        <li><a href="'.$path.'fx.php">Special FX</a></li>
                        <li><a href="'.$path.'development.php">Development</a></li>
                    </ul>
                </li>
                <li class="currentPage">
                	<a href="'.$path.'plot.php">The Movie</a>
					<img src="'.$path.'images/t2logo.png" alt="t2 logo" style="position: absolute; top: 0px; left: 180px;" />
                    <ul id="movielist">
                    	<li><a href="'.$path.'plot.php">Plot</a></li>
                        <li><a href="'.$path.'quotes.php">Quotes</a></li>
                        <li><a href="'.$path.'boxoffice.php">Box Office</a></li>
                        <li><a href="'.$path.'reviews.php">Reviews</a></li>
                    </ul>
                </li> ';
					break;
					case 'default':	echo '
                <li class="currentPage">
                	<a href="'.$path . 'index.php">Home</a>
 					<ul id="homelist">
                    	<li><a href="'.$path.'comment/comment.php">Site Comments</a></li>
                    	<li><a href="'.$path.'annotatedcss.php">Annotated CSS</a></li>
                    </ul>               
                </li>
                <li>
                	<a href="'.$path.'cast.php">People</a>
                	<ul id="peoplelist">
                        <li><a href="'.$path.'cast.php">Cast</a></li>
                        <li><a href="'.$path.'bay.php">Michael Bay</a></li>
               		</ul>
                </li>
                <li>
                	<a href="'.$path.'filming.php">Production</a>
                	<ul id="productionlist">
                    	<li><a href="'.$path.'filming.php">Filming</a></li>
                        <li><a href="'.$path.'fx.php">Special FX</a></li>
                        <li><a href="'.$path.'development.php">Development</a></li>
                    </ul>
                </li>
                <li>
                	<a href="'.$path.'plot.php">The Movie</a>
                    <ul id="movielist">
                    	<li><a href="'.$path.'plot.php">Plot</a></li>
                        <li><a href="'.$path.'quotes.php">Quotes</a></li>
                        <li><a href="'.$path.'boxoffice.php">Box Office</a></li>
                        <li><a href="'.$path.'reviews.php">Reviews</a></li>
                    </ul>
                </li> ';
				break;
			}
				?>
            </ul>
        </div>
        <!-- End nav -->
    </div>
    <!-- End header -->