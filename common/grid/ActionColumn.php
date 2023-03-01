<?php

namespace common\grid;

use Yii;
use yii\bootstrap4\Html;
use kartik\grid\ActionColumn as kartikActionColumn;

class ActionColumn extends kartikActionColumn
{

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'far fa-eye');
        $this->initDefaultButton('update', 'fas fa-edit');
        $this->initDefaultButton('delete', 'fas fa-trash', [

            'data-confirm' => Yii::t('yii', 'Apakah anda yakin ingin menghapus data ini?'),
            'data-method' => 'post',
        ]);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'role' => 'modal-remote'
                    // 'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = isset($this->icons[$iconName])
                    ? $this->icons[$iconName]
                    : Html::tag('span', '', ['class' => $iconName]);
                return Html::a($icon, $url, $options);
            };
        }
    }
}
