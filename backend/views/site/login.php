<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>
<section class="auth bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="/images/auth/logo.png" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <a href="index.html" class="mb-40 max-w-290-px">
                    <img src="assets/images/logo.png" alt="">
                </a>
                <h4 class="mb-12">Tizimga kirish</h4>
                <p class="mb-32 text-secondary-light text-lg">Xush kelibsiz! Tizimga kirish uchun ma'lumotlaringizni kiriting</p>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                <?= $form->field($model, 'username', [
                    'template' => '{input}{error}',
                    'inputOptions' => [
                        'class' => 'form-control h-56-px bg-neutral-50 radius-12',
                        'placeholder' => 'Foydalananuvchi nomi',
                    ],
                ])->textInput(['autofocus' => true]) ?>
            </div>
            <div class="position-relative mb-20">
                <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                    <?= $form->field($model, 'password', [
                        'template' => '{input}{error}',
                        'inputOptions' => [
                            'class' => 'form-control h-56-px bg-neutral-50 radius-12',
                            'id' => 'your-password',
                            'placeholder' => 'Parol',
                        ],
                    ])->passwordInput() ?>
                </div>
                <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
            </div>
            <div class="">
                <div class="d-flex justify-content-between gap-2">
                    <div class="form-check style-check d-flex align-items-center">
                        <?= $form->field($model, 'rememberMe', [
                            'template' => '{input}{label}',
                            'inputOptions' => [
                                'class' => 'form-check-input border border-neutral-300',
                                'id' => 'remeber',
                            ],
                        ])->checkbox(['labelOptions' => ['class' => 'form-check-label']]) ?>
                        <style>
                            .form-check-input:checked {
                                background-color: #eb661f;
                                border-color: #eb661f;
                            }
                        </style>
                    </div>

                    <a href="javascript:void(0)" class=" fw-medium" style="color:#eb661f" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Parolni unutdingizmi?</a>                    <!-- Modal -->
                    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="forgotPasswordModalLabel">Parolni unutdingizmi?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Foydalanuvchi nomi yoki parolni unutgan bo'lsangiz, admin yoki mas'ul o'qituvchiga murojaat qiling.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= Html::submitButton('Sign In', [
                'class' => 'btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32',
                'name' => 'login-button',
                'style' => 'background-color: #eb661f; border-color: #eb661f;',
            ]) ?>
            <div class="mt-32 center-border-horizontal text-center">
            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>