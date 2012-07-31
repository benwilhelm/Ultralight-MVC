<h1>About</h1>
<?php foreach ($this->rows as $row) : ?>
<p>
  Key: <?php echo $row->key ; ?><br />
  Value: <?php echo $row->value ; ?>
</p>
<?php endforeach ; ?>