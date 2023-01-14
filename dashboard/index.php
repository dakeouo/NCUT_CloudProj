<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "首頁";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div style="position: relative; width: 100%; min-width: 1100px;">
			<div class="index-post post-red">
				<div class="post-icon">
					<i class="fas fa-store-alt fa-5x"></i>
				</div>
				<div class="post-content">
					<label>分店數</label><br />
					<div style="float: right;">
						<font>
						<?php echo $dataset->mysql->getSheetCount("shops"); ?>
						</font>家
					</div>
				</div>
			</div>
			<div class="index-post post-yellow">
				<div class="post-icon">
					<i class="fas fa-file-invoice fa-5x"></i>
				</div>
				<div class="post-content">
					<label>訂單紀錄</label><br />
					<div style="float: right;">
						<font>
						<?php echo $dataset->mysql->getSheetCount("orders"); ?>
						</font>份
					</div>
				</div>
			</div>
			<div class="index-post post-green">
				<div class="post-icon">
					<i class="fab fa-product-hunt fa-5x"></i>
				</div>
				<div class="post-content">
					<label>商品項目</label><br />
					<div style="float: right;">
						<font>
						<?php echo $dataset->mysql->getSheetCount("products"); ?>
						</font>項
					</div>
				</div>
			</div>
			<div class="index-post post-blue">
				<div class="post-icon">
					<i class="fas fa-user fa-5x"></i>
				</div>
				<div class="post-content">
					<label>會員數</label><br />
					<div style="float: right;">
						<font>
						<?php echo $dataset->mysql->getSheetCount("users"); ?>
						</font>位
					</div>
				</div>
			</div>
			</div>
			<div class="chart" style="position: relative; top: 1.5em; font-size: 1.2em;">
				<?php $top5 = $dataset->mysql->getRank("products",null,10); ?>
				<?php $cc = 0;
				foreach ($top5 as $key) {
					echo '<input type="hidden" id="top_label['.$cc.']" value="'.$key['name'].'">';
					echo '<input type="hidden" id="top_data['.$cc.']" value="'.$key['count'].'">';
					$cc++;
				}
				?>
				<canvas id="myChart" width="400px" height="180px"></canvas>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
<script>
	var ctx = document.getElementById('myChart');
	var top10 = {label:[],data:[]};
	for(var i=0;i<10;i++) {
		if (document.getElementById(`top_label[${i}]`) != null) {
			top10.label.push(document.getElementById(`top_label[${i}]`).value);
			top10.data.push(parseInt(document.getElementById(`top_data[${i}]`).value));
		}
	}
	var myBarChart = new Chart(ctx, {
    	type: 'bar',
    	data: {
    		labels:top10.label,
    		datasets:[{
    			label:"飲料排行 TOP 10",
    			data:top10.data,
    			backgroundColor:'rgba(255, 112, 0, 0.8)'
    		}],
    		fill:false,
    		borderWidth:0
    	},
    	options: {
        	scales: {
            	yAxes: [{
            	    ticks:{beginAtZero:true}
            	}]
        	}
    	}
	});
	$(function() {
    	$(".content").css("height", "800px");
	});
</script>
</html>