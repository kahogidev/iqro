<?php

/** @var yii\web\View $this */

$this->title = 'Admin Mahorat';

?>
<h4 style="margin-top:20px">Dashboard</h4>
<div class="row gy-4 mb-24" style="margin:10px">
    <div class="col-xxl-8">
        <div class="card radius-8 border-0 p-20">
            <div class="row gy-4">
                <div class="col-xxl-4">
                    <div class="card p-3 radius-8 shadow-none bg-gradient-dark-start-1 mb-12">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-0">
                                <div class="d-flex align-items-center gap-2 mb-12">
                                    <span class="mb-0 w-48-px h-48-px bg-base text-pink text-2xl flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <i class="ri-group-fill"></i>
                                    </span>
                                    <div>
                                        <span class="mb-0 fw-medium text-secondary-light text-lg">Umumiy o'quvchilar soni</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-8">
                                <h5 class="fw-semibold mb-0"><?= $totalStudents ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card p-3 radius-8 shadow-none bg-gradient-dark-start-2 mb-12">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-0">
                                <div class="d-flex align-items-center gap-2 mb-12">
                                    <span class="mb-0 w-48-px h-48-px bg-base text-purple text-2xl flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <i class="ri-user-fill"></i>
                                    </span>
                                    <div>
                                        <span class="mb-0 fw-medium text-secondary-light text-lg">Umumiy o'qituvchilar soni</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-8">
                                <h5 class="fw-semibold mb-0"><?= $totalTeachers ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card p-3 radius-8 shadow-none bg-gradient-dark-start-3 mb-0">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-0">
                                <div class="d-flex align-items-center gap-2 mb-12">
                                    <span class="mb-0 w-48-px h-48-px bg-base text-info text-2xl flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <i class="ri-bar-chart-fill"></i>
                                    </span>
                                    <div>
                                        <span class="mb-0 fw-medium text-secondary-light text-lg">O'quvchilarning umumiy o'zlashtirish ko'rsatkichi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-8">
                                <h5 class="fw-semibold mb-0"><?= number_format($averageTestScore, 2) ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>