

<?php $__env->startSection('title', 'Examinations - Management Clinic'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-3"><i class="fas fa-stethoscope text-primary"></i> Examinations</h2>
    <p class="text-muted mb-4">Manage examination data</p>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-list"></i> Examinations
                <span class="badge bg-secondary ms-2"><?php echo e($patients->total()); ?> Total</span>
            </h5>
        </div>
        <div class="card-body">
            <?php if($patients->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Patient Name</th>
                            <th>Weight (kg)</th>
                            <th>Blood Pressure</th>
                            <th>Complaint</th>
                            <th>Diagnosis</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $examination = $patient->examinations->first(); // Ambil pemeriksaan terakhir
                        ?>
                        <tr>
                            <td><?php echo e($patients->firstItem() + $index); ?></td>
                            <td>
                                <strong><?php echo e($patient->name ?? '-'); ?></strong>
                                <?php if($patient->phone): ?>
                                    <br><small class="text-muted"><?php echo e($patient->phone); ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($examination && $examination->weight): ?>
                                    <span class="badge bg-success"><?php echo e($examination->weight); ?> kg</span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($examination && $examination->blood_pressure): ?>
                                    <span class="badge bg-info"><?php echo e($examination->blood_pressure); ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($examination && $examination->complaint): ?>
                                    <span class="text-truncate d-inline-block" style="max-width: 150px;" title="<?php echo e($examination->complaint); ?>">
                                        <?php echo e($examination->complaint); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($examination && $examination->diagnosis): ?>
                                    <span class="text-truncate d-inline-block" style="max-width: 150px;" title="<?php echo e($examination->diagnosis); ?>">
                                        <?php echo e($examination->diagnosis); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($examination): ?>
                                    <small class="text-muted">
                                        <?php echo e($examination->updated_at->format('d/m/Y H:i')); ?>

                                    </small>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($examination): ?>
                                <div class="btn-group" role="group">
                                    <?php if(auth()->user()->role == 'perawat'): ?>
                                    <a href="<?php echo e(route('examinations.form', $examination->id)); ?>" class="btn btn-sm btn-outline-success" title="Edit as Nurse">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <?php endif; ?>
                                    
                                    <?php if(auth()->user()->role == 'dokter'): ?>
                                    <a href="<?php echo e(route('examinations.form', $examination->id)); ?>" class="btn btn-sm btn-outline-primary" title="Edit as Doctor">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <?php endif; ?>
                                </div>
                                <?php else: ?>
                                <div class="btn-group" role="group">
                                    <?php if(auth()->user()->role == 'perawat'): ?>
                                    <a href="<?php echo e(route('examinations.create', $patient->id)); ?>" class="btn btn-sm btn-success" title="Add Examination as Nurse">
                                        <i class="fas fa-plus"></i> Add Examination
                                    </a>
                                    <?php endif; ?>
                                    
                                    <?php if(auth()->user()->role == 'dokter'): ?>
                                    <a href="<?php echo e(route('examinations.create', $patient->id)); ?>" class="btn btn-sm btn-primary" title="Add Examination as Doctor">
                                        <i class="fas fa-plus"></i> Add Examination
                                    </a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <small class="text-muted">
                        Showing <?php echo e($patients->firstItem()); ?> to <?php echo e($patients->lastItem()); ?>

                        of <?php echo e($patients->total()); ?> results
                    </small>
                </div>
                <div>
                    <?php echo e($patients->links()); ?>

                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle"></i> No examination data found.
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\room\klinik_fazri\resources\views/examinations/index.blade.php ENDPATH**/ ?>