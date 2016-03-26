<div class="err"></div> 
<?php if($gm): ?>
  <br />
  <center><a class="btn btn-info" href="<?php echo site_url('screenshots','add'); ?>">Ajouter un screenshot</a></center>
  <br />
<?php endif; ?>

<div class="modalBlock" style="position:absolute;display:none;z-index:1;">
<img src="#" class="modalImg img-polaroid" style="position:absolute;"/>
</div>

<?php $td = $tr = 0; ?>

<table class="table-condensed">
  <?php for($tr; $tr < $countTr; $tr++) : 
        $i = 0;?>
    <tr>
      <?php while($td < sizeof($screens) && $i < $countColumns) : ?>
	  <td>
	    <figure>
	      <?php if($gm) : ?>
		<a href="<?php echo site_url('screenshots','delete',$screens[$td]['id']); ?>"><?php echo img('icones/del.png');?></a>
	      <?php endif; ?>
	      <a href="<?php echo $screens[$td]['url']; ?>" target="_BLANK"><img src="<?php echo $screens[$td]['url']; ?>" class="iconeImg img-polaroid"> </a>
	      <figcaption><?php echo $screens[$td]['comments']; ?></figcaption>
	    </figure>
	  </td>
	  <?php $td++;
		$i++;
	    endwhile; ?>
    </tr>
  <?php endfor; ?>

</table>

<script>
$(function() {
var maxWidth;
var maxHeight;

$(document).ready().mousemove(function(e){
    $('.modalBlock').offset({
    left : e.pageX + 5,
    top : e.pageY
    });
});
    
$('.iconeImg').each(function(){
  if ( $(this).height() > 137){
      $(this).css('width', (137 * $(this).width() / $(this).height())+'px');
      $(this).css('height','137px');
  }
  if ( $(this).width() > 137){
    $(this).css('height', (137 * $(this).height() / $(this).width())+'px');
    $(this).css('width','137px');
  }
});
                
$('.iconeImg,.modalBlock').mouseenter(function() {
  $('.modalImg').attr('src',$(this).attr('src'));
  var coef =  $('.modalImg').width() / $('.modalImg').height();
  maxWidth = 650;
  maxHeight = 650*coef;
  
  $('.modalImg').css('width',650);
  $('.modalImg').css('height',650 * coef);

  $('.modalBlock').css('display','block');
});

$('.iconeImg,.modalBlock').mouseout(function() {
  $('.modalBlock').css('display','none');
  $('.modalImg').attr('src','#');
});


});
</script>