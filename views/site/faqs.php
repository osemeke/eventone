<?php
use yii\helpers\Html;

/* @var $this yii\web\View  -  */
$this->title = 'FAQs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-faqs">
    <h1><?= Html::encode($this->title) ?></h1>
    <h4>Frequently Asked Questions</h4>

	<div class="panel-group" id="accordion">
	<?php
	$i = 1;
	foreach ($model as $faq) {
		echo "
		  <div class=\"panel panel-default\">
			<div class=\"panel-heading\">
			  <h4 class=\"panel-title\">
				<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse".$i."\">
				  ".$faq->question."
				</a>
			  </h4>
			</div>
			<div id=\"collapse".$i."\" class=\"panel-collapse collapse\">
			  <div class=\"panel-body\">
				".$faq->answer."
			  </div>
			</div>
		  </div>
		";
		$i++;
	}

	?>
	</div>

</div>
