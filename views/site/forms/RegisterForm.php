<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Estado;

/* @var $this yii\web\View */
/* @var $model app\models\UserForm */
/* @var $form ActiveForm */

$this->title = 'Registrar Conta';

	$arrEstado = array();
	$arrEstadoFirst = (new \yii\db\Query())
		->select([
			'nEstadoID', 
			'strUF'
		])
		->from('estado')
		->all();

	foreach ($arrEstadoFirst as $estado) {
		$arrEstado[$estado['nEstadoID']] = $estado;
	};


	$arrCidade = array();
	$arrCidadeFirst = (new \yii\db\Query())
		->select([
			'nCidadeID',
			'strNome',
			'nEstadoID'
		])
		->from('cidade')
		->all();

	foreach ($arrCidadeFirst as $cidade) {
		$arrCidade[$cidade['nEstadoID']] = array();
	};
	foreach ($arrCidadeFirst as $cidade) {
		$arrCidade[$cidade['nEstadoID']][] = $cidade;
	};

?>


<?=	Html::jsFile('@web/js/angular.min.1.6.4.js')	?>
<script type="text/javascript" >
	angular.module('StateAndCities',[]);

	angular.module('StateAndCities').controller('checkStCyCtrl', function($scope){
		$scope.idStateSelected = undefined;

		$scope.idCitySelected = undefined;

		$scope.arrState = JSON.parse('<?php echo addslashes(json_encode($arrEstado)); ?>');
		$scope.arrCidade = JSON.parse('<?php echo addslashes(json_encode($arrCidade)); ?>');
	})
</script>
<div class="site-form-RegisterForm" ng-app="StateAndCities">
	<style type="text/css">
		.form-group > input[type="email"],
		.form-group > input[type="password"],
		.form-group > input[type="text"]{
			width:400px;
		}
		div.form-group.has-error{
			position:relative;
			height:80px;
		}
		div.form-group.has-error > .help-block::after,
		div.form-group.has-error > .control-label::after{
			position:absolute;
			width:130%;
			height:18px;
			content:'';
			left:-6px;
			z-index:-1;
			border-radius:7px;
		}
		div.form-group.has-error > .control-label{
			background-color:red;
			color:white;
		}
		div.form-group.has-error > .help-block::after{
			background-color: #ff6c00;
		}
		div.form-group.has-error > .help-block{
			position:absolute;
			color:white;
			left:0;
			right:auto;
		}
		#userform-strtyperole > label{
			margin-right:10px;
		}
		.fields1,
		.fields2,
		div.form-group{
			width:500px;
		}
		.fields1,
		.fields3{
			float:left;
		}
		.fields2{
			float:right;
		}
		.has-success .control-label{
			background-color:#a7da71;
			padding-left:5px;
			padding-right:5px;
			border-radius:5px;
		}
		.divisorLeft{
			clear:left;
		}
		#userform-nestadoid{
			width:115px;
		}
		#userform-stridestado{
			display:none;
		}
		#userform-stridcidade{
			display:none;
		}
		.field-userform-stridestado{
			margin-bottom:-10px;
		}
		.field-userform-stridcidade{
			margin-bottom:-10px;
		}
		#cidadeSelect,
		#estadoSelect{
			display:block;
		}
		.field-userform-stridcidade{
			margin-top: 20px;
			margin-bottom: 10px;
		}

	</style>
	<h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin(); ?>

		<?php
			$strTypesRole = array('Adotante' => 'Adotante', 'Protetor' => 'Protetor');
			$model->strTypeRole = 'Adotante';

			$listProtetor = [0 => 'Já realizou entrega?'];

			echo
				Html::tag('div',
					$form->field($model, 'strNome').
					$form->field($model, 'strSenha')->passwordInput().
					$form->field($model, 'email')->input('email').
					$form->field($model, 'strTelefone')->widget(\yii\widgets\MaskedInput::className(), [
						'mask' => '(99) 99999-9999',
						'clientOptions' => ['clearIncomplete' => true]
					]).
					$form->field($model, 'strIdEstado')->textInput(['ng-model'=>'idEstado']).
					'<select id="estadoSelect" ng-model="idEstado">
						<option value="">Selecione...</option>
						<option ng-repeat="state in arrState" value="{{state.nEstadoID}}">{{state.strUF}}</option>
					</select>'.
					$form->field($model, 'strIdCidade')->textInput(['ng-model'=>'idCidadeSelected']).
					'<select id="cidadeSelect" ng-model="idCidadeSelected" ng-disabled="!idEstado">
						<option value="">Selecione...</option>
						<option ng-repeat="cidade in arrCidade[idEstado]" value="{{cidade.nCidadeID}}">{{cidade.strNome}}</option>
					</select>'

					// State and Cities

					,['class'=>'fields1', 'ng-controller'=>'checkStCyCtrl']);
			echo
				Html::tag('div',
					$form->field($model, 'strTypeRole')->radioList($strTypesRole).
					$form->field($model, 'emailAlternativo')->input('email').
					$form->field($model, 'strTelefoneAlternativo')->widget(\yii\widgets\MaskedInput::className(), [
						'mask' => '(99) 99999-9999',
						'clientOptions' => ['clearIncomplete' => true]
					]).
					$form->field($model, 'strDetalhesLocal')->textarea(['rows' => '6']).

					'<div class="form-group">'.
						Html::submitButton(Yii::t('app', 'Registrar'), ['class' => 'btn btn-primary']).
					'</div>'
					,['class'=>'fields2']);

			echo Html::tag('div', '',['class'=>'divisorLeft']);
			echo Html::tag('div',
				$form->field($model, 'listProtetorData')->checkboxList($listProtetor)->label(false)
			,['class'=>'fields3']);

			echo Html::tag('div', '',['class'=>'divisorLeft']);

			$listAdotante = [
				0 => 'bPossuiCriancas',
				1 => 'bPossuiPets',
				2 => 'bAdotouAntes'
			];
			echo Html::tag('div',
				$form->field($model, 'listAdotanteData')->checkboxList($listAdotante, ['separator'=>'<br/>', 'visible' => $model->strTypeRole == '2'])->label(false)
			,['class'=>'fields4']);
		?>


	<?php ActiveForm::end(); ?>
	<script type="text/javascript">
		function disableProtetor(){
			$('.fields3')
				.css('display','none')
				.find('input[type="checkbox"]').prop('disabled',true);
		}
		function disableAdotante(){
			$('.fields4')
				.css('display','none')
				.find('input[type="checkbox"]').prop('disabled',true);
			$('.field-userform-strdetalheslocal')
				.css('display','none')
				.find('#userform-strdetalheslocal').prop('disabled',true);
		}
		disableProtetor();
		$('input[type="radio"][value="Protetor"]').change(function(event){
			if(!!$(event.currentTarget).is(':checked')){
				$('.fields3')
					.css('display','block')
					.find('input[type="checkbox"]').prop('disabled',false);
				disableAdotante();
			}
		});
		$('input[type="radio"][value="Adotante"]').change(function(event){
			if(!!$(event.currentTarget).is(':checked')){
				$('.fields4')
					.css('display','block')
					.find('input[type="checkbox"]').prop('disabled',false);
				$('.field-userform-strdetalheslocal')
					.css('display','block')
					.find('#userform-strdetalheslocal').prop('disabled',false);
				disableProtetor();
			}
		});
		$('label[for="userform-stridestado"]').after($('#estadoSelect'));
		$('label[for="userform-stridcidade"]').after($('#cidadeSelect'));
	</script>

</div><!-- site-form-RegisterForm -->
