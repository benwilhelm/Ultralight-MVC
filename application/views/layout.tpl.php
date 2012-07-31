<html>
	<head>
		<title><?php echo $this->title ; ?></title>
	</head>
	<body>
	  <ul>
	    <li><a href="/home">home</a></li>
	    <li><a href="/about">about</a></li>
	  </ul>
    <?php echo $this->get_content() ; ?>
	</body>
</html>
