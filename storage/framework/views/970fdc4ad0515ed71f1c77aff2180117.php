

<?php $__env->startSection('title', 'Patient Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user"></i> Patient Details
                    </h4>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Name</dt>
                        <dd class="col-sm-8"><?php echo e($patient->name); ?></dd>

                        <dt class="col-sm-4">Date of Birth</dt>
                        <dd class="col-sm-8">
                            <?php
                                $dob = \Carbon\Carbon::parse($patient->dob);
                            ?>
                            <?php echo e($dob->format('d/m/Y')); ?>

                            <small class="text-muted">(<?php echo e($dob->age); ?> years old)</small>
                        </dd>

                        <dt class="col-sm-4">Gender</dt>
                        <dd class="col-sm-8">
                            <?php if($patient->gender == 'Male' || $patient->gender == 'Laki-laki'): ?>
                                <span class="badge bg-info"><i class="fas fa-mars"></i> Male</span>
                            <?php else: ?>
                                <span class="badge bg-pink text-white" style="background-color: #e91e63;">
                                    <i class="fas fa-venus"></i> Female
                                </span>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-sm-4">Phone Number</dt>
                        <dd class="col-sm-8">
                            <i class="fas fa-phone text-success"></i> <?php echo e($patient->phone_number); ?>

                        </dd>

                        <dt class="col-sm-4">Registered At</dt>
                        <dd class="col-sm-8">
                            <?php echo e(\Carbon\Carbon::parse($patient->created_at)->format('d/m/Y H:i')); ?>

                        </dd>
                    </dl>
                </div>
                <div class="card-footer text-end">
                    <a href="<?php echo e(route('patients.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <?php if(auth()->user()->role == 'pendaftaran'): ?>
                        <a href="<?php echo e(route('patients.edit', $patient)); ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-stethoscope"></i> Examination History
                    </h4>
                    <span class="badge bg-light text-dark"><?php echo e($patient->examinations->count()); ?> Records</span>
                </div>
                <div class="card-body">
                    <?php if($patient->examinations->count() > 0): ?>
                        <div class="accordion" id="examinationAccordion">
                            <?php $__currentLoopData = $patient->examinations->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $examination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="accordion-item mb-3">
                                    <h2 class="accordion-header" id="heading<?php echo e($index); ?>">
                                        <button class="accordion-button <?php echo e($index == 0 ? '' : 'collapsed'); ?>" type="button" 
                                                data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($index); ?>" 
                                                aria-expanded="<?php echo e($index == 0 ? 'true' : 'false'); ?>" 
                                                aria-controls="collapse<?php echo e($index); ?>">
                                            <div class="d-flex justify-content-between w-100 me-3">
                                                <div>
                                                    <strong>
                                                        <i class="fas fa-calendar-alt text-primary"></i>
                                                        <?php echo e(\Carbon\Carbon::parse($examination->created_at)->format('d M Y, H:i')); ?>

                                                    </strong>
                                                </div>
                                                <div class="text-end">
                                                    <small class="text-muted">
                                                        Nurse: <?php echo e($examination->nurse->name ?? 'N/A'); ?> | 
                                                        Doctor: <?php echo e($examination->doctor->name ?? 'N/A'); ?>

                                                    </small>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse<?php echo e($index); ?>" 
                                         class="accordion-collapse collapse <?php echo e($index == 0 ? 'show' : ''); ?>" 
                                         aria-labelledby="heading<?php echo e($index); ?>" 
                                         data-bs-parent="#examinationAccordion">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="text-primary border-bottom pb-2">
                                                        <i class="fas fa-heartbeat"></i> Vital Signs
                                                    </h6>
                                                    <dl class="row">
                                                        <dt class="col-sm-5">Weight</dt>
                                                        <dd class="col-sm-7">
                                                            <i class="fas fa-weight text-info"></i> 
                                                            <?php echo e($examination->weight ?? 'Not recorded'); ?> 
                                                            <?php if($examination->weight): ?> kg <?php endif; ?>
                                                        </dd>

                                                        <dt class="col-sm-5">Blood Pressure</dt>
                                                        <dd class="col-sm-7">
                                                            <i class="fas fa-tint text-danger"></i> 
                                                            <?php echo e($examination->blood_pressure ?? 'Not recorded'); ?>

                                                            <?php if($examination->blood_pressure): ?> mmHg <?php endif; ?>
                                                        </dd>
                                                    </dl>
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 class="text-success border-bottom pb-2">
                                                        <i class="fas fa-notes-medical"></i> Medical Details
                                                    </h6>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Complaint</dt>
                                                        <dd class="col-sm-8">
                                                            <div class="alert alert-light py-2 mb-2">
                                                                <i class="fas fa-comment-medical text-primary"></i>
                                                                <?php echo e($examination->complaint ?? 'No complaint recorded'); ?>

                                                            </div>
                                                        </dd>

                                                        <dt class="col-sm-4">Diagnosis</dt>
                                                        <dd class="col-sm-8">
                                                            <div class="alert alert-info py-2 mb-2">
                                                                <i class="fas fa-diagnosis text-info"></i>
                                                                <?php echo e($examination->diagnosis ?? 'No diagnosis recorded'); ?>

                                                            </div>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <h6 class="text-secondary border-bottom pb-2">
                                                        <i class="fas fa-user-md"></i> Medical Staff
                                                    </h6>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <div class="badge bg-light text-dark me-2">
                                                                    <i class="fas fa-user-nurse"></i> Nurse
                                                                </div>
                                                                <span><?php echo e($examination->nurse->name ?? 'Not assigned'); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <div class="badge bg-primary text-white me-2">
                                                                    <i class="fas fa-user-md"></i> Doctor
                                                                </div>
                                                                <span><?php echo e($examination->doctor->name ?? 'Not assigned'); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-end mt-3">
                                                <small class="text-muted">
                                                    <i class="fas fa-clock"></i> 
                                                    Recorded on <?php echo e(\Carbon\Carbon::parse($examination->created_at)->format('d M Y, H:i:s')); ?>

                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle"></i> 
                            No examination records found for this patient.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\room\klinik_fazri\resources\views/patients/show.blade.php ENDPATH**/ ?>