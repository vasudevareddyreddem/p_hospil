	<!DOCTYPE html>
<html>
<style>

	.backimg {
		background-image: url("<?php echo base_url('assets/back.png'); ?>");
	
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		height:53.76mm;
		width:85mm;
		position:relative;
		float:left;
	}
	<!--.backimg1 {
		background-image: url("<?php echo base_url('assets/back.png'); ?>");
	
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		height:217px;
		width:335px;
		position:relative;
		float:right;
		top:-217px
	}
		.backimg2 {
		background-image: url("<?php echo base_url('assets/back.png'); ?>");
	
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		height:217px;
		width:335px;
		position:relative;
		float:right;
		top:-217px
	}-->
	.card-number{
	position: absolute;
    left: 52%;
    top: 65%;
    transform: translate(-50%,-50%);
	font-size:30px;
	letter-spacing:5px;
	color:#fff;
	width:8.2cm;
	
	
		
	}

input[type="text"]
{
    background: transparent;
    border: none;
}
.row1{
	text-algin:center
}
</style>
<body>
<div style="height:330.2mm;width:482.6mm;border:1px solid red;">

<?php //echo '<pre>';print_r($card_num_list);exit; ?>
<?php foreach($card_num_list as $list){ ?>
	<div class="row1" >
	<div style="margin:3.764mm 28.707mm;">
		<?php if(isset($list[0]) && $list[0]!=''){ ?>
			<div class="backimg"  >
				<h1 class="card-number"><input class="card-number" type="text" style="" value="<?php echo chunk_split(isset($list[0])?$list[0]:'', 4, ' '); ?>"></h1>
			</div>
		<?php } ?>
		<?php if(isset($list[1]) && $list[1]!=''){ ?>
		<div class="backimg"  >
			<h1 class="card-number"><input class="card-number" type="text" style="" value="<?php echo chunk_split(isset($list[1])?$list[1]:'', 4, ' '); ?>"></h1>
		</div>
		<?php } ?>
		<?php if(isset($list[2]) && $list[2]!=''){ ?>
		<div class="backimg" >
			<h1 class="card-number"><input class="card-number" type="text" style="" value="<?php echo chunk_split(isset($list[2])?$list[2]:'', 4, ' '); ?>"></h1>
		</div>
		<?php } ?>
		<?php if(isset($list[3]) && $list[3]!=''){ ?>
		<div class="backimg"  >
			<h1 class="card-number"><input class="card-number" type="text" style="" value="<?php echo chunk_split(isset($list[3])?$list[3]:'', 4, ' '); ?>"></h1>
		</div>
		<?php } ?>
		<?php if(isset($list[4]) && $list[4]!=''){ ?>
		<div class="backimg" >
			<h1 class="card-number"><input class="card-number" type="text" style="" value="<?php echo chunk_split(isset($list[4])?$list[4]:'', 4, ' '); ?>"></h1>
		</div>
		</div>
		<?php } ?>
	</div>
<?php } ?>


</div>
</body>
</html>
 <script>
function myFunction() {
    window.print();
}
</script>

<?php //exit; ?>