

<?php $__env->startSection('title', 'Dashboard - Manajemen Klinik'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-tachometer-alt text-primary"></i> Dashboard
                    </h2>
                    <p class="text-muted mb-0">
                        Welcome back, <?php echo e(auth()->user()->name); ?> 
                        <span class="badge bg-primary"><?php echo e(ucfirst(auth()->user()->role)); ?></span>
                    </p>
                </div>
                <div class="text-end">
                    <small class="text-muted">
                        <i class="fas fa-calendar"></i> <?php echo e(now()->format('d F Y')); ?>

                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title"><?php echo e($patients); ?></h4>
                            <p class="card-text">Patients</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
                <?php if(auth()->user()->role == 'pendaftaran'): ?>
                <div class="card-footer">
                    <a href="<?php echo e(route('patients.index')); ?>" class="text-white text-decoration-none">
                        <small><i class="fas fa-arrow-right"></i> Details</small>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title"><?php echo e($medicines); ?></h4>
                            <p class="card-text">Medicines</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-pills fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo e(route('medicines.index')); ?>" class="text-white text-decoration-none">
                        <small><i class="fas fa-arrow-right"></i> Details</small>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title"><?php echo e($examinations); ?></h4>
                            <p class="card-text">Examinations</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-stethoscope fa-2x"></i>
                        </div>
                    </div>
                </div>
                <?php if(in_array(auth()->user()->role, ['perawat', 'dokter'])): ?>
                <div class="card-footer">
                    <a href="<?php echo e(route('examinations.index')); ?>" class="text-white text-decoration-none">
                        <small><i class="fas fa-arrow-right"></i> Details</small>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt"></i> Fast Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if(auth()->user()->role == 'pendaftaran'): ?>
                        <div class="col-md-6 mb-3">
                            <a href="<?php echo e(route('patients.create')); ?>" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-user-plus fa-2x d-block mb-2"></i>
                                <span>Register New Patient</span>
                            </a>
                        </div>
                        <?php endif; ?>

                        <?php if(in_array(auth()->user()->role, ['perawat', 'dokter'])): ?>
                        <div class="col-md-6 mb-3">
                            <a href="<?php echo e(route('examinations.index')); ?>" class="btn btn-outline-success w-100 py-3">
                                <i class="fas fa-plus-circle fa-2x d-block mb-2"></i>
                                <span>Add Examination</span>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="<?php echo e(route('examinations.index')); ?>" class="btn btn-outline-warning w-100 py-3">
                                <i class="fas fa-list fa-2x d-block mb-2"></i>
                                <span>View Examinations</span>
                            </a>
                        </div>
                        <?php endif; ?>

                        <?php if(auth()->user()->role == 'apoteker'): ?>
                        <div class="col-md-6 mb-3">
                            <a href="<?php echo e(route('medicines.index')); ?>" class="btn btn-outline-secondary w-100 py-3">
                                <i class="fas fa-pills fa-2x d-block mb-2"></i>
                                <span>Manage Medicine Stock</span>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i> System Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Your Role:</strong>
                        <span class="badge bg-primary ms-2"><?php echo e(ucfirst(auth()->user()->role)); ?></span>
                    </div>

                    <div class="mb-3">
                        <strong>Access Rights:</strong>
                        <ul class="list-unstyled mt-2">
                            <?php if(auth()->user()->role == 'pendaftaran'): ?>
                                <li><i class="fas fa-check text-success"></i> Manage Patient Data</li>
                                <li><i class="fas fa-eye text-info"></i> View Medicine Data</li>
                            <?php elseif(auth()->user()->role == 'dokter'): ?>
                                <li><i class="fas fa-check text-success"></i> Manage Examinations</li>
                                <li><i class="fas fa-check text-success"></i> Input Diagnosis</li>
                                <li><i class="fas fa-eye text-info"></i> View Patient Data</li>
                            <?php elseif(auth()->user()->role == 'perawat'): ?>
                                <li><i class="fas fa-check text-success"></i> Manage Examinations</li>
                                <li><i class="fas fa-check text-success"></i> Input Complaints</li>
                                <li><i class="fas fa-eye text-info"></i> View Patient Data</li>
                            <?php elseif(auth()->user()->role == 'apoteker'): ?>
                                <li><i class="fas fa-check text-success"></i> Manage Medicine Stock</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="text-center">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt"></i> 
                            Your account is secured with a strong password.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\room\klinik_fazri\resources\views/dashboard.blade.php ENDPATH**/ ?>