<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Artical */

$this->title = 'Create Artical';
$this->params['breadcrumbs'][] = ['label' => 'Articals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artical-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
