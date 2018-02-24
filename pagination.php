<!-- pagination -->
<?php 

  $pagination = plain_paging_nav();  
  if ($pagination):
?>

<div class="pagination" role="navigation">
    <?php echo $pagination; ?>
</div><!-- .navigation -->

<?php endif; ?>

<!-- /pagination -->