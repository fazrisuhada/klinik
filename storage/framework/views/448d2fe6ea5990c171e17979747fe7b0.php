

<?php $__env->startSection('title', 'Form Examination'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="mb-3">
                <i class="fas fa-edit text-primary"></i> Form Examination
            </h2>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <?php if(auth()->user()->role == 'perawat'): ?>
                        <i class="fas fa-notes-medical text-success"></i> Nurse Examination Form
                        <?php else: ?>
                        <i class="fas fa-user-md text-primary"></i> Doctor Examination Form
                        <?php endif; ?>
                    </h5>
                </div>
                <div class="card-body">
                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <h6><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</h6>
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <form action="<?php echo e($examination->id ? route('examinations.updateExamination', $examination->id) : route('examinations.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if($examination->id): ?>
                        <?php echo method_field('PUT'); ?>
                        <?php endif; ?>

                        <?php if(!$examination->id): ?>
                        <input type="hidden" name="patient_id" value="<?php echo e($examination->patient->id); ?>">
                        <?php endif; ?>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Patient Name</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($examination->patient->name); ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Examination Date</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e(\Carbon\Carbon::parse($examination->date ?? now())->format('d/m/Y')); ?>" readonly>
                            </div>
                        </div>

                        <hr>

                        <?php if(auth()->user()->role == 'perawat'): ?>
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-success mb-3">
                                    <i class="fas fa-notes-medical"></i> Nurse Assessment
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="weight" class="form-label">Weight (kg) <span class="text-danger">*</span></label>
                                    <input type="number"
                                        id="weight"
                                        name="weight"
                                        class="form-control <?php $__errorArgs = ['weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('weight', $examination->weight)); ?>"
                                        placeholder="Enter patient weight"
                                        step="0.1"
                                        min="1"
                                        max="500"
                                        required>
                                    <?php $__errorArgs = ['weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="blood_pressure" class="form-label">Blood Pressure <span class="text-danger">*</span></label>
                                    <input type="text"
                                        id="blood_pressure"
                                        name="blood_pressure"
                                        class="form-control <?php $__errorArgs = ['blood_pressure'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('blood_pressure', $examination->blood_pressure)); ?>"
                                        placeholder="e.g., 120/80"
                                        required>
                                    <?php $__errorArgs = ['blood_pressure'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="form-text">Format: systolic/diastolic (e.g., 120/80)</div>
                                </div>
                            </div>
                        </div>

                        <?php if($examination->complaint || $examination->diagnosis): ?>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-user-md"></i> Doctor Assessment (Read Only)
                                </h6>
                            </div>
                            <?php if($examination->complaint): ?>
                            <div class="col-md-6">
                                <label class="form-label">Complaint</label>
                                <textarea class="form-control bg-light" rows="3" readonly><?php echo e($examination->complaint); ?></textarea>
                            </div>
                            <?php endif; ?>
                            <?php if($examination->diagnosis): ?>
                            <div class="col-md-6">
                                <label class="form-label">Diagnosis</label>
                                <textarea class="form-control bg-light" rows="3" readonly><?php echo e($examination->diagnosis); ?></textarea>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if(auth()->user()->role == 'dokter'): ?>
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-user-md"></i> Doctor Assessment
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="complaint" class="form-label">Complaint <span class="text-danger">*</span></label>
                                    <textarea id="complaint"
                                        name="complaint"
                                        class="form-control <?php $__errorArgs = ['complaint'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        rows="4"
                                        placeholder="Describe patient complaint..."
                                        required><?php echo e(old('complaint', $examination->complaint)); ?></textarea>
                                    <?php $__errorArgs = ['complaint'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="diagnosis" class="form-label">Diagnosis <span class="text-danger">*</span></label>
                                    <textarea id="diagnosis"
                                        name="diagnosis"
                                        class="form-control <?php $__errorArgs = ['diagnosis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        rows="4"
                                        placeholder="Provide diagnosis..."
                                        required><?php echo e(old('diagnosis', $examination->diagnosis)); ?></textarea>
                                    <?php $__errorArgs = ['diagnosis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <?php if($examination->weight || $examination->blood_pressure): ?>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-success mb-3">
                                    <i class="fas fa-notes-medical"></i> Nurse Assessment (Read Only)
                                </h6>
                            </div>
                            <?php if($examination->weight): ?>
                            <div class="col-md-6">
                                <label class="form-label">Weight</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($examination->weight); ?> kg" readonly>
                            </div>
                            <?php endif; ?>
                            <?php if($examination->blood_pressure): ?>
                            <div class="col-md-6">
                                <label class="form-label">Blood Pressure</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($examination->blood_pressure); ?>" readonly>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>

                        <div class="row mt-4">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a href="<?php echo e(route('examinations.index')); ?>" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to List
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> <?php echo e($examination->id ? 'Update Examination' : 'Create Examination'); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\room\klinik_fazri\resources\views/examinations/edit.blade.php ENDPATH**/ ?>