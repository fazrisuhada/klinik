

<?php $__env->startSection('title', 'Patients - Management Clinic'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-users text-primary"></i> Patients
                    </h2>
                    <p class="text-muted mb-0">Manage patient data</p>
                </div>
                <?php if(auth()->user()->role == 'pendaftaran'): ?>
                <div>
                    <a href="<?php echo e(route('patients.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Patient
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i> Patients
                        <span class="badge bg-secondary ms-2"><?php echo e($patients->total()); ?> Total</span>
                    </h5>
                </div>
                <div class="card-body">
                    <?php if($patients->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Name</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Phone Number</th>
                                    <th>Registered At</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($patients->firstItem() + $index); ?></td>
                                    <td>
                                        <strong><?php echo e($item->name); ?></strong>
                                    </td>
                                    <td>
                                        <?php
                                        $dob = \Carbon\Carbon::parse($item->dob);
                                        ?>
                                        <?php echo e($dob->format('d/m/Y')); ?>

                                        <small class="text-muted d-block">
                                            (<?php echo e($dob->age); ?> tahun)
                                        </small>
                                    </td>
                                    <td>
                                        <?php if($item->gender == 'Male'): ?>
                                        <span class="badge bg-info">
                                            <i class="fas fa-mars"></i> <?php echo e($item->gender); ?>

                                        </span>
                                        <?php else: ?>
                                        <span class="badge bg-pink text-white" style="background-color: #e91e63;">
                                            <i class="fas fa-venus"></i> <?php echo e($item->gender); ?>

                                        </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <i class="fas fa-phone text-success"></i>
                                        <?php echo e($item->phone_number); ?>

                                    </td>
                                    <td>
                                        <?php echo e($item->created_at->format('d/m/Y H:i')); ?>

                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('patients.show', $item)); ?>"
                                                class="btn btn-sm btn-outline-info"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <?php if(auth()->user()->role == 'pendaftaran'): ?>
                                            <a href="<?php echo e(route('patients.edit', $item)); ?>"
                                                class="btn btn-sm btn-outline-warning"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal<?php echo e($item->id); ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <?php endif; ?>
                                        </div>

                                        <?php if(auth()->user()->role == 'pendaftaran'): ?>
                                        <div class="modal fade" id="deleteModal<?php echo e($item->id); ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <i class="fas fa-exclamation-triangle text-danger"></i>
                                                            Delete Confirmation
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete patient data?</p>
                                                        <div class="alert alert-warning">
                                                            <strong><?php echo e($item->name); ?></strong><br>
                                                            <small><?php echo e($item->phone_number); ?></small>
                                                        </div>
                                                        <p class="text-danger">
                                                            <small>
                                                                <i class="fas fa-warning"></i>
                                                               Deleted data cannot be recovered!
                                                            </small>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            Batal
                                                        </button>
                                                        <form action="<?php echo e(route('patients.destroy', $item)); ?>" method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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

                                from <?php echo e($patients->total()); ?> data
                            </small>
                        </div>
                        <div>
                            <?php echo e($patients->links()); ?>

                        </div>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle"></i> Data not found.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH Z:\room\klinik_fazri\resources\views/patients/index.blade.php ENDPATH**/ ?>