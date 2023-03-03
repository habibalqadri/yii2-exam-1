<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
    ],
]);
$menuItems = [
    ['label' => 'Dashboard', 'url' => ['/site/index']],
    // ['label' => 'Wali', 'url' => ['/wali/index']],
    ['label' => 'Siswa', 'url' => ['/siswa/index']],
    ['label' => 'Guru', 'url' => ['/guru/index']],
    ['label' => 'Kelas', 'url' => ['/kelas/index']],
    ['label' => 'Mata Pelajaran', 'url' => ['/mata-pelajaran/index']],


    ['label' => 'Riwayat Siswa', 'url' => ['/siswa-rw-kelas/index']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $menuItems,
]);
NavBar::end();
